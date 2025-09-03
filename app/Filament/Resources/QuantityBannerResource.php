<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuantityBannerResource\Pages;
use App\Filament\Resources\QuantityBannerResource\RelationManagers;
use App\Models\QuantityBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuantityBannerResource extends Resource
{
    protected static ?string $model = QuantityBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $navigationGroup = 'Shop';
    protected static ?string $navigationGroup = 'Landing Page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Image')->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label(false)
                        ->disk('public')
                        ->image()
                        ->imageCropAspectRatio(null)
                ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                ->label('Image'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuantityBanners::route('/'),
            'create' => Pages\CreateQuantityBanner::route('/create'),
            'edit' => Pages\EditQuantityBanner::route('/{record}/edit'),
        ];
    }
}
