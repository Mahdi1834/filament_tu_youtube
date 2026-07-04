<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\RelationManagers\TagsRelationManager;
use App\Filament\Resources\Posts\Schemas\PostForm;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Override;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';


    /// for search. when add to arrey you see in the search result
    #[Override]
    public static function getGloballySearchableAttributes(): array
    {
        return ['title' , "slug" , 'category.name'];
    }


    //اضافه کردن اطلاعات به متن سرچ
     #[Override]
     public static function getGlobalSearchResultDetails(Model $record): array
     {
        return [
            "Slug" => $record->slug,
            "Category" => $record->category->name,
        ];
     }

     #[Override]
     public static function getGlobalSearchEloquentQuery(): Builder
     {
        return parent::getGlobalSearchEloquentQuery()->with('category');
     }

    public static function form(Schema $schema): Schema
    {
        return PostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TagsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
