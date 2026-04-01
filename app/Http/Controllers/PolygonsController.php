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
                'description' => 'required'
            ],
            [
                'geometry_polygon.required'=>'Field geometry polygon harus diisi.',
                'name.required'=>'Field nama harus diisi.',
                'name.string'=>'Field nama harus berupa string.',
                'name.max'=>'Field nama tidak boleh lebih dari 255 karakter.',
                'description.required'=>'Field deskripsi harus diisi.'
            ]
        );

        $data = [
            'geom' => $request->geometry_polygon,
            'name' => $request->name,
            'description' => $request->description,
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
        //
    }
}
