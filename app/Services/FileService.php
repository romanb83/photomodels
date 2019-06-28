<?php

namespace App\Services;

use File;
use Auth;
use Storage;
use Image;

class FileService extends CoreService
{
    public function __construct()
    {
        parent::__construct();
    }

    ///////////////////////////////////////////////////////////////////
    //// Возвращает путь к папке зарегистрированного пользователя
    public function getPath()
    {
        $path = env('USER_PATH') . Auth::id() . '/';
        
        return $path;
    }

    public function getPathThumbs()
    {
        $path = env('USER_PATH') . Auth::id() . '/thumbs/';
        
        return $path;
    }

    ////////////////////////////////////////////////////////////////////
    //// Проверяет есть ли файл указанный в параметре, в папке переданной 
    //// методом getPath()
    public function fileis($fileName)
    {
        $result = File::isFile($this->getPath(). $fileName);

        return $result;
    }

    public function saveAvatar($file, $fileName)
    {   
        $img = Image::make($file);
        $div = $this->divPhoto($file);
        $img->fit(intdiv($img->width(), $div), intdiv($img->height(), $div))->save($this->getPath().$fileName, 60);
        $img->fit(200,200)->save($this->getPathThumbs().$fileName);
        
    }

    public function getFileSize($fileName)
    {
        $size = Storage::disk('user')->size(Auth::id().'/'.$fileName);

        return $size;
    }

    public function divPhoto($file)
    {
        $img = Image::make($file);
        $max = max($img->width(), $img->height());
        if ($max >= 10000) {
            echo 'Слишком большой файл';   // Нужно сделать вывод ошибки не через echo
        }
        elseif ($max >= 6000) {
            return 5;
        }
        elseif ($max >= 4000) {
            return 3;
        }
        elseif ($max >= 2000) {
            return 2;
        }
        elseif ($max < 2000) {
            return 1;
        }
    }
}
