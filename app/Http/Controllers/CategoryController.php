<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('bukanmember');
        $query = Category::all();
        return view('category.index',compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('bukanmember');
        return view('category.createform');
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
        $data = new category;
        $data->name = $request->get('nama');
        $data->save();

        return redirect()->route('book_category.index')->with('status','Data Kategori berhasil ditambah!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $book_category)
    {
        $this->authorize('bukanmember');
        $book_category->name = $request->get('namaKategori');
        $book_category->save();
        return redirect()->route('book_category.index')->with('status','Data Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $book_category)
    {
        $this->authorize('checkadmin');
        try 
        {
            $book_category->delete();
            return redirect()->route('book_category.index')->with('status','Data Kategori berhasil dihapus');
        } 
        catch (\PDOException $e) 
        {
            $msg="Data Gagal dihapus. Pastikan data child sudah hilang atau tidak berhubungan";
            return redirect()->route('book_category.index')->with('error', $msg);
        }
    }

    //HINT untuk bantuan menghapus data child
    private function handleAllRemoveChild($s)
    {
        $this->authorize('checkadmin');
        $s->books()->delete();
        $s->delete();
        return "Data dihapus beserta data yang berinteraksi dengan Kategori: $s->nama";
    }

    private function handleChildWithDefault($s)
    {
        $this->authorize('checkadmin');
        $ps = $s->books();
        $alternatif = Category::where('id','<>',$s->id)->first();
        foreach($ps as $p)
        {
            $p->idKategori = ($alternatif)->id;
            $p->save();
        }
        $s->delete();

        return "Data dihapus dan beserta data yang berinteraksi dengan tersebut dialihkan kepada $alternatif->nama";
    }

    public function getDataFirst(Request $request)
    {
        $this->authorize('bukanmember');
        $id = $request->id;
        $cat = Category::find($id);

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('category.editformmodal', compact('cat'))->render()
        ),200);
    }
}
