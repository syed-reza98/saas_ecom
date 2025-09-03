<?php

namespace App\Filament\Resources\BannerCarouselResource\Pages;

use App\Filament\Resources\BannerCarouselResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBannerCarousel extends EditRecord
{
    protected static string $resource = BannerCarouselResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
