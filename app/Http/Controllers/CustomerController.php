<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
use App\Models\Reservation;

class CustomerController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $customers = Customer::all();
        $payments = Payment::all();
        $reservations = Reservation::all();

        return view('dashboard.customer', compact('rooms', 'customers', 'reservations','payments'));
    }
}
