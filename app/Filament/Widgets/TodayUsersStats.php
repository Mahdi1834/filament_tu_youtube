<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TodayUsersStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('today_users' , User::whereDate('created_at', today())->count())
                ->label('Today Users')
        
                ->icon(Heroicon::UserGroup)
                ->description('Number of users registered today'),
        ];
    }
}
