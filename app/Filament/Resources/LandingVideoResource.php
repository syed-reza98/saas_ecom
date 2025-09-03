<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandingVideoResource\Pages;
use App\Filament\Resources\LandingVideoResource\RelationManagers;
use App\Models\LandingVideo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LandingVideoResource extends Resource
{
    protected static ?string $model = LandingVideo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Landing Page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('likes')
                        ->required()
                        ->maxValue(20),
                    Forms\Components\TextInput::make('views')
                        ->required()
                        ->maxValue(20),
                Forms\Components\Section::make('Image')->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label(false)
                        ->disk('public')
                        ->image()
                        ->imageCropAspectRatio(null)
                ])->collapsible(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('likes')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('views')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListLandingVideos::route('/'),
            'create' => Pages\CreateLandingVideo::route('/create'),
            'edit' => Pages\EditLandingVideo::route('/{record}/edit'),
        ];
    }
}
