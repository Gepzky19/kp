<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
     public function showProfil() {
        return view('profil.index');
    }
}
