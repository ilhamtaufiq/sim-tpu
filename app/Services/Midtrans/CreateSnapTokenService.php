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
        $data = Order::with('registrasi.ahliwaris')->where('id', $id)->get();
        
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->number,
                'gross_amount' => $this->order->total_price,
            ],
            'customer_details' => [
                'first_name' => $data->registrasi->ahliwaris->nama,
                'email' => 'ilhamtaufiq@gmail.com',
                'phone' => '085217795994',
            ]
        ];
 
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}