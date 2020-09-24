<?php
namespace App\Services;

use App\Business;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Excepetion;
use Illuminate\Support\Str;

class ImageService
{

    /**
     * Class constructor
     *
     * @param User $model
     */
    public function __construct()
    {
    }

    protected function cleanText($text)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $text);
    }

    public function saveImage($image, $pathToSave)
    {
        if ($image) {
            $fileName = Str::random(10) . '_' . Carbon::now()->timestamp .  '.' . $image->getClientOriginalExtension();
            \Log::debug($fileName);
            $destinationPath = public_path($pathToSave);
            $image->move($destinationPath, $fileName);

            return $fileName;
        }

        return null;
    }

    public function updateImage($image, $oldImage, $pathToSave)
    {
        if (!empty($image)) {
            if ($oldImage) {
                unlink(public_path($pathToSave . $oldImage));
            }

            $fileName = $this->saveImage($image, $pathToSave);

            return $fileName;
        }

        return null;
    }

    public function destroy($image, $path)
    {
        unlink(public_path($path . $image));
    }
}
