<?php

namespace App\Filament\Resources\GiftBannerResource\Pages;

use App\Filament\Resources\GiftBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGiftBanner extends CreateRecord
{
    protected static string $resource = GiftBannerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
