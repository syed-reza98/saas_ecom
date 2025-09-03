<?php

namespace App\Filament\Resources\LandingVideoResource\Pages;

use App\Filament\Resources\LandingVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLandingVideo extends EditRecord
{
    protected static string $resource = LandingVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
