<?php

namespace App\Filament\Resources\StockedProductResource\Pages;

use App\Filament\Resources\StockedProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStockedProduct extends CreateRecord
{
    protected static string $resource = StockedProductResource::class;
}
