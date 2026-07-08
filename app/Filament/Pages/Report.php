<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TodayUsersStats;
use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Override;

class Report extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.report';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Map;

    protected static ?string $navigationLabel = ' Report';

    protected static ?string $title = 'User Report';

    protected function getTableQuery(): Builder|Relation|null
    {
        return User::query()
            ->whereDate('created_at', today());
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')->label('Name'),
            TextColumn::make('email')->label('Email'),
            TextColumn::make('created_at')->label('Created At')->dateTime(),
        ];
    }

    #[Override]
    public function getHeaderWidgets(): array
    {

        return [
            TodayUsersStats::class
        ];
    }
}
