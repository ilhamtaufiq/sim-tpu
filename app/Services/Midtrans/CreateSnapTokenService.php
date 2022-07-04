<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
 
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
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->number,
                'gross_amount' => $this->order->total_price,
            ],
            'customer_details' => [
                'first_name' => 'Ilham Taufik',
                'email' => 'ilhamtaufiq@gmail.com',
                'phone' => '085217795994',
            ]
        ];
 
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}