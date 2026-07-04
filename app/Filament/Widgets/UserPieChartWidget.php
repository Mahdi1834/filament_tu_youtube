<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class UserPieChartWidget extends ChartWidget
{
    protected ?string $heading = 'User Pie Chart Widget';

    protected ?string $maxHeight = '250px';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'users created',
                    'data' => [100, 200, 300],
                    "backgroundColor" => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                    ],
                ],
            ],
            'labels' => ['Indio', 'US', ' Canada'],

        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
