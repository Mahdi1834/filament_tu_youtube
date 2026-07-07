<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;


class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Post Details')
                    ->description('Enter the details of the post.')
                    ->icon(Heroicon::RectangleStack)
                    ->schema([

                        Section::make()->schema([

                            TextInput::make('title')
                                ->label('Title')
                                ->required()
                                ->rules(['min:3'])
                                ->maxLength(255)
                                ->live(onBlur:true)
                                ->afterStateUpdated(function(string $operation ,string $state , Set $set ){

                                    $set("slug", Str::slug($state));
                                }),
                            TextInput::make('slug')
                                ->label('Slug')
                                ->required()
                                ->unique()->validationMessages(
                                    [
                                        'unique' => 'از این اسلاگ قبلا استفاده شده است. لطفا یک اسلاگ دیگر انتخاب کنید.',
                                    ]
                                )
                                ->maxLength(255),
                            Select::make('category_id')
                                ->label('Category')
                                ->required()
                                ->relationship('category', 'name')
                                ->searchable(),
                            ColorPicker::make('color')
                                ->label('Color')
                                ->required(),

                        ])->columns(2),

                        MarkdownEditor::make('body')
                            ->label('Body')
                            ->required(),

                    ])->columnSpan(2),
                Group::make()
                    ->schema([

                        Section::make('Image Upload')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Image')
                                    ->disk('public')
                                    ->directory('posts')
                                    ->required(),

                            ]),
                        Section::make('Meta')
                            ->schema([
                                Select::make('tags')
                                    ->label('Tags')
                                    ->relationship("tags" , "name")
                                    ->multiple()
                                    ->required(),
                                Checkbox::make('published')
                                    ->label('Published')
                                    ->default(false),
                                DatePicker::make('published_at')
                                    ->label('Published At')
                                    ->nullable(),

                            ]),
                    ])->columnSpan(1),

            ])
            ->columns(3);
    }
}
