<?php

namespace App\Filament\Resources\QuantityBannerResource\Pages;

use App\Filament\Resources\QuantityBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQuantityBanner extends CreateRecord
{
    protected static string $resource = QuantityBannerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
