<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class PembelianController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('barangs', 'barangs.id', '=', 'orders.barang_id')
            ->get();
        return view('pages.pembelian.index', compact('orders'));
    }
    public function delete($id)
    {

        Orders::where('id', $id)->delete();
        return redirect()->back()->with('delete', '1 Data Berhasil Dihapus.');
    }

    public function order_user($id)
    {
        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('barangs', 'barangs.id', '=', 'orders.barang_id')
            ->where('user_id', Auth::user()->id)
            ->get();
        // $orders = Orders::where('user_id', Auth::user()->id)->get();

        return view('pages.pembelian.index', compact('orders'));
    }
    public function order_user_api($user_id)
    {
        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('barangs', 'barangs.id', '=', 'orders.barang_id')
            ->where('orders.user_id', $user_id)
            ->select('orders.*', 'users.name as user_name', 'barangs.nama as barang_name')
            ->get();

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }
    public function store(Request $request, $id)
    {
        Orders::create([
            'user_id' => Auth::user()->id,
            'barang_id' => $id,
        ]);

        return redirect()->back()->with('success', '1 Data Berhasil Ditambahkan.');
    }
    // public function store_api($user_id, $id) NO MIDTRANS
    // {
    //     $order = Orders::create([
    //         'user_id' => $user_id,
    //         'barang_id' => $id,
    //     ]);

    //     // Return a JSON response
    //     if ($order) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Order created successfully',
    //             'data' => '',
    //         ], 201);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to create order',
    //         ], 500);
    //     }
    // }
    public function store_api($user_id, $id)
    {
        // Create the order in your database
        $order = Orders::create([
            'user_id' => $user_id,
            'barang_id' => $id,
        ]);

        $harga = DB::table('barangs')->where('id', $id)->first();

        // Initialize Midtrans configuration
        Config::$serverKey = 'SB-Mid-server-fEaX80yjErVaBHqIapHIch2c';
        Config::$isProduction = false; // Set to true for production environment

        // Create payment request
        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $harga->harga, // Or any other amount calculation
            ],
            'credit_card' => [
                'secure' => true,
            ],
        ];

        try {
            // Get Snap payment token
            $snapToken = Snap::getSnapToken($params);

            // Return payment token in the API response
            return response()->json([
                'success' => true,
                'message' => 'Payment request created successfully',
                'snap_token' => $snapToken,
            ], 201);
        } catch (\Exception $e) {
            // Handle error
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
