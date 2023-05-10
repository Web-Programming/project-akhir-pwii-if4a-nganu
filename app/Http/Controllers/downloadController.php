<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class downloadController extends Controller
{
    public function dwnController(){
        $file_path = $_GET['filepath'];
        return Response::download(public_path($file_path));
    }
}
