<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

public function dashboard()
{
return view('user.dashboard');
}

public function lapangan()
{
$lapangan = Lapangan::all();
return view('user.lapangan',compact('lapangan'));
}

public function history()
{

$booking = Booking::where('user_id',auth()->id())->get();

return view('user.history',compact('booking'));

}

}
