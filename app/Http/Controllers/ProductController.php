<?php

namespace App\Http\Controllers;

use App\Events\deleteProduct;
use App\Events\ProductEvent;
use App\Models\Products;
use App\Repositories\ProductRepository;
// use Dotenv\Validator;
use App\Rules\ValidationRules;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function test(Request $request)
    {
        dd("in");
    }

    public function index(Request $request)
    {
        $searchName = $request['search_name'] ?? "";
        $search = $request->input('search', "");

        $products = $this->productRepository->getProducts($searchName, $search);

        return view('products.index', compact('products'), [
            'searchName' => $searchName,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        $products = $this->productRepository->storeProducts($request);

        // event(new ProductEvent($request));

        return redirect()->route('products.index', ['products' => $products])->with('success', 'Product added successfully');
    }

    public function edit(Products $product)
    {
        if (!$product->isOwner(Auth::user())) {
            return redirect()->route('products.index')->with('error', 'You are not the owner of this product!');
        }

        return view('products.edit', ['product' => $product]);
    }

    public function update(Products $product, Request $request)
    {
        $this->productRepository->updateProducts($product, $request);

        return redirect()->route('products.index')->with('success', 'Details updated Successfully!');
    }

    public function delete(Products $product)
    {
        if (!$product->isOwner(Auth::user())) {
            return redirect()->route('products.index')->with('error', 'You are not the owner of this product!');
        };

        $this->productRepository->deleteProducts($product);

        return redirect()->route('products.index')->with('success', 'Product removed!');
    }

    public function activeRecords()
    {
        $activeProducts = Products::all();

        return view('products.active', ['activeProducts' => $activeProducts]);
    }

    public function getActive()
    {
        $products = Products::find(1);

        dd($products->getProduct());
    }

    public function trashedRecords()
    {
        $allProducts = $this->productRepository->trashed();

        return view('products.trash', ['allProducts' => $allProducts]);
    }

    public function triggerEvent(Request $request)
    {

        $products = $this->productRepository->trigger($request);

        // event(new ProductEvent($products));

        return view('products.event', ['products' => $products]);
    }

    public function forceDelete($id)
    {
        $entry = Products::onlyTrashed()->find($id);

        event(new deleteProduct($entry));

        if ($entry) {
            $entry->forceDelete();
            return redirect()->route('products.trash')->with("success", "Product is permanently deleted!");
        }

        return redirect()->route('products.trash')->with('error', 'failed to delete');
    }

    public function restore($id)
    {
        $entry = Products::onlyTrashed()->find($id);

        if ($entry) {
            $entry->restore();

            return redirect()->route('products.index')->with('success', 'Successfully Restore!');
        }

        return redirect()->route('products.trash')->with('error', 'Failed to restore!');
    }
}
