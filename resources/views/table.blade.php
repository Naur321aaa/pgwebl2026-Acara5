@extends('layouts.template')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css">

<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #fffafd;
    }

    /* POINT - PINK */
    .card-point {
        border: 2px solid #d94f98;
        border-radius: 15px;
        overflow: hidden;
    }

    .card-point .card-header {
        background-color: #ff69b4;
        color: white;
        border-bottom: 2px solid #d94f98;
    }

    /* POLYLINE - HIJAU */
    .card-polyline {
        border: 2px solid #5abf90;
        border-radius: 15px;
        overflow: hidden;
    }

    .card-polyline .card-header {
        background-color: #8ee4af;
        color: white;
        border-bottom: 2px solid #5abf90;
    }

    /* POLYGON - BIRU */
    .card-polygon {
        border: 2px solid #4a90e2;
        border-radius: 15px;
        overflow: hidden;
    }

    .card-polygon .card-header {
        background-color: #74b9ff;
        color: white;
        border-bottom: 2px solid #4a90e2;
    }

    table {
        vertical-align: middle !important;
    }

    th {
        text-align: center;
    }

    td {
        vertical-align: middle;
    }

    img {
        border-radius: 10px;
    }

    /* TABEL POINT */
    .card-point table {
        border: 2px solid #ff69b4;
    }

    .card-point table th {
        background-color: #ffd1e6;
        color: #d94f98;
        border: 1px solid #ff69b4 !important;
    }

    .card-point table td {
        border: 1px solid #ffb6d5 !important;
    }


    /* TABEL POLYLINE */
    .card-polyline table {
        border: 2px solid #8ee4af;
    }

    .card-polyline table th {
        background-color: #d8f8e5;
        color: #5abf90;
        border: 1px solid #8ee4af !important;
    }

    .card-polyline table td {
        border: 1px solid #b8efd0 !important;
    }


    /* TABEL POLYGON */
    .card-polygon table {
        border: 2px solid #74b9ff;
    }

    .card-polygon table th {
        background-color: #d9ecff;
        color: #4a90e2;
        border: 1px solid #74b9ff !important;
    }

    .card-polygon table td {
        border: 1px solid #b9dcff !important;
    }

    /* JUDUL CARD TENGAH */
    .card-header h3 {
        text-align: center;
        margin: 0;
    }

    /* JUDUL KOLOM TABEL TENGAH */
    th {
        text-align: center !important;
        vertical-align: middle !important;
    }

</style>
@endsection

@section('content')
<div class="container mt-3">

    <!-- TABEL POINT -->
    <div class="card mb-4 card-point">

        <div class="card-header">
            <h3>Tabel Data Point</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped" id="tabeldatapoints">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th>Tanggal Di Buat</th>
                    </tr>
                </thead>

                @php
                    $no = 1;
                @endphp

                <tbody>
                    @foreach ($points as $p)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $p['name'] }}</td>
                        <td>{{ $p['description'] }}</td>

                        <td class="text-center">
                            <img src="{{ asset('storage/images/' . $p['image']) }}"
                                alt=""
                                width="100">
                        </td>

                        <td>{{ $p['created_at'] }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


    <!-- TABEL POLYLINE -->
    <div class="card mb-4 card-polyline">

        <div class="card-header">
            <h3>Tabel Data Polyline</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped" id="tabeldatapolylines">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th>Tanggal Di Buat</th>
                    </tr>
                </thead>

                @php
                    $no = 1;
                @endphp

                <tbody>
                    @foreach ($polylines as $pl)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $pl['name'] }}</td>
                        <td>{{ $pl['description'] }}</td>

                        <td class="text-center">
                            <img src="{{ asset('storage/images/' . $pl['image']) }}"
                                alt=""
                                width="100">
                        </td>

                        <td>{{ $pl['created_at'] }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


    <!-- TABEL POLYGON -->
    <div class="card mb-4 card-polygon">

        <div class="card-header">
            <h3>Tabel Data Polygon</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped" id="tabeldatapolygons">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th>Tanggal Di Buat</th>
                    </tr>
                </thead>

                @php
                    $no = 1;
                @endphp

                <tbody>
                    @foreach ($polygons as $pg)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $pg['name'] }}</td>
                        <td>{{ $pg['description'] }}</td>

                        <td class="text-center">
                            <img src="{{ asset('storage/images/' . $pg['image']) }}"
                                alt=""
                                width="100">
                        </td>

                        <td>{{ $pg['created_at'] }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>

<script>
    new DataTable('#tabeldatapoints');
    new DataTable('#tabeldatapolylines');
    new DataTable('#tabeldatapolygons');
</script>
@endsection
