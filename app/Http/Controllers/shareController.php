<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class shareController extends Controller
{
    public function share(){
        
        $shareButtons = \Share::page(
            url('/index'),
            'Ayo Coba konvertan kami'
        )
        ->facebook()
        ->whatsapp()
        ->twitter();
    
        return view('converter.hasilShare',compact('shareButtons'));
    }
    

}

