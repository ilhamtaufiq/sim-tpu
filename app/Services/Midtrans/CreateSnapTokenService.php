<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
use App\Models\Order;
 
class CreateSnapTokenService extends Midtrans
{
    protected $order;
 
    public function __construct($order)
    {
        parent::__construct();
 
        $this->order = $order;
    }
 
    public function getSnapToken()
    {   
        $id = $this->order->id;  
        $data = Order::with('registrasi.ahliwaris')->where('id', $id)->first();
        foreach ($data->registrasi as $value) {
            # code...
            $params = [
                'transaction_details' => [
                    'order_id' => $this->order->number,
                    'gross_amount' => $this->order->total_price,
                ],
                'custom_field1' => [
                    'first_name' => $value->ahliwaris->nama,
                    'email' => $value->ahliwaris->email,
                    'phone' => $value->ahliwaris->no_telepon,
                ]
            ];
        }        
 
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}