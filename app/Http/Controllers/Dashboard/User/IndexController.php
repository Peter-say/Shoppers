<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
   public function home()
   {
      $user = auth()->user();
      return view('dashboard.user.index', [
         'user' => $user,
      ]);
   }
}
