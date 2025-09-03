<?php

namespace App\Filament\Resources\CarouselBannerResource\Pages;

use App\Filament\Resources\CarouselBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarouselBanner extends EditRecord
{
    protected static string $resource = CarouselBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
