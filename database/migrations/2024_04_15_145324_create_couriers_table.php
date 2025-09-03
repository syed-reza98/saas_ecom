<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('ep_name')->nullable();
            $table->string('pick_contact_person');
            $table->string('pick_district');
            $table->string('pick_thana');
            $table->string('pick_hub');
            $table->string('pick_union');
            $table->string('pick_address');
            $table->string('pick_mobile');
            $table->string('recipient_name');
            $table->string('recipient_mobile');
            $table->string('recipient_district');
            $table->string('recipient_city');
            $table->string('recipient_area');
            $table->string('recipient_thana');
            $table->string('recipient_union');
            $table->string('recipient_zip');
            $table->string('package_code');
            $table->string('recipient_address');
            $table->string('parcel_detail');
            $table->integer('number_of_item');
            $table->decimal('product_price', 10, 2);
            $table->string('payment_method');
            $table->string('ep_id'); // Invoice Id
            $table->string('product_id'); // Invoice Id
            $table->string('actual_product_price');
            $table->string('status')->default('pending');
            $table->string('tracking_number')->nullable();
            $table->string('ecr')->nullable(); // Tracking, eCourier ID
            $table->boolean('is_cancel')->default(false);
            $table->longText('comment')->nullable();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couriers');
    }
};


// "ep_name"              => "", // eCommerce Partner (EP) Name
// "pick_contact_person"  => "", // Contact Person of provided ep
// "pick_district"        => "", // Pickup district name
// "pick_thana"           => "", // Pickup thana name
// "pick_hub"             => "", // Pickup branch id 
// "pick_union"           => "", // Pickup union 
// "pick_address"         => "", // Pickup address
// "pick_mobile"          => "", // Pickup person contact number
// "recipient_name"       => "", // Parcel receiver’s name
// "recipient_mobile"     => "", // Parcel receiver’s mobile number
// "recipient_district"   => "", // Parcel receiver’s district name
// "recipient_city"       => "", // Parcel receiver’s city name
// "recipient_area"       => "", // Parcel receiver’s area name
// "recipient_thana"      => "", // Parcel receiver’s thana name
// "recipient_union"      => "", // Parcel receiver’s union name
// "recipient_zip"        => "", // Parcel receiver’s zip code
// "package_code"         => "", // Package code find in package API
// "recipient_address"    => "", // Parcel receiver’s full address
// "parcel_detail"        => "", // Parcel product or documents details
// "number_of_item"       => "", // Total quantity
// "product_price"        => "", // Receive amount from parcel receiver’s
// "payment_method"       => "", // Cash On Delivery – COD,Point of Sale – POS, Mobile Payment – MPAY, Card Payment – CCRD
// "ep_id"                => "", // Invoice Id 
// "product_id"                => "", // Product Id 
// "actual_product_price" => "" // Parcel product actual price