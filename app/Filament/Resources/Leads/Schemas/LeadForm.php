<?php

namespace App\Filament\Resources\Leads\Schemas;

use App\Models\Lead;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nome')->required(),
                TextInput::make('company')->label('Empresa')->required(),
                TextInput::make('email')->label('E-mail')->email()->required(),
                TextInput::make('whatsapp')->label('WhatsApp')->required(),
                Select::make('segment')->label('Segmento')->options(array_combine(Lead::SEGMENTS, Lead::SEGMENTS))->required(),
                Select::make('branches')->label('Unidades')->options(array_combine(Lead::BRANCHES, Lead::BRANCHES))->required(),
                TextInput::make('source')->label('Página de origem')->disabled(),
                Select::make('status')->label('Status')->options(Lead::STATUSES)->required(),
                Textarea::make('message')->label('Mensagem')->rows(5)->columnSpanFull(),
            ]);
    }
}
