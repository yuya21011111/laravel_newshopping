<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Stock;


class CartController extends Controller
{

    public function index() {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        $totalPrice = 0;

        foreach($products as $product) {
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        // dd($products,$totalPrice);
        return view('user.cart',compact('products','totalPrice'));
    }

    public function add(Request $request) {
        $itemInCart = Cart::where('user_id',Auth::id())
        ->where('product_id',$request->product_id)->first();

        if($itemInCart){
            $itemInCart->quantity += $request->quantity;
            $itemInCart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }
        
        return redirect()->route('user.cart.index');
    }

    public function checkout() {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        $lineItems = [];
        foreach($products as $product) {
            $quantity = '';
            $quantity = Stock::where('product_id',$product->id)->sum('quantity');

            if($product->pivot->quantity > $quantity) {
                return redirect()->route('user.cart.index');
            }
            else {
                $lineItem = [
                    'price_data' => [
                        'unit_amount' => $product->price,
                        'currency' => 'JPY',
 
                    'product_data' => [
                        'name' => $product->name,
                        'description' => $product->information,
                ],
            ],
                'quantity' => $product->pivot->quantity,
            ];
                array_push($lineItems, $lineItem);
            }
        }

        foreach($products as $product) {
            Stock::create([
                'product_id' => $product->id,
                'type' => '2',
                'quantity' => $product->pivot->quantity * -1,
            ]);
        }

        
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('user.cart.success'),
            'cancel_url' => route('user.cart.cancel'),
        ]);

        $publicKey = env('STRIPE_PUBLIC_KEY');

        return view('user.checkout',compact('session','publicKey'));
    }

    public function delete($id) {
        Cart::where('product_id',$id)
        ->where('user_id',Auth::id())->delete();
        return redirect()->route('user.cart.index');
    }
    
    public function success() {
        Cart::where('user_id',Auth::id())->delete();

        return redirect()->route('user.items.index')
        ->with(['message' => '決済に成功しました。',
                   'status' => 'info']);
    }

    public function cancel() {
        $user = User::findOrFail(Auth::id());
        foreach($user->products as $product) {
            Stock::create([
                'product_id' => $product->id,
                'type' => '1',
                'quantity' => $product->pivot->quantity
            ]);
        }

        return redirect()->route('user.cart.index')
        ->with(['message' => '決済をキャンセルしました。',
        'status' => 'alert']);
    }
}
