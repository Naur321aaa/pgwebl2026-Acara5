<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PolygonsModel extends Model
{
    protected $table = 'polygons';
    protected $guarded = ['id'];

    // Ambil semua polygon dalam format GeoJSON
    public function geojsonAll()
    {
        $polygons = $this->select(
            DB::raw('id, ST_AsGeoJSON(geom) as geojson, name, description, image, created_at, updated_at')
        )->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($polygons as $p) {
            $geojson['features'][] = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geojson),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'image' => $p->image,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at
                ]
            ];
        }

        return $geojson;
    }

    // Ambil polygon berdasarkan ID
    public function geojsonById($id)
    {
        $polygons = $this->select(
            DB::raw('id, ST_AsGeoJSON(geom) as geojson, name, description, image, created_at, updated_at')
        )
        ->where('id', $id)
        ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($polygons as $p) {
            $geojson['features'][] = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geojson),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'image' => $p->image,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at
                ]
            ];
        }

        return $geojson;
    }
}
