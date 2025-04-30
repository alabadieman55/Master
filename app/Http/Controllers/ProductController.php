<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }



    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0',
            'SKU' => 'required|string|max:100|unique:products',
            'stock_status' => 'required|in:instock,outofstock',
            'quantity' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        dd($data);

        // Handle primary image upload
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('products', $imageName, 'public');

        // Handle multiple images upload
        $imagesPath = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . rand(1000, 9999) . '.' . $image->extension();
                $image->storeAs('products', $filename, 'public');
                $imagesPath[] = $filename;
            }
        }

        // Create new product
        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'discount' => $request->discount ?? null,
            'SKU' => $request->SKU,
            'stock_status' => $request->stock_status,
            'featarured' => $request->has('featarured') ? true : false,
            'quantity' => $request->quantity,
            'image' => $imageName,
            'images' => json_encode($imagesPath),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'SKU' => 'required|string|max:100|unique:products,SKU,' . $product->id,
            'stock_status' => 'required|in:instock,outofstock',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Handle primary image upload if new image is provided
        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete('products/' . $product->image);

            // Store new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('products', $imageName, 'public');
        } else {
            $imageName = $product->image;
        }

        // Handle multiple images upload
        $imagesPath = json_decode($product->images, true) ?: [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . rand(1000, 9999) . '.' . $image->extension();
                $image->storeAs('products', $filename, 'public');
                $imagesPath[] = $filename;
            }
        }

        // Update product
        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'discount' => $request->discount,
            'SKU' => $request->SKU,
            'stock_status' => $request->stock_status,
            'featarured' => $request->has('featarured') ? true : false,
            'quantity' => $request->quantity,
            'image' => $imageName,
            'images' => json_encode($imagesPath),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product
     */
    public function destroy(Product $product)
    {
        // Delete the main image
        Storage::disk('public')->delete('products/' . $product->image);

        // Delete additional images
        $images = json_decode($product->images, true) ?: [];
        foreach ($images as $image) {
            Storage::disk('public')->delete('products/' . $image);
        }

        // Delete the product record
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Remove specific additional image from product
     */
    public function deleteImage(Request $request, Product $product)
    {
        $filename = $request->filename;
        $images = json_decode($product->images, true) ?: [];

        if (($key = array_search($filename, $images)) !== false) {
            // Delete file from storage
            Storage::disk('public')->delete('products/' . $filename);

            // Remove from array
            unset($images[$key]);

            // Update product
            $product->update([
                'images' => json_encode(array_values($images))
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
