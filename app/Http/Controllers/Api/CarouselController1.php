<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerCarousel;
use App\Models\CarouselBanner;
use App\Models\GiftBanner;
use App\Models\LandingVideo;
use App\Models\Partners;
use App\Models\Clearance;
use App\Models\QuantityBanner;

class CarouselController1 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $carouselBanners = CarouselBanner::whereNotNull('image')->get();
        $carouselBanners->each(function ($carouselBanner) {
            $carouselBanner->image = asset('storage/' . $carouselBanner->image);
        });

        $bannerCarousels = BannerCarousel::whereNotNull('image')->get();
        $bannerCarousels->each(function ($bannerCarousel) {
            $bannerCarousel->image = asset('storage/' . $bannerCarousel->image);
        });

        $giftCarousels = GiftBanner::all();
        $giftCarousels->each(function ($giftCarousel) {
            $giftCarousel->image = asset('storage/' . $giftCarousel->image);
        });


        $landingvideoCarousels = LandingVideo::all();

        $landingvideoCarousels->each(function ($landingvideoCarousel) {
            $landingvideoCarousel->image = asset('storage/' . $landingvideoCarousel->image);
        });

        $partners = Partners::all();

        $partners->each(function ($partner) {
            $partner->image = asset('storage/' . $partner->image);
        });

        $QuantityCarousels = QuantityBanner::all();

        $QuantityCarousels->each(function ($QuantityCarousel) {
            $QuantityCarousel->image = asset('storage/' . $QuantityCarousel->image);
        });



        $landingData1 = [

            'carouselBanners' => $carouselBanners,
            'bannerCarousels' => $bannerCarousels,
            'giftCarousels' => $giftCarousels,
            'landingvideoCarousels'=> $landingvideoCarousels,
            'partners' => $partners,
            'QuantityCarousels'=>$QuantityCarousels,


        ];

        return response()->json($landingData1);

    }

    // public function gift()
    // {

    //     $giftCarousels = GiftBanner::all();
    //     $giftCarousels->each(function ($giftCarousel) {
    //         $giftCarousel->image = asset('storage/' . $giftCarousel->image);
    //     });
    //     return response()->json($giftCarousels);
    // }



    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
