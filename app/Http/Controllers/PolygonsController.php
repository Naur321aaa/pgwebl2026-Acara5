<?php

namespace App\Http\Controllers;

use App\Models\PolygonsModel;
use Illuminate\Http\Request;

class PolygonsController extends Controller
{
    //Fungsi untuk mengkonesikan model ke controller
    public function __construct()
    {
        $this->polygons = new PolygonsModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate(
    [
        'geometry_polygon' => 'required',
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ],
    [
        'geometry_polygon.required' => 'Field geometry polygon harus diisi.',
        'name.required' => 'Field name harus diisi.',
        'name.string' => 'Field name harus berupa string.',
        'name.max' => 'Field name tidak boleh lebih dari 255 karakter.',
        'description.string' => 'Field description harus berupa string.',
        'image.image' => 'Field harus berupa gambar.',
        'image.mimes' => 'Field gambar harus berformat jpeg,png,jpg.',
        'image.max' => 'Ukuran field gambar tidak boleh lebih dari 2 MB.'
    ]
);

        //  Create directory for images if it doesn't exist --> Jika direktori storage/images tidak ada
       // maka akan dibuat folder baru menggunakan mkdir dengan permission 0777 (akses penuh)
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // PHP Get Image & Move --> Mengecek apakah request memiliki file 'image'.
        // Jika ada, maka file akan diambil, diberi nama unik menggunakan time() + "_point" + extension (dibuat lowercase)
        // kemudian dipindahkan ke folder storage/images.
        // Jika tidak ada file yang diupload, maka variabel $name_image diisi null.
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
            } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geometry_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        // simpan data ke database
        if ($this->polygons->create($data)) {
    return redirect()->route('peta')->with('success', 'Data polygon yang kamu inputkan berhasil disimpan');
}

//Kembali ke halaman peta
return redirect()->route('peta')->with('error', 'Kamu Gagal menyimpan data polygon');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Mencari nama file gambar berdasarkan ID Point
    $image = $this->polygons->find($id);

    // Hapus file gambar jika ada
    if ($image != null) {
        if (file_exists('./storage/images/' . $image->image)) {
            unlink('./storage/images/' . $image->image);
        }
    }

    // Hapus data dari database
    if (!$this->polygons->destroy($id)) {
        return redirect()->route('peta')
            ->with('error', 'Gagal menghapus data point.');
    }

    // Kembali ke halaman peta
    return redirect()->route('peta')
        ->with('success', 'Data point berhasil dihapus.');
}
}
