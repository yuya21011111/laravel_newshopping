<?php 
namespace App\Services;
use Illuminate\Support\Facades\Storage;

class ImageService {
  public static function upload($imageFile,$folderName){
    if(is_array($imageFile)) {
        $file = $imageFile['image'];
    } else {
        $file = $imageFile;
    }
    $fileName = uniqid(rand().'');
    $extension = $file->extension();
    $fileNameToStore = $fileName.'.'.$extension;
    // dd($extension,$fileNameToStore);　

    Storage::putFileAs('public/' . $folderName . '/' , $file, $fileNameToStore );
    return $fileNameToStore;
  }
}