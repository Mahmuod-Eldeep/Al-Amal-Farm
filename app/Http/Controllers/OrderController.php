<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderColletion;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Services\CalculateOrdersServices;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return new OrderColletion(Order::paginate());
    }


    public function show(Request $request, Order $Order)
    {
        return new OrderResource($Order);
    }

    public function store(StoreOrderRequest $request)
    {
        if ($request->Status == true) {
            $validated = $request->validated();
            $product = Product::where('id', $request->product_id)->first();

            if ($product->stock < $request->Number_of_pieces_in_order) {
                return response()->json(['error' => 'There is no such quantity of products'], 422);
            }
            $newProductCount =  $product->stock - $request->Number_of_pieces_in_order;
            $product->stock = $newProductCount;
            $product->save();


            $Order = Order::create($validated);
            return new OrderResource($Order);
        }


        $validated = $request->validated();
        $Order = Order::create($validated);
        return new OrderResource($Order);
    }

    public function update(UpdateOrderRequest $request, Order $Order)
    {

        $validated = $request->validated();

        if ($request->Status == true) {

            $product = Product::where('id', $Order->product_id)->first();
            $Order = Order::find($Order->id);

            if ($product->stock < $request->Number_of_pieces_in_order) {
                return response()->json(['error' => 'There is no such quantity of products'], 422);
            } elseif ($Order->Number_of_pieces_in_order != $validated['Number_of_pieces_in_order'] || $Order->Status != $validated['Status']) {

                $newProductCount =  $product->stock - $request->Number_of_pieces_in_order;
                $product->stock = $newProductCount;
                $product->save();
                $Order->update($validated);
                return new OrderResource($Order);
            }
        }

        if ($request->Status == false) {
            $validated = $request->validated();
            $Order->update($validated);

            return new OrderResource($Order);
        }

        return
            response()->json(['error' => 'Data is incorrect'], 422);
    }




    public function destroy(Request $request, Order $Order)
    {
        $Order->delete();
        return response()->noContent();
    }
}
