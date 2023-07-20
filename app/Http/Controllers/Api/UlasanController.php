<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ulasan;

use App\Http\Resources\UlasanResource;

use Illuminate\Support\Facades\Validator;

class UlasanController extends Controller
{
    public function index()
    {
        $ulasan = Ulasan::latest()->paginate(5);

        return new UlasanResource(true, 'List Data Ulasan', $ulasan);

    }

    public function show($id)
    {

        $ulasan = Ulasan::findOrFail($id);

        return new UlasanResource(true, 'Detail Data Ulasan!', $ulasan);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barangs_id'     => 'required',
            'ulasan'     => 'required',
            'email'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $ulasan = Ulasan::create([
            'barangs_id'     => $request->barangs_id,
            'ulasan'     => $request->ulasan,
            'email'   => $request->email,
        ]);

        //return response
        return new UlasanResource(true, 'Data Ulasan Berhasil Ditambahkan!', $ulasan);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'barangs_id'     => 'required',
            'ulasan'     => 'required',
            'email'   => 'required',
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $ulasan = Ulasan::find($id);
           
        $ulasan->update([
            'barangs_id'     => $request->barangs_id,
            'ulasan'     => $request->ulasan,
            'email'   => $request->email,
            ]);

        //return response
        return new UlasanResource(true, 'Data Ulasan Berhasil Diubah!', $ulasan);
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::find($id);

        $ulasan->delete();

        //return response
        return new UlasanResource(true, 'Data Ulasan Berhasil Dihapus!', null);
    }
}
