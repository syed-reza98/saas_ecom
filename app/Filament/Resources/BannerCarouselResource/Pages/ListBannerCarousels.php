<?php

namespace App\Filament\Resources\BannerCarouselResource\Pages;

use App\Filament\Resources\BannerCarouselResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBannerCarousels extends ListRecords
{
    protected static string $resource = BannerCarouselResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
