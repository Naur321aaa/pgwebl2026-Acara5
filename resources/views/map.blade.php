@extends('layouts.template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
    <style>
        #map {
            height: 800px;
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>

    {{-- Modal Form Input Point --}}
    <div class="modal" tabindex="-1" id="modalInputPoint">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Point</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('points.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="point_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="point_name" name="name"
                                placeholder="Fill name">
                        </div>
                        <div class="mb-3">
                            <label for="point_description" class="form-label">Description</label>
                            <textarea class="form-control" id="point_description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_point" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geometry_point" name="geometry_point" rows="3" readonly></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Form Input Polyline --}}
    <div class="modal" tabindex="-1" id="modalInputPolyline">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Polyline</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('polylines.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="polyline_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="polyline_name" name="name"
                                placeholder="Fill name">
                        </div>
                        <div class="mb-3">
                            <label for="polyline_description" class="form-label">Description</label>
                            <textarea class="form-control" id="polyline_description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_polyline" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geometry_polyline" name="geometry_polyline" rows="3" readonly></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Form Input Polygon --}}
    <div class="modal" tabindex="-1" id="modalInputPolygon">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Polygon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('polygons.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="polygon_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="polygon_name" name="name"
                                placeholder="Fill name">
                        </div>
                        <div class="mb-3">
                            <label for="polygon_description" class="form-label">Description</label>
                            <textarea class="form-control" id="polygon_description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_polygon" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geometry_polygon" name="geometry_polygon" rows="3" readonly></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://unpkg.com/@terraformer/wkt"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        var map = L.map('map').setView([-7.7956, 110.3695], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });
        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

            if (type === 'polyline') {
    console.log("Create " + type);

    // Set value geometry to geometry_polyline
    $('#geometry_polyline').val(objectGeometry);

    // Show Modal Input Polyline
    $('#modalInputPolyline').modal('show');

    // Reload page once after modal is closed
    $('#modalInputPolyline').one('hidden.bs.modal', function() {
        location.reload();
    });

} else if (type === 'polygon' || type === 'rectangle') {
    console.log("Create " + type);
    // Bisa ditambahkan modal polygon jika ingin input data

    // Set value geometry to geometry_polyline
    $('#geometry_polygon').val(objectGeometry);

    // Show Modal Input Polyline
    $('#modalInputPolygon').modal('show');

    // Reload page once after modal is closed
    $('#modalInputPolygon').one('hidden.bs.modal', function() {
        location.reload();
    });

} else if (type === 'marker') {
    console.log("Create " + type);

    // Set value geometry to geometry_point
    $('#geometry_point').val(objectGeometry);

    // Show Modal Input Point
    $('#modalInputPoint').modal('show');

    // Reload page once after modal is closed
    $('#modalInputPoint').one('hidden.bs.modal', function() {
        location.reload();
    });
} else {
    console.log('__undefined__');
}

drawnItems.addLayer(layer);
        });
    </script>
@endsection
