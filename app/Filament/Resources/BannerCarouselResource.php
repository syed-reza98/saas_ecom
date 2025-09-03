<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerCarouselResource\Pages;
use App\Filament\Resources\BannerCarouselResource\RelationManagers;
use App\Models\BannerCarousel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class BannerCarouselResource extends Resource
{
    protected static ?string $model = BannerCarousel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Landing Page';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')
                            ->required()
                            ->unique(BannerCarousel::class, 'name', ignoreRecord: true)
                            ->live(onBlur: true)
                            ->autofocus()
                            ->afterStateUpdated(function (string $state, Set $set) {
                                // Automatically generate a slug when the name is updated.
                                $set('slug', Str::slug($state));
                            }),

                            Forms\Components\TextInput::make('slug')
                            ->required()
                            ->disabled()
                            ->unique(BannerCarousel::class, 'slug', ignoreRecord: true)
                            ->dehydrated(),


                Forms\Components\Section::make('Image')->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label(false)
                            ->disk('public')
                            ->image()
                            ->imageCropAspectRatio(null)
                    ])->collapsible(),
                Forms\Components\MarkdownEditor::make('description')
                    ->columnSpan('full'),

            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                ->label('Image'),
            Tables\Columns\TextColumn::make('name')
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
            'index' => Pages\ListBannerCarousels::route('/'),
            'create' => Pages\CreateBannerCarousel::route('/create'),
            'edit' => Pages\EditBannerCarousel::route('/{record}/edit'),
        ];
    }
}
