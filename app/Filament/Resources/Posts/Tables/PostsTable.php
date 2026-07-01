<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ReplicateAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public'),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('slug')->sortable()->searchable()->toggleable(),
                TextColumn::make('category.name')->sortable()->searchable(),
                ColorColumn::make('color'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('tags')
                    ->toggleable(),
                IconColumn::make('published')
                ->action(function (Post $record) {
                    $record->published = ! $record->published;
                    $record->save();
                }),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->toggleable(),

            ])->defaultSort('id', 'asc')
            ->filters([
                Filter::make('created_at')
                    ->label('Creation date')
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Select Date'),
                    ])
                    ->query(function ($query, $data) {
                        return $query
                            ->when($data['created_at'], fn ($q, $date) => $q->whereDate('created_at', $date));
                    }),

                SelectFilter::make('category_id')
                    ->label('Select Category')
                    ->relationship('category', 'name')
                    ->preload(),
            ])
            ->recordActions([
                Action::make('Status')
                    ->label('Status Change')
                    ->schema([
                        Checkbox::make('published'),
                    ])->action(function (array $data, Post $record) {
                        $record->published = $data['published'];
                        $record->save();
                    }),
                ReplicateAction::make('Copy'),
                EditAction::make(),
                DeleteAction::make(),

            ])
            ->toolbarActions([
                    BulkActionGroup::make([
                        DeleteBulkAction::make(),
                    ]),
            ]);
    }
}
