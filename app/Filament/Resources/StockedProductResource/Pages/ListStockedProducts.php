<?php

namespace App\Filament\Resources\StockedProductResource\Pages;

use App\Filament\Resources\StockedProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStockedProducts extends ListRecords
{
    protected static string $resource = StockedProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
