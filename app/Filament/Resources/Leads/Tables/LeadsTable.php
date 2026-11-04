<?php

namespace App\Filament\Resources\Leads\Tables;

use App\Models\Lead;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Recebido em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('company')
                    ->label('Empresa')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->url(fn (Lead $record) => 'https://wa.me/'.(strlen($record->whatsapp) <= 11 ? '55' : '').$record->whatsapp, shouldOpenInNewTab: true),
                TextColumn::make('segment')
                    ->label('Segmento'),
                TextColumn::make('branches')
                    ->label('Unidades'),
                TextColumn::make('source')
                    ->label('Origem')
                    ->toggleable(isToggledHiddenByDefault: true),
                SelectColumn::make('status')
                    ->label('Status')
                    ->options(Lead::STATUSES)
                    ->selectablePlaceholder(false),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(Lead::STATUSES),
                Filter::make('created_at')
                    ->label('Data')
                    ->schema([
                        DatePicker::make('from')->label('De'),
                        DatePicker::make('until')->label('Até'),
                    ])
                    ->query(fn (Builder $query, array $data) => $query
                        ->when($data['from'], fn (Builder $q, $date) => $q->whereDate('created_at', '>=', $date))
                        ->when($data['until'], fn (Builder $q, $date) => $q->whereDate('created_at', '<=', $date))),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
