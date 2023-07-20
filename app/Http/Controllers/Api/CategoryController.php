<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use App\Http\Resources\KategoryResource;

use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::latest()->paginate(5);

        return new KategoryResource(true, 'List Data Category', $category);

    }

    public function show($id)
    {

        $category = Category::findOrFail($id);

        return new KategoryResource(true, 'Detail Data Category!', $category);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
        ]);

      
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::create([
            'nama'     => $request->nama,
        ]);

        //return response
        return new KategoryResource(true, 'Data Category Berhasil Ditambahkan!', $category);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $category = Category::find($id);
           
        $category->update([
                'nama'     => $request->nama,
            ]);

        //return response
        return new KategoryResource(true, 'Data Category Berhasil Diubah!', $category);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        //return response
        return new KategoryResource(true, 'Data Category Berhasil Dihapus!', null);
    }
}
