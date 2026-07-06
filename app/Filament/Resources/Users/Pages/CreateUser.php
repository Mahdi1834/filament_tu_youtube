<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Icons\Heroicon;
use Override;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;


    #[Override]
    protected function getCreatedNotificationMessage(): ?string
    {
        return "User Created";
    }

    #[Override]
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
        ->title("User Created")
        ->body("user create successfuly")
        ->icon(Heroicon::User)
        ->success()
        ->send();
    }
}
