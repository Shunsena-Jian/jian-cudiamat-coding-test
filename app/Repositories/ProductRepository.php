<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Interfaces\ProductInterface;
use App\Models\products;

class ProductRepository implements ProductInterface
{

    public function addProduct($request, $email)
    {
        return products::create([
            'product_name' => $request->product_name,
            'product_desc' => $request->product_desc,
            'product_price' => $request->product_price,
            'product_owner' => $email,
            'product_owner' => $email
        ]);
    }

    public function editProduct($request)
    {
        $product = products::where('id', $request->product_id)->first();

        $product->update([
            'product_name' => $request->product_name,
            'product_desc' => $request->product_desc,
            'product_price' => $request->product_price,
        ]);

        return 200;
    }

    public function deleteProduct($request)
    {
        $product = products::where('id', $request->product_id)->first();

        $product->delete();

        return 200;
    }

    public function viewProductDetails($request)
    {
        $product = products::where('id', $request->product_id)->first();

        return $product;
    }

    public function retrieveOwnedProducts($email)
    {
        $products = products::where('product_owner', $email)->get();

        return $products;
    }

}

?>
