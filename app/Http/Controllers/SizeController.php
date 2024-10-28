<?php

namespace App\Http\Controllers;

use App\Models\SizeModel;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    //
    public function getAllSizes() {
        return SizeModel::getAllSizes();
    }
}
