<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->image()
                    ->directory('categories')
                    ->required()
                    ->columnSpan(2),
                TextInput::make('name')
                    ->required()
                    ->reactive()
                    ->debounce(1000)
                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->required(),
            ]);
    }
}
