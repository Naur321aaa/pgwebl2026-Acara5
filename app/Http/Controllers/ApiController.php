<?php

namespace App\Http\Controllers;

use App\Models\pointsModel;
use App\Models\polygonsModel;
use App\Models\polylinesModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->points = new pointsModel();
        $this->polylines = new polylinesModel();
        $this->polygons = new polygonsModel();
    }

    // ================= POINTS =================
    public function geojson_points()
    {
        $points = $this->points->geojson_points();
        return response()->json($points, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_point($id)
    {
        $points = $this->points->geojson_point($id);
        return response()->json($points, 200, [], JSON_NUMERIC_CHECK);
    }

    // ================= POLYLINES (FIXED NAMA METHOD) =================
    public function geojson_polylines()
    {
        $polylines = $this->polylines->geojsonAll();
        return response()->json($polylines, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_polyline($id)
    {
        $polylines = $this->polylines->geojsonById($id);
        return response()->json($polylines, 200, [], JSON_NUMERIC_CHECK);
    }

    // ================= POLYGONS (FIXED) =================
    public function geojson_polygons()
    {
        $polygons = $this->polygons->geojsonAll();
        return response()->json($polygons, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_polygon($id)
    {
        $polygons = $this->polygons->geojsonById($id);
        return response()->json($polygons, 200, [], JSON_NUMERIC_CHECK);
    }
}
