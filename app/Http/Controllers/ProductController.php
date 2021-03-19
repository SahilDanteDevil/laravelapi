<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\ProductCreateRequest;
class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::paginate();
    	return ProductResource::collection($products);
    }
    public function show($id)
    {
        $product = Product::find($id);
        return new ProductResource($product);
    }
    public function destroy($id)
    {
        Product::destroy($id);
        return response("DELETED",Response::HTTP_NO_CONTENT);
    }
    public function store(ProductCreateRequest $request){

    	$product = Product::create($request->only('title','description','image','price'));

    	return response($product, Response::HTTP_CREATED);
    }
    public function update(Request $request,$id){
    	 $product = Product::find($id);
    	 $product->update($request->only('title','description','image','price'));

    	return response($product, Response::HTTP_CREATED);
    }
}
