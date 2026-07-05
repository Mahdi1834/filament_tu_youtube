<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserCounterWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Total User", User::count()),
            Stat::make("Total Users from iran", User::whereHas("country", fn($q) => $q->where('name', "Iran"))->count())
        ];
    }
}
