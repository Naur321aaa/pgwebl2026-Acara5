<?php

namespace App\Http\Controllers;

use App\Models\pointsModel;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    public function __construct()
    {
        $this->points = new pointsModel();
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
                'geometry_point' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'geometry_point.required' => 'Field geometry point harus diisi.',
                'name.required' => 'Field name harus diisi.',
                'name.string' => 'Field name harus berupa string.',
                'name.max' => 'Field name tidak boleh lebih dari 255 karakter.',
                'description.string' => 'Field description harus berupa string.',
                'image.image' => 'Field  harus berupa gambar.',
                'image.mimes' => 'Field gambar harus berformat jpeg,png,jng.',
                'image.max' => 'Ukuran field gambar tidak boleh lebih dari 2 MB.',
            ]
        );

        // Create directory for images if it doesn't exist --> Jika direktori storage/images tidak ada (!)
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
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
            } else {
            $name_image = null;
        }


        $data = [
            'geom' => $request->geometry_point,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,

        ];

        // simpan data ke database
        if ($this->points->create($data)) {
    return redirect()->route('peta')->with('success', 'Data point yang kamu inputkan berhasil disimpan');
}

//Kembali ke halaman peta
return redirect()->route('peta')->with('error', 'Kamu Gagal menyimpan data point');
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
        //
    }
}
