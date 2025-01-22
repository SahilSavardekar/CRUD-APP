<?php

namespace App\Repositories;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductRepository
{
    public function getProducts($searchName, $search)
    {
        // dd($product);
        if ($searchName != "" && $search == "") {
            // dd($searchName);
            return Products::where('name', 'LIKE', "%$searchName%")->get();
        } elseif ($search != "" && $searchName == "") {
            return Products::where('qty', $search)->get();
        } elseif ($search != "" && $searchName != "") {
            return Products::where('name', 'LIKE', "%$searchName%")->where('qty', $search)->get();
        } else {
            return Products::all();
        }
    }


    public function storeProducts(Request $request)
    {
        // $validated = $request->validate(
        //     [
        //         'name' => ['required', new ValidationRules],
        //         'qty' => ['required', new ValidationRules],
        //         'text' => ['required', new ValidationRules],
        //         'description' => 'required|max:50'
        //     ]
        // );

        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'qty' => 'required|numeric',
            'text' => 'required|numeric',
            'description' => 'required|string|max:50',
        ])->validate();;

        $product = new Products();
        $product->name = $validated['name'];
        $product->qty = $validated['qty'];
        $product->text = $validated['text'];
        $product->description = $validated['description'];
        $product->user_id = Auth::id();

        $product->save();

        // Products::create($request->all());
    }

    public function updateProducts(Products $product, Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|max:25',
            'qty' => 'numeric',
            'text' => 'numeric',
            'description' => 'required|string|max:50'
        ]);

        return $updated = $product->update($validated);
    }

    public function deleteProducts(Products $product)
    {
        $product->delete();
    }

    public function trashed()
    {
        return Products::onlyTrashed()->get();
    }

    public function trigger()
    {
        $product = Products::all();

        return $product;
    }
}
