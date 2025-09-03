<?php

namespace App\Filament\Resources\QuantityBannerResource\Pages;

use App\Filament\Resources\QuantityBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuantityBanners extends ListRecords
{
    protected static string $resource = QuantityBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
