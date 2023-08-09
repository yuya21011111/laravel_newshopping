<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use App\Models\PrimaryCategory;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:users');
        
        // アイテムが存在しない場合は404エラー
        $this->middleware(function($request,$next) {
            $id = $request->route()->parameter('item');
            if(!is_null($id)) {
                $itemId = Product::availableItems()->where('products.id',$id)->exists();
                if(!$itemId){
                    abort(404);
                }
            }
            return $next($request);

        });
    }

    public function index(Request $request) {
         // ローカルスコープ
         dd($request);
        $products = Product::availableItems()
        ->sortOrder($request->sort)
        ->paginate($request->pagination ?? '20');
        $categories = PrimaryCategory::with('secondary')->get();

        return view('user.index',compact('products','categories'));
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id',$product->id)
        ->sum('quantity');
        
        // 数量が９より大きければ９で固定する
        if($quantity > 9) {
            $quantity = 9;
        }
        return view('user.show',compact('product','quantity'));
    }
}
