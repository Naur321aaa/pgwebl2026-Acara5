@extends('layouts.template')

@section('styles')
<style>
    /* IMPORT FONT */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background-color: #fffafc;
    }

    /* CARD STATISTIK */
    .stat-card {
        border: 2px solid #ff69b4 !important;
        border-radius: 15px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    /* EFEK GOYANG ATAS BAWAH */
    .stat-card {
        border: 2px solid #ff69b4 !important;
        border-radius: 15px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .stat-card:hover {
        animation: floatCard 0.8s ease-in-out infinite alternate;
        box-shadow: 0 8px 20px rgba(255, 105, 180, 0.3);
    }

    @keyframes floatCard {
        from {
            transform: translateY(0px);
        }

        to {
            transform: translateY(-10px);
        }
    }
</style>
@endsection

@section('content')
<div class="container mt-3">

    <!-- CARD DESKRIPSI -->
    <div class="card mb-4"
        style="border: 2px solid #d94f98; border-radius: 18px;">

        <div class="card-header text-center text-white"
            style="background-color: #ff69b4; border-bottom: 2px solid #d94f98; border-radius: 16px 16px 0 0;">

            <h3>Aplikasi Geospasial CRUD</h3>
        </div>

        <div class="card-body">
            <p class="description-text">
                Aplikasi ini dibuat untuk memenuhi tugas mata kuliah Praktikum Pemrograman Web Lanjut.
                Aplikasi ini menampilkan peta interaktif yang memuat objek dengan geometri titik, garis, dan area.
                Setiap objek dapat ditambahkan, ditampilkan, diubah, maupun dihapus melalui sistem yang tersedia.
                Pengembangan aplikasi dilakukan menggunakan framework Laravel serta database PostgreSQL
                yang didukung ekstensi PostGIS untuk pengelolaan data spasial.
            </p>
        </div>

    </div>

    <!-- CARD STATISTIK -->
    <div class="row g-3">

        <div class="col-3">
            <div class="card h-100 border-0 shadow-sm stat-card">

                <div class="card-header text-center bg-white border-1">
                    <h5 class="stat-title">
                        Jumlah Point
                    </h5>
                </div>

                <div class="card-body text-center">
                    <h1 class="stat-number">
                        {{$points_count}}
                    </h1>
                </div>

            </div>
        </div>

        <div class="col-3">
            <div class="card h-100 border-0 shadow-sm stat-card">

                <div class="card-header text-center bg-white border-1">
                    <h5 class="stat-title">
                        Jumlah Polyline
                    </h5>
                </div>

                <div class="card-body text-center">
                    <h1 class="stat-number">
                        {{$polylines_count}}
                    </h1>
                </div>

            </div>
        </div>

        <div class="col-3">
            <div class="card h-100 border-0 shadow-sm stat-card">

                <div class="card-header text-center bg-white border-1">
                    <h5 class="stat-title">
                        Jumlah Polygon
                    </h5>
                </div>

                <div class="card-body text-center">
                    <h1 class="stat-number">
                        {{$polygons_count}}
                    </h1>
                </div>

            </div>
        </div>

        <div class="col-3">
            <div class="card h-100 border-0 shadow-sm stat-card">

                <div class="card-header text-center bg-white border-1">
                    <h5 class="stat-title">
                        Jumlah Pengguna
                    </h5>
                </div>

                <div class="card-body text-center">
                    <h1 class="stat-number">
                        {{$users_count}}
                    </h1>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection
