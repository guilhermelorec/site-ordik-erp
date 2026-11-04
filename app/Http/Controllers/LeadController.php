<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Mail\NewLead;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request): RedirectResponse
    {
        $success = 'Pedido recebido. Vamos falar com você em até 1 dia útil para combinar a demonstração.';

        // Honeypot preenchido = bot. Responde como sucesso para não dar pistas.
        if ($request->filled('website')) {
            return back()->with('success', $success);
        }

        // Página de onde veio o pedido, para saber qual conteúdo gera lead.
        $source = parse_url((string) $request->headers->get('referer'), PHP_URL_PATH);

        $lead = Lead::create([...$request->validated(), 'source' => $source ?: null]);

        // O lead já está salvo: falha de SMTP não pode virar erro para o visitante.
        if ($to = config('ordik.leads_notify_email')) {
            rescue(fn () => Mail::to($to)->send(new NewLead($lead)));
        }

        return back()->with('success', $success);
    }
}
