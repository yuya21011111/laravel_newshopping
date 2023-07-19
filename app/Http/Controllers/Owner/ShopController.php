<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function($request,$next) {
            $id = $request->route()->parameter('shop');
            if(!is_null($id)) {
                $shopsOwnerId = Shop::findOrFail($id)->owner->id;
                $shopId = (int)$shopsOwnerId;
                $ownerId = Auth::id();
                if($shopId !== $ownerId){
                    abort(404);
                }
            }
            return $next($request);

        });
    }

    public function index() {
        $ownerId = Auth::id();
        $shops = Shop::where('owner_id',$ownerId)->get();

        return view('owner.shops.index',compact('shops'));
    }

    public function edit($id) {
        $shop = Shop::findOrFail($id);
        return view('owner.shops.edit',compact('shop'));

    }

    public function update(Request $request,$id) {
        $imageFile = $request->image;
        if(!is_null($imageFile) && $imageFile->isValid()){
           $fileNameToStore = ImageService::upload($imageFile,'shops');
            // Storage::putFile('public/shops',$imageFile);
            // $fileName = uniqid(rand().'');
            // $extension = $imageFile->extension();
            // $fileNameToStore = $fileName.'.'.$extension;
            // Storage::putFileAs('public/shops/' . $fileNameToStore);
        }
        return redirect()
        ->route('owner.shops.index')
        ->with(['message' => '画像登録を更新しました。',
               'status' => 'info']);

    }
}
