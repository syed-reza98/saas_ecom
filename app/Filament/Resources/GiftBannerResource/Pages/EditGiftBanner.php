<?php

namespace App\Filament\Resources\GiftBannerResource\Pages;

use App\Filament\Resources\GiftBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGiftBanner extends EditRecord
{
    protected static string $resource = GiftBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
