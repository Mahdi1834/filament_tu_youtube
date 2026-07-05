<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use App\Models\Product;
use Filament\Support\Icons\Heroicon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class TestStateWidget extends StatsOverviewWidget
{
     use InteractsWithPageFilters;


    protected function getStats(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;


        return [
            Stat::make('Total Users', User::query()
                    ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                    ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                    ->count())
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
