<?php

namespace App\Filament\Resources\Leads\Pages;

use App\Filament\Resources\Leads\LeadResource;
use App\Models\Lead;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListLeads extends ListRecords
{
    protected static string $resource = LeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportCsv')
                ->label('Exportar CSV')
                ->icon(Heroicon::OutlinedArrowDownTray)
                ->action(fn () => $this->exportCsv()),
        ];
    }

    // Exporta os leads com os filtros, busca e ordenação atuais da tabela.
    protected function exportCsv(): StreamedResponse
    {
        $query = $this->getFilteredSortedTableQuery();

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // BOM para o Excel abrir acentos corretamente
            fputcsv($out, ['Data', 'Nome', 'Empresa', 'E-mail', 'WhatsApp', 'Segmento', 'Unidades', 'Origem', 'Status', 'Mensagem'], ';');
            $query->lazy()->each(fn (Lead $lead) => fputcsv($out, [
                $lead->created_at->format('d/m/Y H:i'),
                $lead->name,
                $lead->company,
                $lead->email,
                $lead->whatsapp,
                $lead->segment,
                $lead->branches,
                $lead->source,
                Lead::STATUSES[$lead->status] ?? $lead->status,
                $lead->message,
            ], ';'));
            fclose($out);
        }, 'leads-'.now()->format('Y-m-d').'.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}
