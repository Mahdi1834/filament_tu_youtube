<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;
use Override;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->title("User Deleted")
                        ->body("user deleted successfuly")
                        ->icon(Heroicon::User)
                        ->success()

                ),
        ];
    }


    #[Override]
    protected function getSavedNotificationMessage(): ?string

    {
        return "User updated";
    }

    #[Override]
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title("User Updated")
            ->body("user updated successfuly")
            ->icon(Heroicon::User)
            ->success()
            ->send();
    }
}
