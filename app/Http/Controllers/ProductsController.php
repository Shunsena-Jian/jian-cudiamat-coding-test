<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class ProductsController extends Controller
{
    private $postInterface;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }

    public function addProduct(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'product_name' => 'required|string|max:255',
                'product_desc' => 'required|string',
                'product_price' => 'required|numeric|decimal:0,2',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status_code' => 422,
                    'errors' => $validator->errors()
                ]);
            }

            $email = auth()->user()->email;
            $products = $this->productInterface->addProduct($request, $email);

            if ($products) {
                return response()->json([
                    'status_code' => 200
                ]);
            } else {
                return response()->json([
                    'status_code' => 400
                ]);
            }
        }catch(Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    public function viewProductDetails(Request $request)
    {
        $cacheKey = 'product_details_' . $request->product_id;

        return Cache::remember($cacheKey, 60, function () use ($request) {
            try {
                $product = $this->productInterface->viewProductDetails($request);

                if ($product) {
                    return response()->json([
                        'status_code' => 200,
                        'product' => $product
                    ]);
                } else {
                    return response()->json([
                        'status_code' => 400
                    ]);
                }

            } catch (Exception $e) {
                return back()->with('failed', $e->getMessage());
            }
        });
    }


    public function editProduct(Request $request)
    {
        try{

            $validator = Validator::make($request->all(), [
                'product_name' => 'required|string|max:255',
                'product_desc' => 'required|string',
                'product_price' => 'required|numeric|decimal:0,2'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status_code' => 422,
                    'errors' => $validator->errors()
                ]);
            }

            $product = $this->productInterface->editProduct($request);

            if ($product == 200) {
                return response()->json([
                    'status_code' => 200
                ]);
            } else {
                return response()->json([
                    'status_code' => 400
                ]);
            }

        }catch(Exception $e){
            return back()->with('failed', $e->getMessage());
        }
    }

    public function deleteProduct(Request $request)
    {
        try{
            $product = $this->productInterface->deleteProduct($request);

            if($product == 200){
                return response()->json([
                    'status_code' => 200
                ]);
            } else {
                return response()->json([
                    'status_code' => 400
                ]);
            }
        }catch(Exception $e){
            return back()->with('failed', $e->getMessage());
        }
    }

    public function retrieveOwnedProducts()
    {
        $cacheKey = 'owned_products_' . auth()->user()->id;

        return Cache::remember($cacheKey, 60, function () {
            try {
                $email = auth()->user()->email;
                $products = $this->productInterface->retrieveOwnedProducts($email);

                if ($products) {
                    return DataTables::of($products)->make(true);
                }
            } catch (Exception $e) {
                return back()->with('failed', $e->getMessage());
            }
        });
    }

}
