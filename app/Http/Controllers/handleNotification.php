<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Midtrans\Notification;

class handleNotification extends Controller
{
    public function index()
    {
        // Set Midtrans configuration
        \Midtrans\Config::$serverKey = "SB-Mid-server-fEaX80yjErVaBHqIapHIch2c";
        \Midtrans\Config::$isProduction = false; // Set to true for production environment
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        try {
            // Create a notification instance
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $orderId = $notification->order_id;
            $fraudStatus = $notification->fraud_status;

            // Find the order by ID
            $order = Orders::find($orderId);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found',
                ], 404);
            }

            // Handle the notification status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $order->status = 'Pending';
                } else if ($fraudStatus == 'accept') {
                    $order->status = 'Success';
                }
            } else if ($transactionStatus == 'settlement') {
                $order->status = 'Success';
            } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $order->status = 'Failed';
            }

            // Save the order status
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Notification handled successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to handle notification',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
