<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function($request,$next) {
            $id = $request->route()->parameter('image');
            if(!is_null($id)) {
                $imagesOwnerId = Image::findOrFail($id)->owner->id;
                $imageId = (int)$imagesOwnerId;
                $ownerId = Auth::id();
                if($imageId !== $ownerId){
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
        $images = Image::where('owner_id',Auth::id())
        ->orderby('updated_at','desc')
        ->paginate(20);

        return view('owner.images.index',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner.images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UploadImageRequest $request)
    {
        $imageFails = $request->file('files');
        if(!is_null($imageFails)){
            foreach($imageFails as $imageFail) {
                $fileNameToStore = ImageService::upload($imageFail,'products');
                Image::create([
                    'owner_id' => Auth::id(),
                    'filename' => $fileNameToStore
                ]);
            }
        }
        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像登録を更新しました。',
               'status' => 'info']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image = Image::findOrFail($id);

        return view('owner.images.edit',compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['string','max:50']
        ]);

        $image = Image::findOrFail($id);
        $image->title = $request->title;
        $image->save();

        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像タイトルを更新しました。',
               'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Image::findOrFail($id);
        $imageInProducts = Product::where('image1',$image->id)
        ->orWhere('image2',$image->id)
        ->orWhere('image3',$image->id)
        ->orWhere('image4',$image->id)
        ->orWhere('image5',$image->id)
        ->get();
        if($imageInProducts) {
            $imageInProducts->each(function($product) use($image){
                if($product->image1 === $image->id) {
                    $product->image1 = null;
                    $product->save();
                }
                if($product->image2 === $image->id) {
                    $product->image2 = null;
                    $product->save();
                }
                if($product->image3 === $image->id) {
                    $product->image3 = null;
                    $product->save();
                }
                if($product->image4 === $image->id) {
                    $product->image4 = null;
                    $product->save();
                }
                if($product->image5 === $image->id) {
                    $product->image5 = null;
                    $product->save();
                }
            });
        }
        $filePath = 'public/products/' . $image->filename;
        if(Storage::exists($filePath)){
            Storage::delete($filePath);
        }
        $image::findOrFail($id)->delete();
        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像を削除しました。',
               'status' => 'alert']);

    }
}
