<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return ProductResource::collection(Product::all());
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(ProductRequest $request)
	{
		$product = Product::create([
			'name' => $request->name,
			'price' => $request->price,
			'description' => $request->description,
			'image' => $request->image->store('images', 'public')
		]);
		return new ProductResource($product);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Product $product)
	{
		return new ProductResource($product);
	}


	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Product $product)
	{
		$image = $product->image;
		if ($request->hasFile('image')) {
			if (Storage::disk('public')->exists($image)) {
				Storage::disk('public')->delete($image);
			}
			$image = $request->image->store('images', 'public');
		}
		$product->update($request->all());
		return new ProductResource($product);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Product $product)
	{
		$image = $product->image;

		if (Storage::disk('public')->exists($image)) {
			Storage::disk('public')->delete($image);
		}

		$product->delete();
		return response()->noContent();
	}
}
