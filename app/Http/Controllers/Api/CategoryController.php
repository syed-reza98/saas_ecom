<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::all()->take(3);
        $categories = Category::whereNotNull('thumbnail')
                                ->where('display_type', '=', 'Products')
                                ->get()
                                ->take(3);
        $categories->each(function ($category) {
            $category->thumbnail = asset('storage/' . $category->thumbnail);
        });

        return response()->json($categories);
    }

    public function categoryNav()
    {
        // $categories = Category::all()->take(3);
        $categories = Category::where('display_type', '=', 'Products')
                                ->get()
                                ->take(5);

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
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
