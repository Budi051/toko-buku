<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function book()
    {
        return $this->belongsToMany('App\Book', 'book_order', 'order_id', 'book_id')
                     ->withPivot('quantity', 'harga_satuan', 'subtotal');
                    
    }

    public function insertProduct($cart, $user)
    {
        $total = 0;
        foreach($cart as $key => $detail)
        {
            $total += $detail['price'] * $detail['quantity'];
            $this->book()->attach($key, ['quantity' => $detail['quantity'],
                                        'harga_satuan' => $detail['price'],
                                        'subtotal' => $detail['price'] * $detail['quantity']
                                    ]);

            $q = $detail['quantity'];
            $id = $detail['id'];
            $update = DB::select(DB::raw("UPDATE books SET stok = stok + $q  WHERE id = $id"));
        }
        return $total;
    }
}
