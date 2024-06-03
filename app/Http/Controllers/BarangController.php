<?php

namespace App\Http\Controllers;

use App\Models\Barangs;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barangs::all();

        return view('pages.barang.index', compact('barang'));
    }

    public function index_api()
    {
        $barang = Barangs::all();

        return response()->json($barang);
    }
    public function detail_api($id)
    {
        // Get Detail Barang ny id
        $barang =  Barangs::find($id);

        return response()->json($barang);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'harga' => 'required|max:255', // Assuming 'harga' should be an email for some reason
            'gambar' => 'required|file|mimes:jpeg,png,jpg,gif',
        ]);


        // Handle file upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Generate unique file name
            $filePath = 'images/' . $fileName; // Define file path relative to the 'public' directory

            // Move the uploaded file to the desired folder
            $file->move(('images'), $fileName);
        } else {
            $filePath = null; // Handle the case where no file is uploaded
        }

        // Create a new record in the database
        Barangs::create([
            'nama' => $request->name,
            'harga' => $request->harga,
            'gambar' => $filePath,
        ]);


        return redirect()->back()->with('plus', 'baru ditambahkan');
    }


    public function delete($id)
    {

        Barangs::where('id', $id)->delete();
        return redirect()->back()->with('delete', '1 Data Berhasil Dihapus.');
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif',
        ]);

        // Find the existing record
        $barang = Barangs::findOrFail($id);

        // Prepare data for updating
        $data = [
            'nama' => $request->input('name'),
            'harga' => $request->input('harga'),
        ];

        // Handle file upload if a new file is provided
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Generate unique file name
            $filePath = 'images/' . $fileName; // Define file path relative to the 'public' directory

            // Move the uploaded file to the desired folder
            $file->move(('images'), $fileName);

            // Update the file path in the data array
            $data['gambar'] = $filePath;
        }
        // Update the record
        $barang->update($data);

        // Redirect back with a success message
        return redirect()->back()->with('edit', '1 Data Berhasil Diupdate.');
    }
}
