<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\SecondaryCategory;
use App\Models\Owner;
use App\Models\PrimaryCategory;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function($request,$next) {
            $id = $request->route()->parameter('product');
            if(!is_null($id)) {
                $productsOwnerId = Product::findOrFail($id)->shop->owner->id;
                $productId = (int)$productsOwnerId;
                $ownerId = Auth::id();
                if($productId !== $ownerId){
                    abort(404);
                }
            }
            return $next($request);

        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $owners = Owner::with('shop.product.imageFirst')
       ->where('id',Auth::id())->get();

        return view('owner.products.index',compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shops = Shop::where('owner_id',Auth::id())->select('id','name')
        ->get();

        $images = Image::where('owner_id',Auth::id())->select('id','title','filename')
        ->orderBy('updated_at','desc')->get();

        $categories = PrimaryCategory::with('secondary')->get();

        return view('owner.products.create',compact('shops','images','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
