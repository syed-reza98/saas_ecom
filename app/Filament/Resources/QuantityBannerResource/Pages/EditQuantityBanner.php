<?php

namespace App\Filament\Resources\QuantityBannerResource\Pages;

use App\Filament\Resources\QuantityBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuantityBanner extends EditRecord
{
    protected static string $resource = QuantityBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
