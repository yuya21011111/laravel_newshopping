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
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use Illuminate\Support\Facades\Log;

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
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'information' => ['required', 'string','max:2000'],
            'price' => ['required','integer'],
            'sort_order' => ['nullable','integer'],
            'quantity' => ['required','integer'],
            'shop_id' => ['required','exists:shops,id'],
            'category' => ['required','exists:secondary_categories,id'],
            'image1' => ['nullable','exists:images,id'],
            'image2' => ['nullable','exists:images,id'],
            'image3' => ['nullable','exists:images,id'],
            'image4' => ['nullable','exists:images,id'],
            'image5' => ['nullable','exists:images,id'],
            'is_selling' => ['required']
        ]);

        try{
            DB::transaction(function () use($request) {
              $product = Product::create([
                    'name' => $request->name,
                    'information' => $request->information,
                    'price' => $request->price,
                    'sort_order' => $request->sort_order,
                    'shop_id' => $request->shop_id,
                    'secondary_category_id' => $request->category,
                    'image1' => $request->image1,
                    'image2' => $request->image2,
                    'image3' => $request->image3,
                    'image4' => $request->image4,
                    'image5' => $request->image5,
                    'is_selling' => $request->is_selling,

                ]);
                // dd($owner->shop_name);
                Stock::create([
                    'product_id' => $product->id,
                    'type' => 1,
                    'quantity' => $request->quantity,
                    
                ]);
            },2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
        
        // toasterに受け渡す値
        return redirect()
        ->route('owner.products.index')
        ->with(['message' => '商品登録を完了しました。',
               'status' => 'info']);
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
