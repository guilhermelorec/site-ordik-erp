<?php

use App\Mail\NewLead;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

function validLead(array $overrides = []): array
{
    return array_merge([
        'name' => 'Maria Silva',
        'company' => 'Auto Peças Silva',
        'email' => 'maria@example.com',
        'whatsapp' => '(11) 91234-5678',
        'segment' => 'Oficina ou assistência técnica',
        'branches' => '2 a 5 unidades',
        'message' => 'Quero conhecer as ordens de serviço.',
    ], $overrides);
}

beforeEach(function () {
    Mail::fake();
    config(['ordik.leads_notify_email' => 'comercial@example.com']);
});

it('stores a lead, e-mails the team and flashes success', function () {
    $this->from('/contato')->post('/contato', validLead())
        ->assertRedirect('/contato#pedido')
        ->assertSessionHas('success');

    $lead = Lead::sole();
    expect($lead->company)->toBe('Auto Peças Silva')
        ->and($lead->whatsapp)->toBe('11912345678')
        ->and($lead->source)->toBe('/contato')
        ->and($lead->status)->toBe('novo');

    Mail::assertSent(NewLead::class, fn (NewLead $mail) => $mail->hasTo('comercial@example.com') && $mail->lead->is($lead));
});

it('keeps the lead when the notification e-mail fails', function () {
    Mail::shouldReceive('to')->andThrow(new RuntimeException('SMTP fora do ar'));

    $this->from('/contato')->post('/contato', validLead())
        ->assertRedirect('/contato#pedido')
        ->assertSessionHas('success');

    expect(Lead::count())->toBe(1);
});

it('validates the lead fields', function () {
    $this->from('/contato')->post('/contato', validLead([
        'name' => '',
        'email' => 'nao-e-email',
        'whatsapp' => '123',
        'segment' => 'Inválido',
        'branches' => '500 unidades',
    ]))->assertRedirect('/contato#pedido')
        ->assertSessionHasErrors(['name', 'email', 'whatsapp', 'segment', 'branches']);

    expect(Lead::count())->toBe(0);
    Mail::assertNothingSent();
});

it('shows validation messages in Portuguese', function () {
    $this->followingRedirects()->from('/contato')->post('/contato', validLead(['name' => '']))
        ->assertSee('O campo nome é obrigatório.');
});

it('silently drops honeypot submissions', function () {
    $this->from('/contato')->post('/contato', validLead(['website' => 'http://spam.example']))
        ->assertRedirect('/contato#pedido')
        ->assertSessionHas('success');

    expect(Lead::count())->toBe(0);
    Mail::assertNothingSent();
});

it('rate limits the lead form', function () {
    foreach (range(1, 5) as $i) {
        $this->post('/contato', validLead())->assertRedirect();
    }

    $this->post('/contato', validLead())->assertTooManyRequests();
});

it('rate limits each visitor separately behind a proxy', function () {
    foreach (range(1, 6) as $i) {
        $response = $this->withServerVariables(['REMOTE_ADDR' => '10.0.0.1', 'HTTP_X_FORWARDED_FOR' => '203.0.113.'.$i])
            ->post('/contato', validLead());

        expect($response->status())->toBe(302);
    }
});
