<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            $customers = [];
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

            $customers = Customer::join('reservations', 'customers.id_reservation', '=', 'reservations.id_reservation')
                ->join('rooms', 'reservations.id_room', '=', 'rooms.id_room')
                ->join('boarding_houses', 'rooms.id_house', '=', 'boarding_houses.id_house')
                ->where('boarding_houses.id_owner', $id_owner)
                ->where('customers.customer_status', 'active')
                ->get();

            $ownerName = $owner->name;
        }
        return view('dashboard.dashboard', compact('ownerName', 'totalReservasi', 'totalAmount', 'totalCustomer', 'totalKamar', 'totalRumah', 'customers'));
    }


    public function laporanPembayaran(Request $request)
    {
        $user = Auth::user();
    
        // Get the current date and current month
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
    
        if (Gate::allows('admin') || Gate::allows('owner')) {
            // Fetch all payments, filter by date if necessary
            if ($request->input('report_type') === 'daily') {
                $payments = Payment::with(['reservation.user'])
                    ->whereDate('updated_at', $today)  // Filter by today's date
                    ->get();
            } elseif ($request->input('report_type') === 'monthly') {
                $payments = Payment::with(['reservation.user'])
                    ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])  // Filter by this month's date range
                    ->get();
            } else {
                $payments = Payment::with(['reservation.user'])->get();
            }
        } else {
            // For a specific user
            if ($request->input('report_type') === 'daily') {
                $payments = Payment::with(['reservation.user'])
                    ->whereHas('reservation', function ($query) use ($user) {
                        $query->where('id_user', $user->id_user);
                    })
                    ->whereDate('updated_at', $today)
                    ->get();
            } elseif ($request->input('report_type') === 'monthly') {
                $payments = Payment::with(['reservation.user'])
                    ->whereHas('reservation', function ($query) use ($user) {
                        $query->where('id_user', $user->id_user);
                    })
                    ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                    ->get();
            } else {
                $payments = Payment::with(['reservation.user'])
                    ->whereHas('reservation', function ($query) use ($user) {
                        $query->where('id_user', $user->id_user);
                    })
                    ->get();
            }
        }
    
        $rooms = Room::all();
        $reservations = Reservation::where('id_user', $user->id_user)->get();
    
        return view('dashboard.laporanpembayaran', compact('rooms', 'payments', 'reservations'));
    }
    
}
