<?php

namespace App\Filament\Resources\LandingVideoResource\Pages;

use App\Filament\Resources\LandingVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLandingVideo extends CreateRecord
{
    protected static string $resource = LandingVideoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
