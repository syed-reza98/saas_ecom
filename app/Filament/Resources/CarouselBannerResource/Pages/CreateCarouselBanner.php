<?php

namespace App\Filament\Resources\CarouselBannerResource\Pages;

use App\Filament\Resources\CarouselBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCarouselBanner extends CreateRecord
{
    protected static string $resource = CarouselBannerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
