<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::with('category:id,name')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($attributes): Product
    {
        $product = new Product($attributes);

        return $product;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'image' => 'required|max:150',
            'name' => 'required|max:150',
            'unitary_price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1',
            'rating' => 'required|numeric|min:1|max:5',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 422);
        }
        return $this->create($request->all())->save();
    }

    /**
     * Display the specified resource.
     */
    public function show($product)
    {
        return Product::where('id', $product)->firstOrFail();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productId)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'image' => 'max:150',
            'name' => 'max:150',
            'stock' => 'numeric|min:1',
            'unitary_price' => 'numeric|min:1',
            'rating' => 'numeric|min:1|max:5',
            'category_id' => 'exists:categories,id'
        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 422);
        }
        $product =  Product::findOrFail($productId);

        $product->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId)
    {
        $product = Product::where('id', $productId)->firstOrFail();
        $product->delete();
        return Response($product, 200);

    }
}
