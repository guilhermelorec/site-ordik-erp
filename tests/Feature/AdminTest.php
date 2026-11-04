<?php

use App\Filament\Resources\Leads\Pages\ListLeads;
use App\Models\Lead;
use App\Models\User;
use Livewire\Livewire;

function lead(array $overrides = []): Lead
{
    return Lead::create([
        'name' => 'Ana',
        'company' => 'Loja A',
        'email' => 'a@example.com',
        'whatsapp' => '11911111111',
        'segment' => 'Loja ou varejo',
        'branches' => '1 unidade',
        ...$overrides,
    ]);
}

it('seeds the admin user from env config', function () {
    config(['ordik.admin' => ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => 'secret123']]);

    $this->seed();

    expect(User::where('email', 'admin@example.com')->exists())->toBeTrue();
});

it('redirects guests to the admin login', function () {
    $this->get('/admin/leads')->assertRedirect('/admin/login');
});

it('uses relative brand assets so they follow the current host and scheme', function () {
    $this->get('/admin/login')
        ->assertOk()
        ->assertSee('src="/brand/ordik-logo.svg"', false)
        ->assertSee('href="/brand/ordik-icon.svg"', false);
});

it('lists, filters and exports leads', function () {
    $this->actingAs(User::factory()->create());
    $novo = lead();
    $convertido = lead(['name' => 'Bia', 'status' => 'convertido']);

    $this->get('/admin/leads')->assertOk();

    Livewire::test(ListLeads::class)
        ->assertCanSeeTableRecords([$novo, $convertido])
        ->filterTable('status', 'convertido')
        ->assertCanSeeTableRecords([$convertido])
        ->assertCanNotSeeTableRecords([$novo])
        ->callAction('exportCsv')
        ->assertFileDownloaded('leads-'.now()->format('Y-m-d').'.csv');
});
