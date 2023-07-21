<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
