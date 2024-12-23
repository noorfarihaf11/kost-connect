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

        return view('dashboard.customer', compact('rooms', 'customers', 'reservations', 'payments'));
    }

    public function update(Request $request, $id)
    {
        try {
            $customer = Customer::findOrFail($id);

            $customer->customer_status = $request->customer_status;
            $customer->save();

            if ($customer->customer_status == 'inactive') {
                $customer->end_date = now();
                $customer->save();

                if ($customer->reservation) {
                    $room = $customer->reservation->room;
                    $room->available_rooms += 1;
                    $room->save();
                }
            }

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Anda sudah tidak menjadi penghuni kost ini']);
            }

            return redirect('status-reservasi')->with('success', 'Anda sudah tidak menjadi penghuni kost ini');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Update failed: ' . $e->getMessage()]);
            }

            return redirect('status-reservasi')->with('error', 'Update failed: ' . $e->getMessage());
        }
    }
}
