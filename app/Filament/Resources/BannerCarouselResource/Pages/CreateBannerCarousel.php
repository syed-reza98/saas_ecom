<?php

namespace App\Filament\Resources\BannerCarouselResource\Pages;

use App\Filament\Resources\BannerCarouselResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBannerCarousel extends CreateRecord
{
    protected static string $resource = BannerCarouselResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
