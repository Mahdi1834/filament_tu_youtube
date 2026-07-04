<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestStateWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Total number of user of this page')
                ->descriptionIcon(Heroicon::User, IconPosition::Before)
                ->chart(
                    User::selectRaw('MONTH(created_at) as month , COUNT(*) as count')
                        ->whereYear('created_at', now()->year)
                        ->groupBy('month')
                        ->orderBy('month')
                        ->pluck('count')
                        ->toArray()
                )->descriptionColor('success')
                ->color('success'),

            Stat::make('Total Post', Post::count())
                ->description('Total number of post of this page')
                ->descriptionIcon(Heroicon::User, IconPosition::Before)
                ->chart(
                    Post::selectRaw('MONTH(created_at) as month , COUNT(*) as count')
                        ->whereYear('created_at', now()->year)
                        ->groupBy('month')
                        ->orderBy('month')
                        ->pluck('count')
                        ->toArray()
                )->descriptionColor('warning')
                ->color('warning'),


                       Stat::make('Total Post', Product::count())
                ->description('Total number of post of this page')
                ->descriptionIcon(Heroicon::User, IconPosition::Before)
                ->chart(
                    Product::selectRaw('MONTH(created_at) as month , COUNT(*) as count')
                        ->whereYear('created_at', now()->year)
                        ->groupBy('month')
                        ->orderBy('month')
                        ->pluck('count')
                        ->toArray()
                )->descriptionColor('info')
                ->color('info'),
        ];
    }
}
