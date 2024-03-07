<?php

namespace App\Http\Controllers;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $penerbit;
    public function __construct()
    {
        $this->penerbit = new Penerbit;
    }
    public function index()
    {
        //
        $penerbit = Penerbit::all();

        return view("penerbit.penerbit", compact('penerbit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'kode' => 'required|max:5|unique:penerbit,penerbit', // unique: nama_tabel, nama_field
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required'
        ];

        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'max' => ':attribute maximal 5 huruf',
            'unique' => ':attribute sudah ada, silakan gunakan yang lain'
        ];

        $this->validate($request, $rules, $messages);

        $this->penerbit->penerbit = $request->kode;
        $this->penerbit->penerbit = $request->nama;
        $this->penerbit->penerbit = $request->alamt;
        $this->penerbit->penerbit = $request->kota;
        $this->penerbit->penerbit = $request->telepon;
        $this->penerbit->save();

        // Dengan sweet alert
        Alert::success('SUCCESSFUL', 'Data Berhasil Ditambahkan!');
        return redirect()->route('penerbit');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $penerbit = Penerbit::findOrFail($id);

        return view('penerbit.show', compact('penerbit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $penerbit = Penerbit::findOrFail($id);

        return view('penerbit.edit', compact('penerbit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $update = Penerbit::findOrFail($id);

        if ($update->isDirty()) {
            $rules = [
                'kode' => 'required|max:5|unique:buku,buku', // unique: nama_tabel, nama_field
                'nama' => 'required',
                'alamat' => 'required',
                'kota' => 'required',
                'telepon' => 'required'
            ];
    
            $messages = [
                'required' => ':attribute tidak boleh kosong',
                'max' => ':attribute maximal 5 huruf',
                'unique' => ':attribute sudah ada, silakan gunakan yang lain'
            ];
    
            $this->validate($request, $rules, $messages);
    
            $update->penerbit = $request->kode;
            $update->penerbit = $request->nama;
            $update->penerbit = $request->alamat;
            $update->penerbit = $request->kota;
            $update->penerbit = $request->telepon;
            $update->save();

            Alert::success('SUCCESSFUL', 'Data Berhasil Diubah!');
            return redirect()->route('penerbit');
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
        $penerbit = Penerbit::findOrFail($id);
        
        $penerbit->delete();
        Alert::success('SUCCESSFUL', 'Data Berhasil Dihapus!');

        return redirect()->route("penerbit");
    }
}
