<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;
use DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('bukanmember');
        $query = Book::all();
        return view('book.index',compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('bukanmember');
        $categori = Category::all();
        return view('book.createform',compact('categori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('bukanmember');
        $data = new Book;
        $data->title = $request->get('namaBuku');
        $data->price = $request->get('hargaBuku');
        $data->idKategori = $request->get('kategori');
        $data->publisher = $request->get('publisherBuku');
        $data->stok = $request->get('stokBuku');

        $gambar = $request->file('gambar');
        $namaGambar = time().'_'.$request->get('namaBuku').".".$gambar->getClientOriginalExtension();
        $gambar->move('images',$namaGambar);
        $data->gambar = $namaGambar;

        $data->save();

        return redirect()->route('books.index')->with('status','Data Buku berhasil ditambah!!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $this->authorize('bukanmember');
        $data = $book;
        return view('book.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $this->authorize('bukanmember');
        $data = $book;
        return view('book.editform',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->authorize('bukanmember');
        $book->title = $request->get('book');
        $book->price = $request->get('price');
        $book->stok = $request->get('stok');
        $book->publisher = $request->get('publisher');
        $book->idKategori = $request->get('category_id');

        if($request->file('gambar') != null)
        {
            $gambar = $request->file('gambar');
            $namaGambar =  time().'_'.$request->get('book').".".$gambar->getClientOriginalExtension();
            $gambar->move('images',$namaGambar);
            $book->gambar = $namaGambar;
        }

        $book->save();
        return redirect()->route('books.index')->with('status','Data Buku berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $this->authorize('checkadmin');
        try
        {
            $book->delete();
            unlink('images/'.$book->gambar);
            return redirect()->route('books.index')->with('status', 'Data Buku berhasil dihapus');
        }
        catch (\PDOException $e)
        {
            return redirect()->route('books.index')->with('error', 'Data gagal dihapus. Pastikan data child sudah hilang atau 
            tidak berhubungan');
        }
    }

    public function getDataFirst(Request $request)
    {
        $this->authorize('bukanmember');
        $id = $request->id;
        $book = Book::find($id);
        $category = Category::all();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('book.editformmodal', compact('book','category'))->render()
        ),200);
    }

    public function front_index()
    {
        // $cart = session()->get('cart');
        // print_r($cart);
        $book = Book::all();
        return view('frontend.index', compact('book'));
    }

    public function changeFoto(Request $request)
    {
        $id = $request->id;
        $book = Book::find($id);

        $file = $request->file('foto');
        $imgFolder = 'images';
        $imgFile = time().'_'.$book->title.".".$file->getClientOriginalExtension();
        $file->move($imgFolder, $imgFile);

        $book->gambar = $imgFile;
        $book->save();
        return redirect()->route('books.index')->with('status', 'Foto berhasil diubah');
    }
}
