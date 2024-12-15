<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $owner = DB::table('owners')->where('id_user', $user->id_user)->first();

        if (!$owner) {
            $totalReservasi = 0;
            $totalAmount = 0;
            $ownerName = null;
            $totalCustomer = 0;
            $totalKamar = 0;
            $totalRumah = 0;

        } else {
            $id_owner = $owner->id_owner;

            $totalReservasi = Reservation::join('rooms', 'reservations.id_room', '=', 'rooms.id_room')
                ->join('boarding_houses', 'rooms.id_house', '=', 'boarding_houses.id_house')
                ->where('boarding_houses.id_owner', $id_owner)
                ->where('reservations.reservation_status', 1)
                ->count();

            $totalAmount = Payment::join('reservations', 'payments.id_reservation', '=', 'reservations.id_reservation')
                ->join('rooms', 'reservations.id_room', '=', 'rooms.id_room')
                ->join('boarding_houses', 'rooms.id_house', '=', 'boarding_houses.id_house')
                ->where('boarding_houses.id_owner', $id_owner)
                ->where('payments.payment_status', 'paid')
                ->sum('payments.total_amount');

            $totalCustomer = Customer::join('reservations', 'customers.id_reservation', '=', 'reservations.id_reservation')
                ->join('rooms', 'reservations.id_room', '=', 'rooms.id_room')
                ->join('boarding_houses', 'rooms.id_house', '=', 'boarding_houses.id_house')
                ->where('boarding_houses.id_owner', $id_owner)
                ->where('customers.customer_status', 'active')
                ->count();

            $totalKamar = Room::join('boarding_houses', 'rooms.id_house', '=', 'boarding_houses.id_house')
                ->join('owners', 'boarding_houses.id_owner', '=', 'owners.id_owner')
                ->where('boarding_houses.id_owner', $id_owner)
                ->count();

            $totalRumah = BoardingHouse::join('owners', 'boarding_houses.id_owner', '=', 'owners.id_owner')
                ->where('boarding_houses.id_owner', $id_owner)
                ->count();

            $ownerName = $owner->name;
        }
        return view('dashboard.dashboard', compact('ownerName', 'totalReservasi', 'totalAmount', 'totalCustomer', 'totalKamar', 'totalRumah'));
    }
}
