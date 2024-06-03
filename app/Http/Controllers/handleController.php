<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class handleController extends Controller
{
    public function handleNotification(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false; // Set to true for production environment

        // Get the transaction status
        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;

        // Find the corresponding order
        $order = Orders::find($orderId);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found',
            ], 404);
        }

        // Update the order status based on the transaction status
        switch ($transactionStatus) {
            case 'capture':
            case 'settlement':
                $order->status = 'Success';
                break;
            case 'pending':
                $order->status = 'Pending';
                break;
            case 'deny':
            case 'expire':
            case 'cancel':
                $order->status = 'Failed';
                break;
        }

        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Notification processed successfully',
        ]);
    }
}
