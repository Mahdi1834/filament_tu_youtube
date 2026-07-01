<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product Info')
                        ->icon(Heroicon::AcademicCap)
                        ->description('fill all the fileds')
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make('name')->required(),
                                    TextInput::make('sku')->required(),
                                ])->columns(2),

                            MarkdownEditor::make('decription'),
                        ]),

                    Step::make('Pricing $ Stock')
                        ->description('fill pricing and stock')
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make('price')->required(),
                                    TextInput::make('stock')->required(),
                                ])->columns(2),

                        ]),

                    Step::make('Media $ Status')
                        ->description('Fill Media and Status')
                        ->schema([

                            FileUpload::make('image')->required()->disk('public')->directory('products'),

                            Checkbox::make('is_active'),
                            Checkbox::make('is_featured'),

                        ]),

                ])
                    ->columnSpanFull()
                    ->skippable()->submitAction(
                        Action::make('name')
                            ->label('Save Product')
                            ->button()
                            ->color('primary')
                            ->submit('save')
                    ),

            ]);
    }
}
