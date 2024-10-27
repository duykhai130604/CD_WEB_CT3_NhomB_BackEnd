<?php

namespace App\Http\Controllers;

use App\Models\ColorModel;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    //
    public function getAllColors(){
        return ColorModel::getAllColors();
    }
}
