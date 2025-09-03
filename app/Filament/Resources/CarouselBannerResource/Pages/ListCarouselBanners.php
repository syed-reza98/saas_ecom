<?php

namespace App\Filament\Resources\CarouselBannerResource\Pages;

use App\Filament\Resources\CarouselBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarouselBanners extends ListRecords
{
    protected static string $resource = CarouselBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
