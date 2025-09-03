<?php

namespace App\Filament\Resources\LandingVideoResource\Pages;

use App\Filament\Resources\LandingVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLandingVideos extends ListRecords
{
    protected static string $resource = LandingVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
