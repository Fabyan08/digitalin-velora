<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Barangs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class PembelianController extends Controller
{
    public function index()
    {
        // Get unique snap tokens with the associated user_id
        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('barangs', 'barangs.id', '=', 'orders.barang_id')
            ->select('orders.snap_token', DB::raw('MAX(users.name) as username'))
            ->groupBy('orders.snap_token')
            ->orderByDesc('orders.created_at')
            ->get();

        // Display the orders
        return view('pages.pembelian.index', compact('orders'));
    }


    public function detail_web($snap_token)
    {
        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('barangs', 'barangs.id', '=', 'orders.barang_id')
            ->where('snap_token', $snap_token)
            ->get();
        return view('pages.pembelian.detail', compact('orders'));
    }

    public function delete($snap_token)
    {

        Orders::where('snap_token', $snap_token)->delete();
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
            ->select(
                'orders.snap_token',
                DB::raw('MIN(orders.created_at) as created_at'),
                DB::raw('SUM(orders.harga * orders.jumlah) as total_harga'),
            )
            ->groupBy('orders.snap_token')
            ->orderBy('created_at', 'desc') // Order by created_at in descending order
            ->get();

        return response()->json($orders);
    }

    public function store(Request $request, $id)
    {
        Orders::create([
            'user_id' => Auth::user()->id,
            'barang_id' => $id,
        ]);

        return redirect()->back()->with('success', '1 Data Berhasil Ditambahkan.');
    }




    public function store_api(Request $request)
    {
        $user_id = $request->input('user_id');
        $items = $request->input('items');

        $totalAmount = 0;
        $orderItems = [];

        foreach ($items as $item) {
            $product = DB::table('barangs')->where('id', $item['id'])->first(['harga', 'nama']);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found',
                ], 404);
            }

            $itemAmount = $product->harga * $item['jumlah'];
            $totalAmount += $itemAmount;

            $orderItems[] = [
                'user_id' => $user_id,
                'barang_id' => $item['id'],
                'harga' => $product->harga,
                'nama' => $product->nama,
                'jumlah' => $item['jumlah'],
                'status' => 'Pending',
                'snap_token' => '', // Temporary placeholder
            ];
        }

        \Midtrans\Config::$serverKey = "SB-Mid-server-fEaX80yjErVaBHqIapHIch2c";
        \Midtrans\Config::$isProduction = false; // Set to true for production environment

        // Create payment request with all items
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(), // Unique order ID
                'gross_amount' => $totalAmount, // Use the calculated total amount
            ],
            'credit_card' => [
                'secure' => true,
            ],
            'item_details' => array_map(function ($item) {
                return [
                    'id' => $item['barang_id'],
                    'price' => $item['harga'],
                    'quantity' => $item['jumlah'],
                    'name' => $item['nama']
                ];
            }, $orderItems)
        ];

        try {
            // Get Snap payment token
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Update the order items with the Snap token
            foreach ($orderItems as &$orderItem) {
                $orderItem['snap_token'] = $snapToken;
            }

            // Insert order items into the orders table
            DB::table('orders')->insert($orderItems);

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

    public function detail($snap_token)
    {
        // Retrieve the orders associated with the given snap_token
        $orders = Orders::where('snap_token', $snap_token)->get();
        $status = Orders::where('snap_token', $snap_token)->first();

        // Calculate the total price by multiplying harga and jumlah for each order
        $total_harga = $orders->reduce(function ($carry, $order) {
            return $carry + ($order->harga * $order->jumlah);
        }, 0);

        // Construct the response array
        $response = [
            'success' => true,
            'orders' => $orders,
            'total_harga' => $total_harga,
            'status' => $status->status,
        ];

        // Return the response as JSON
        return response()->json($response);
    }

    public function update_status($snap_token)
    {
        Orders::where('snap_token', $snap_token)->update([
            'status' => 'Success'
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
        ], 200);
    }
}
