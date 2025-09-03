<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Facade\Ecourier;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        // return static::getModel()::processing()->count();
        return static::getModel()::pending()->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        // get processing orders count
        $count = (int) static::getNavigationBadge();

        // show warning badge if there are more than 10 orders
        // in processing state otherwise show success badge
        return $count > 10 ? 'warning' : 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Order Details')->schema([
                        Forms\Components\TextInput::make('number')
                            //  generate random order number ie. OR-12345678
                            ->default('OR-' . random_int(100000, 99999999))
                            ->disabled()
                            ->required()
                            ->dehydrated(),
                        Forms\Components\Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('shipping_price')
                            ->label('Shipping Cost')
                            ->required()
                            ->numeric()
                            ->dehydrated(),
                        Forms\Components\Select::make('status')
                            ->options(OrderStatus::options())
                            ->default(OrderStatus::Pending)
                            ->required(),
                        Forms\Components\MarkdownEditor::make('notes')
                            ->columnSpanFull()

                    ])->columns(2),
                    Forms\Components\Wizard\Step::make('Order Items')->schema([
                        // add a repeatable fieldset for order items
                        Forms\Components\Repeater::make('items')
                            ->label(false)
                            ->addActionLabel('Add Item')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->label('Product')
                                    ->options(Product::query()->pluck('name', 'id'))
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        $set('unit_price', Product::find($state)?->price ?? 0);
                                    }),
                                Forms\Components\TextInput::make('quantity')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->required()
                                    ->live()
                                    ->dehydrated(),
                                Forms\Components\TextInput::make('unit_price')
                                    ->required()
                                    ->disabled()
                                    ->numeric()
                                    ->dehydrated(),
                                Forms\Components\Placeholder::make('total_price')
                                    ->content(function (Get $get) {
                                        return $get('quantity') * $get('unit_price');
                                    })
                            ])->columns(4)
                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => OrderStatus::from($state)->color())
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->sortable()
                    ->searchable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()->money()
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->date()
                    ->sortable()
            ])->defaultSort('created_at', 'desc')

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
                    ])->dropdown(false), // divider
                    Tables\Actions\DeleteAction::make(),
                ]),
                Tables\Actions\Action::make('Courier Order')
                        ->label('Courier Order')
                        ->icon('heroicon-m-arrow-top-right-on-square')
                        ->color('gray')
                        ->action(function (Order $order) {
                            // $post = Post::find($arguments['post']);
                            // dd($order->customer);
                            // $post?->delete();
                            $eCourier = Ecourier::order()->create([
                                "product_id" => "AS321",
                                "ep_name" => "Test Order",
                                "pick_contact_person" => "Test Order",
                                "pick_division" => "Dhaka",
                                "pick_district" => "Dhaka",
                                "pick_thana" => "Badda",
                                "pick_hub" => "18490",
                                "pick_union" => "1212",
                                "pick_address" => "Test Order",
                                "pick_mobile" => "01700000000",
                                "recipient_name" => $order->customer->name,
                                "recipient_mobile" => $order->customer->phone,
                                "recipient_division" => "Barisal",
                                "recipient_district" => "Barisal",
                                "recipient_city" => "Barisal",
                                "recipient_area" => "Test Order",
                                "recipient_thana" => "Babuganj",
                                "recipient_union" => "8216",
                                "package_code" => "#2416",
                                "recipient_address" => "Test Order",
                                "parcel_detail" => "Test Order",
                                "number_of_item" => "1",
                                "product_price" => $order->total_price,
                                "payment_method" => "COD",
                                "ep_id" => $order->number,
                                "actual_product_price" => 10,  
                            ]);
                    
                            $data = json_decode($eCourier->content(), true);
                            // dd($data['ID']);

                            $order->notes = $data['ID'];
                            $order->save();
                        }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
