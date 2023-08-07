<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\SecondaryCategory;
use App\Models\Image;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'name',
        'information',
        'price',
        'is_selling',
        'sort_order',
        'secondary_category_id',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
    ];

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    public function category() {
        return $this->belongsTo(SecondaryCategory::class,'secondary_category_id');
    }

    public function imageFirst() {
        return $this->belongsTo(Image::class,'image1','id');
    }

    public function imageSecond() {
        return $this->belongsTo(Image::class,'image2','id');
    }

    public function imageThird() {
        return $this->belongsTo(Image::class,'image3','id');
    }

    public function imageFourth() {
        return $this->belongsTo(Image::class,'image4','id');
    }

    public function imageFifth() {
        return $this->belongsTo(Image::class,'image5','id');
    }

    public function stock() {
        return $this->hasMany(Stock::class);
    }
    public function users() {
        return $this->belongsToMany(User::class,'carts')
        ->withPivot(['id','quantity']);
    }

    public function scopeAvailableItems($query) {
        $stocks = DB::table('t_stocks')
        ->select('product_id',
        DB::raw('sum(quantity) as quantity'))
        ->groupBy('product_id')
        ->having('quantity', '>',1);

        return $query->joinSub($stocks,'stock',function($join){
            $join->on('products.id','=','stock.product_id');
        })
        ->join('shops','products.shop_id','=','shops.id')
        ->join('secondary_categories','products.secondary_category_id','=',
        'secondary_categories.id')
        ->join('images as image1','products.image1','=','image1.id')
        // ->join('images as image2','products.image2','=','image2.id')
        // ->join('images as image3','products.image3','=','image3.id')
        // ->join('images as image4','products.image4','=','image4.id')
        // ->join('images as image5','products.image5','=','image5.id') // 制作過程で必要なくなったので削除
        ->where('shops.is_selling',true)
        ->where('products.is_selling',true)       
        ->select('products.id as id', 'products.name as name', 'products.price','products.sort_order as sort_order','products.information','secondary_categories.name as category','image1.filename as filename');
    }

    public function scopeSortOrder($query,$sortOrder) {
        if($sortOrder === null || $sortOrder === \Constant::SORT_ORDER['recommend']) {
            return $query->orderBy('sort_order','asc');
        }

        if($sortOrder === \Constant::SORT_ORDER['higherPrice']){
            return $query->orderBy('price','desc');
        }

        if($sortOrder === \Constant::SORT_ORDER['lowerPrice']){
            return $query->orderBy('price','asc');
        }

        if($sortOrder === \Constant::SORT_ORDER['later']){
            return $query->orderBy('products_at','desc');
        }

        if($sortOrder === \Constant::SORT_ORDER['older']){
            return $query->orderBy('products_at','asc');
        }

    }
}
