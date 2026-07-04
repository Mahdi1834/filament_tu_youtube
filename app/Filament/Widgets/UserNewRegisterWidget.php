<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;


class UserNewRegisterWidget extends TableWidget
{


    protected static?int $sort = 1;
    protected int|string|array $columnSpan = "full";


    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => User::query()->latest()->take(10))
            ->columns([

            TextColumn::make("id"),
            TextColumn::make("name"),
            TextColumn::make("email"),
            TextColumn::make("created_ad"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
