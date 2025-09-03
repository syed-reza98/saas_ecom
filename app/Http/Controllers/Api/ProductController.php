<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Facade\Ecourier;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     //sabbir
     public function createProduct(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'brand_id' => 'required',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'description' => 'nullable',
            'quantity' => 'nullable',
            'price' => 'nullable',
            'is_visible' => 'nullable',
            'is_featured' => 'nullable',
            'type' => 'nullable',
            'published_at' => 'nullable',
            'short_description' => 'nullable',
            'date_sale_price_ends' => 'nullable',
            'tax_status' => 'nullable',
            'tax_class' => 'nullable',
            'in_stock' => 'nullable',
            'low_stock_amount' => 'nullable',
            'backorders_allowed' => 'nullable',
            'sold_individually' => 'nullable',
            'weight' => 'nullable',
            'length' => 'nullable',
            'width' => 'nullable',
            'height' => 'nullable',
            'allow_customer_reviews' => 'nullable',
            'purchase_note' => 'nullable',
            'sale_price' => 'nullable',
            'external_url' => 'nullable',
        ]);
        //return response()->json($validatedData, 201);
        if ($request->hasFile('image')) {
            // Upload image to public storage
            $imagePath = $request->file('image')->store('public');
    
            // Update validated data with image URL
            $validatedData['image_url'] = str_replace('public/', '', $imagePath);
        }
        //return response()->json($validatedData, 200);
        // Create a new product
        $product = Product::create($validatedData);

        // Return the newly created product
        return response()->json($product, 200);
    }
     public function productByFilter(Request $request)
    {
        // Start with a base query
        $query = Product::query();

        // Check if any filtering parameters are provided
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('sku')) {
            $query->where('sku', 'like', '%' . $request->input('sku') . '%');
        }
        $products = $query->get();

        // Modify image URLs
        $products->each(function ($product) {
            $product->image_url = asset('storage/' . $product->image_url);
        });

        // Return the filtered products
        return response()->json($products);

    }
     //sabbir
    public function index()
    {
        $products = Product::all()->take(8);
        $products->each(function ($product) {
            $product->image_url = asset('storage/' . $product->image_url);
        });

        return response()->json($products);

        // return Ecourier::order()->packageList();
    }

    public function featureProducts()
    {
        $products = Product::whereNotNull('image_url')
                ->where('is_featured', '=', 1)
                ->get()
                ->take(4);
        $products->each(function ($product) {
            $product->image_url = asset('storage/' . $product->image_url);
        });

        return response()->json($products);
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
        $product = Product::find($id);
        $product->image_url = asset('storage/' . $product->image_url);
        return response()->json($product);
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
