<?php

namespace App\Http\Controllers;
use App\Book;
use DB;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        //$this->authorize('checkmember');
        $products = Book::all();
        return view('frontend.index', compact('products'));
    }
    public function cart()
    {
        //$this->authorize('checkmember');
        return view('frontend.cart');
    }
    public function addToCart($id)
    {
        //$this->authorize('checkmember');
        $book = Book::find($id);
        if(!$book)
        {
            abort('404');
        }

        $cart = session()->get('cart');
        if(!isset($cart[$id]))
        {
            if($book->stok <= 0)
                return redirect()->back()->with('error', 'Stok buku ini 0');
            else
            {
                $cart[$id]= [
                    'id' => $id,
                    'title' => $book->title,
                    'quantity' => 1,
                    'price' => $book->price,
                    'photo' => $book->gambar
                ];
            }
        }
        else
        {
            if($book->stok <= $cart[$id]['quantity'])
                return redirect()->back()->with('error', 'Stok buku ini 0');
            else
                $cart[$id]['quantity']++;
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart sucessfully');
    }
}
