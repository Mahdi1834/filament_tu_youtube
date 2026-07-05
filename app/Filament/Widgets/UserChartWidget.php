<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class UserChartWidget extends ChartWidget
{

    use InteractsWithPageFilters;


    protected ?string $heading = 'User Chart Widget';

    protected string $color = 'info';




    protected function getStats(): array
    {
        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;

        $start =  $startDate ? now()->parse($startDate)->startOfDay() : now()->startOfYear();
        $end =  $endDate ? now()->parse($endDate)->endOfDay() : now()->endOfYear();




        $data = Trend::model(User::class)
            ->between(
                start: $start,
                end: $end,
            )
            ->perMonth()
            ->count();



        return [
            'datasets' => [
                [
                    'label' => 'users created',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),

        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
