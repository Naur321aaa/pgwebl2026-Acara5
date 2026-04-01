<?php

namespace App\Http\Controllers;

use App\Models\PolylinesModel;
use Illuminate\Http\Request;

class PolylinesController extends Controller
{
    protected $polylines;

    public function __construct()
    {
        $this->polylines = new PolylinesModel();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validasi Input
        $request->validate(
            [
                'geometry_polyline' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required'
            ],
            [
                'geometry_polyline.required'=>'Field geometry polyline harus diisi.',
                'name.required'=>'Field nama harus diisi.',
                'name.string'=>'Field nama harus berupa string.',
                'name.max'=>'Field nama tidak boleh lebih dari 255 karakter.',
                'description.required'=>'Field deskripsi harus diisi.'
            ]
        );
        $data = [
            'geom' => $request->geometry_polyline,
            'name' => $request->name,
            'description' => $request->description,
        ];

        // simpan data ke database
        if ($this->polylines->create($data)) {
            return redirect()->route('peta')
                ->with('success', 'Data polyline yang kamu inputkan berhasil disimpan');
        }

        // jika gagal
        return redirect()->route('peta')
            ->with('error', 'Kamu Gagal menyimpan data polyline');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
