<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Exports\UserExporter;
use App\Filament\Imports\UserImporter;
use App\Filament\Resources\Users\UserResource;
use App\Filament\Resources\Users\Widgets\UserCounterWidget;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ExportAction::make()
                ->label('Export Users')
                ->exporter(UserExporter::class),
            ImportAction::make()
                ->label('Import Users')
                ->importer(UserImporter::class),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UserCounterWidget::class,
        ];
    }
}
