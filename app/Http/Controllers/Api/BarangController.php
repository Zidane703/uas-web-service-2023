<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;

use App\Http\Resources\BarangResource;

use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::latest()->paginate(5);

        return new BarangResource(true, 'List Data Barang', $barang);

    }

    public function show($id)
    {

        $barang = Barang::findOrFail($id);

        return new BarangResource(true, 'Detail Data Barang!', $barang);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'kode'     => 'required',
            'satuan'   => 'required',
            'lama_sewa'   => 'required',
            'jumlah'   => 'required',
            'category_id'   => 'required',
        ]);

      
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $barang = Barang::create([
            'nama'     => $request->nama,
            'kode'     => $request->kode,
            'satuan'   => $request->satuan,
            'lama_sewa'   => $request->lama_sewa,
            'jumlah'    => $request->jumlah,
            'category_id'   => $request->category_id,
        ]);

        //return response
        return new BarangResource(true, 'Data Barang Berhasil Ditambahkan!', $barang);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'kode'     => 'required',
            'satuan'   => 'required',
            'lama_sewa'   => 'required',
            'jumlah'   => 'required',
            'category_id'   => 'required',
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $barang = Barang::find($id);
           
        $barang->update([
                'nama'     => $request->nama,
                'kode'     => $request->kode,
                'satuan'   => $request->satuan,
                'lama_sewa'   => $request->lama_sewa,
                'jumlah'   => $request->jumlah,
                'category_id'   => $request->category_id,
            ]);

        //return response
        return new BarangResource(true, 'Data Barang Berhasil Diubah!', $barang);
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        $barang->delete();

        //return response
        return new BarangResource(true, 'Data Barang Berhasil Dihapus!', null);
    }
}
