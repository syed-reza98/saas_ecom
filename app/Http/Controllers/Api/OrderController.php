<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Facade\Ecourier;

use Xenon\NagadApi\Helper;
use Xenon\NagadApi\Base;
use App\Library\SslCommerz\SslCommerzNotification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Ecourier::order()->packageList();
        // "package_code" => "#7453",
        $eCourier = Ecourier::order()->create([
            "product_id" => "AS321",
            "ep_name" => "Test Order",
            "pick_contact_person" => "Test Order",
            "pick_division" => "Dhaka",
            "pick_district" => "Dhaka",
            "pick_thana" => "Badda",
            "pick_hub" => "18490",
            "pick_union" => "1212",
            "pick_address" => "Test Order",
            "pick_mobile" => "01700000000",
            "recipient_name" => "Test Order",
            "recipient_mobile" => "01700000000",
            "recipient_division" => "Barisal",
            "recipient_district" => "Barisal",
            "recipient_city" => "Barisal",
            "recipient_area" => "Test Order",
            "recipient_thana" => "Babuganj",
            "recipient_union" => "8216",
            "package_code" => "#2416",
            "recipient_address" => "Test Order",
            "parcel_detail" => "Test Order",
            "number_of_item" => "1",
            "product_price" => "10",
            "payment_method" => "COD",
            "ep_id" => "32132212",
            "actual_product_price" => 10,
        ]);

        $data = json_decode($eCourier->content(), true);
        dd($data['ID']);
    }

    /**
     * Store a newly created resource in storage.
     */

    //  "customer_id":3,
    //  "number":232323,
    //  "total_price":5100,
    //  "shipping_price":210,
    //  "status":"pending",

    //  "product_id":17,
    //  "quantity":2,
    //  "unit_price":2550
    public function payment()
    {
        // $config = [
        //     'NAGAD_APP_ENV' => 'development',
        //     'NAGAD_APP_LOG' => '1',
        //     'NAGAD_APP_ACCOUNT' => '01886071111',
        //     'NAGAD_APP_MERCHANTID' => '688860711115331',
        //     'NAGAD_APP_MERCHANT_PRIVATE_KEY' => 'MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCbBPc2oc4gXtwBHM03aboGhN5vvxBK46gvqQSq3IBUzln/vXkpUwSNJsWs5orHb6rO4FRd/4pUFXv9sbXqCePCQiHm0bE7ZkLHRK1DsGgG/KEFr0ehWTSFUAeT0EbtZ1HiI5UWjDp5v7zhdlXPHdExll0e1oPpHYKmhIVGwxBQXcFgJWPD61Os8TMQjGuAxx2TvO3IWgs/49qBSEKms3vnoq9qQ0ORfhLrsUbtJeYXEsTabu5M08/j5ixH9H5ahxK5Gn++KtXKjtNXeJOVd8iaSsBCMkM0VCzSvEcGQtFyk9for37wNRShXbA0ro8rNhKn9FL4Kr3VFolsSpmReR2RAgMBAAECggEAcMfsE5Mko+hfp2+M3gPNk3CXZDVdZR67/fC5tJU3yHtYfvcabzY22Xqb1m7kCLT1UA1lU/3WZdY7nxbrgpovWeVDROrKRqzfaJpOdDCjfnHNtJURSBHeZB8VZDTjZVUF/cBld0IOSQV2JZIyW70VtT3wAb+PuMn/g6ZmUFUaSVzKk4mjuyD0fc1mYkcSqwrAjVmyzUGtQ9d/dnDYXophunpW3A1+WYFFEvoP2KCb/CAjquDhSR/aLv01tKMxvC86uXAY2cSmIbDbIP64kdt1wRxfQMqAvsmdedF4t7rM40s356WWor0fXKNK+PsF+5dlhG9TNuRjJohpD4rexyiAAQKBgQDNUUBB724q+Dbp3QGo9WlPPM+RJXsF4YsjmidgUYzVRCCmgLjgA2drrXoyO8CYp+p+Z7jWX8rSvW3sQdkjdNlPIQvi+Srm2ZPfUk72zdQfqpLDEJEmMWQ6Yd09iVr9T5CttdyZj/FlvieJJEvlC0iZXszsfN/rmT0RpkPq29Yo8QKBgQDBSTPedD+8/Ij0Efdnjv0DeM4XW82GiqYDHNFtavTS8Kw1Hpttp4TK3wkxHQiVyN0xxYAUQ59Ogm92ZHhFbIvLR2tK7xtsgH3kHhu67gSFY8QvjM8mlUP7s0hCIvFs40/9mRDB8CMHD4ZZFNIBHK1hxRcffWYr3G6EW+k5x88+oQKBgEAVFxA9Uc5ZkJInp8f7aPYRTdvIrgAk6E+hYp7edS1vSR2O2aUZiuMBzzz0h2VeK4NujjNizKQ/+Zoe5034v4bCErqx+GD7EftG7lx727RSgeIePp+EFPtf5jS5tUuQ1OBS/dp0Ie0Wj7JvQLzpa6xq+VzqkN0xA+2JTnN0UACRAoGAbozb6eQ7gHBANLkB9G1IMXArEBkl2En84dLdxeNi3DNji45R/8nMnewrabfdbS5RtWHs+6oht9nKvsCAOdT3r/DNYTKZUNm9J3hBDA2O8Gw7jabP5JWDKLdGIO2zgEATRE0D1Kjwn901TkYmRxSL5lu/+fbTNUsCuxmGr9Gkq4ECgYA54Hws3YKtIZBK0lQHEyvhYqgG5Tq6sgZEK/Edfg8Itho3Hs2XSHRV4mkkvWJPsuYbfzNVm0ezRWNpFKTrveTA5vzLUn4LYw/3n6lC9ULjWOG9yLZQWeL6Q18BHpFUpPUZwmaTxvJsGzzvxY/02WGO+44pfHBCGHfkP5zu2pIyTA==',
        //     'NAGAD_APP_MERCHANT_PG_PUBLIC_KEY' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiCWvxDZZesS1g1lQfilVt8l3X5aMbXg5WOCYdG7q5C+Qevw0upm3tyYiKIwzXbqexnPNTHwRU7Ul7t8jP6nNVS/jLm35WFy6G9qRyXqMc1dHlwjpYwRNovLc12iTn1C5lCqIfiT+B/O/py1eIwNXgqQf39GDMJ3SesonowWioMJNXm3o80wscLMwjeezYGsyHcrnyYI2LnwfIMTSVN4T92Yy77SmE8xPydcdkgUaFxhK16qCGXMV3mF/VFx67LpZm8Sw3v135hxYX8wG1tCBKlL4psJF4+9vSy4W+8R5ieeqhrvRH+2MKLiKbDnewzKonFLbn2aKNrJefXYY7klaawIDAQAB',

        //     'NAGAD_APP_TIMEZONE' => 'Asia/Dhaka',
        // ];

        // $nagad = new Base($config, [
        //     'amount' => 10,
        //     'invoice' => Helper::generateFakeInvoice(15, true),
        //     'merchantCallback' => 'https://allorabd.com/nagad-pay/payment/confirmation/',
        // ]);


        //     $status = $nagad->payNow($nagad);
        //     return response()->json($status);

    }
    public function store(Request $request)
    {
        // header("Access-Control-Allow-Origin: http://localhost:3000");
        // // header("Access-Control-Allow-Methods: POST");
        // // Access-Control-Allow-Credentials
        // header("Access-Control-Allow-Credentials: true");
        // header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        // header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization');
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'total_price' => 'required',
            'shipping_price' => 'required',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required',
        ]);

        // Create the order
        $user = User::find($validatedData['customer_id']);
        $order = Order::create([
            'customer_id' => $user->customer->id,
            'number' => random_int(100000, 99999999),
            'total_price' => $validatedData['total_price'],
            'shipping_price' => $validatedData['shipping_price'],
            'status' => "pending",
        ]);

        // Create the order items
        foreach ($validatedData['items'] as $itemData) {
            $order->items()->create([
                'product_id' => $itemData['product_id'],
                'quantity' => $itemData['quantity'],
                'unit_price' => $itemData['unit_price'],
            ]);
        }

        // return response()->json([$order, $orderItem], 201);
        $post_data = array();
        $post_data['total_amount'] = $order->total_price; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user->customer->name;
        $post_data['cus_email'] = $user->email;
        $post_data['cus_add1'] = $user->customer->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $user->customer->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = $order->number;
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        // $update_product = DB::table('orders')
        //     ->where('transaction_id', $post_data['tran_id'])
        //     ->updateOrInsert([
        //         'name' => $post_data['cus_name'],
        //         'email' => $post_data['cus_email'],
        //         'phone' => $post_data['cus_phone'],
        //         'amount' => $post_data['total_amount'],
        //         'status' => 'Pending',
        //         'address' => $post_data['cus_add1'],
        //         'transaction_id' => $post_data['tran_id'],
        //         'currency' => $post_data['currency']
        //     ]);
        $order->update(['notes' => $post_data['tran_id']]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

        // return response()->json(['message' => 'Order created successfully'], 201);
        // $ssldata['message'] = 'Order created successfully';
        // $ssldata['url'] = $payment_options;
        // echo "Invalid Transaction";
        // return response()->json($ssldata, 200);
        // return response()->json([
        //     'message' => 'Order created successfully',
        //     'data' => [
        //         'url' => $payment_options
        //     ]
        // ], 200);
    }

    public function storeF(Request $request)
    {
        $order = Order::create($request->all());

        // Need to add OrderItems
        $orderItem = OrderItem::create(
            [
                'order_id' => $order->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
            ]
        );

        return response()->json([$order, $orderItem], 201);
    }

    public function showNew(string $id)
    {
        $user = User::find($id);
        $order = $user->customer->orders()->latest()->first();
        $orderItems = $order->items()->get();
        // $orderItems->each(function ($orderItem) {
        //     $orderItem->product = $orderItem->product()->get();
        // });
        $products = $order->products;
        $products->each(function ($product) {
            $product->image_url = asset('storage/' . $product->image_url);
        });


        // echo "Transaction is Successful";
        $post_data = array();
        $post_data['total_amount'] = $order->total_price; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $order->notes; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user->customer->name;
        $post_data['cus_email'] = $user->email;
        $post_data['cus_add1'] = $user->customer->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $user->customer->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = $order->number;
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        $tran_id = $order->notes;
        $amount = $order->total_price;
        $currency = "BDT";

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        // $order_details = DB::table('orders')
        //     ->where('transaction_id', $tran_id)
        //     ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order->status == 'pending') {
            $validation = $sslc->orderValidate($post_data, $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                // $update_product = DB::table('orders')
                //     ->where('transaction_id', $tran_id)
                //     ->update(['status' => 'Processing']);
                $order->update(['status' => $post_data['processing']]);

                // echo "<br >Transaction is successfully Completed";
                // return response()->json(['message' => 'Order created successfully'], 201);
                $orderData = [
                    'order' => $order,
                    'products' => $products,
                    'orderItems' => $orderItems,
                ];
                $orderData['message'] = 'Transaction is successfully Completed';
                return response()->json($orderData, 201);
            }
        } else if ($order->status == 'processing' || $order->status == 'completed') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            // echo "Transaction is successfully Completed";
            $orderData = [
                'order' => $order,
                'products' => $products,
                'orderItems' => $orderItems,
            ];
            $orderData['message'] = 'Transaction is successfully Completed';
            return response()->json($orderData, 201);
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            $orderData = [
                'order' => $order,
                'products' => $products,
                'orderItems' => $orderItems,
            ];
            $orderData['message'] = 'Invalid Transaction';
            // echo "Invalid Transaction";
            return response()->json($orderData, 201);
        }



        // return response()->json($orderData, 201)
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
