<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\Penerbit;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $buku;
    public function __construct()
    {
        $this->buku = new Buku;
    }
    public function index()
    {
        //

        $buku = Buku::all();

        return view("buku.buku", compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $penerbit = Penerbit::all();
        return view('buku.create', compact('penerbit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'kode' => 'required|max:5|unique:buku,buku', // unique: nama_tabel, nama_field
            'kategori' => 'required',
            'nama_buku' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'penerbit' => 'required'
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'max' => ':attribute maximal 5 huruf',
            'unique' => ':attribute sudah ada, silakan gunakan yang lain'
        ];

        $this->validate($request, $rules, $messages);

        $this->buku->buku = $request->kode;
        $this->buku->buku = $request->kategori;
        $this->buku->buku = $request->nama_buku;
        $this->buku->buku = $request->harga;
        $this->buku->buku = $request->stok;
        $this->buku->buku = $request->penerbit_id;
        $this->buku->save();

        // Dengan sweet alert
        // Alert::success('SUCCESSFUL', 'Data Berhasil Ditambahkan!');
        toast('Data Berhasil Ditambahkan!','success');
        return redirect()->route('buku.buku');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $buku = Buku::findOrFail($id);

        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $buku = Buku::findOrFail($id);
        $penerbit = Penerbit::all();

        return view('buku.edit', compact('buku', 'penerbit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $update = Buku::findOrFail($id);

        if ($update->isDirty()) {
            $rules = [
                'kode' => 'required|max:5|unique:buku,buku', // unique: nama_tabel, nama_field
                'kategori' => 'required',
                'nama_buku' => 'required',
                'harga' => 'required',
                'stok' => 'required',
                'penerbit' => 'required'
            ];
    
            $messages = [
                'required' => ':attribute tidak boleh kosong',
                'max' => ':attribute maximal 5 huruf',
                'unique' => ':attribute sudah ada, silakan gunakan yang lain'
            ];
    
            $this->validate($request, $rules, $messages);
    
            $update->buku = $request->kode;
            $update->buku = $request->kategori;
            $update->buku = $request->nama_buku;
            $update->buku = $request->harga;
            $update->buku = $request->stok;
            $update->buku = $request->penerbit;
            $update->save();

            // Alert::success('SUCCESSFUL', 'Data Berhasil Diubah!');
            toast('Data Berhasil Diubah!','success');
            return redirect()->route('buku');
        } else {
            echo "Tidak Ada Perubahan";
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $buku = Buku::findOrFail($id);
        
        $buku->delete();
        // Alert::success('SUCCESSFUL', 'Data Berhasil Dihapus!');
        toast('Data Berhasil Dihapus!','success');

        return redirect()->route("buku");
    }
}
