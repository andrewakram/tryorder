<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateProductRequest;
use App\Http\Requests\Api\UpdateProductRequest;
use App\Http\Resources\Api\User\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $result = ProductResource::collection(Product::whereUserId(auth()->user()->id)->paginate(20));
        return msgdata(true, trans('lang.success'), $result, success());
    }

    public function show(Product $product)
    {
        $result = new ProductResource($product);
        return msgdata(true, trans('lang.success'), $result, success());
    }

    public function store(CreateProductRequest $request)
    {
        $request = $request->validated();
        $product = Product::create(array_merge($request,["user_id" => auth()->user()->id]));

        $result = new ProductResource($product);
        return msgdata(true, trans('lang.success'), $result, success());
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validated();

        $product->title = $request->input('title');
        $product->body = $request->input('body');
        $product->save();

        $result = new ProductResource($product);
        return msgdata(true, trans('lang.success'), $result, success());
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return msg(true, trans('lang.success'), success());
    }
}

