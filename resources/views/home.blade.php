@extends('layouts.template')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url("https://travelspromo.com/wp-content/uploads/2019/03/Patung-di-Museum-Ullen-Sentalu-Jogja.-Foto-Gmap-Edhi-Sutanto.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45);
            z-index: -1;
            transition: 0.4s;
        }

        body:hover::before {
            background: rgba(0, 0, 0, 0.6);
        }

        .navbar-glass {
            position: fixed;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            z-index: 2000;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(0, 255, 100, 0.2);
            box-shadow: 0 0 25px rgba(0, 255, 100, 0.15);
        }

        .nav-menu a {
            color: #d1fae5;
            text-decoration: none;
            margin-right: 30px;
            font-size: 14px;
            cursor: pointer;
            position: relative;
        }

        .nav-menu a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 0%;
            height: 2px;
            background: #22c55e;
            transition: 0.3s;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            border: 1px solid rgba(34, 197, 94, 0.4);
            overflow: hidden;
        }

        .search-box input {
            background: transparent;
            border: none;
            color: white;
            padding: 8px 15px;
            outline: none;
            width: 170px;
        }

        .search-box input::placeholder {
            color: #d1fae5;
        }

        .search-box button {
            background: linear-gradient(90deg, #16a34a, #22c55e);
            border: none;
            color: white;
            padding: 8px 18px;
            cursor: pointer;
        }

        .content {
            margin-top: 120px;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.25);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
        }

        .table thead {
            background: #111827;
            color: white;
        }

        /* Perbaikan layout row statistik */
        .row.mt-3.g-4 {
            display: flex !important;
            flex-wrap: nowrap !important;
            justify-content: center;
            padding: 0 15px;
        }

        .row.mt-3.g-4 .col-3 {
            flex: 0 0 23% !important;
            max-width: 23% !important;
        }

        .row.mt-3.g-4 .card {
            height: 100%;
            border-radius: 16px !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2) !important;
            overflow: hidden;
        }

        .row.mt-3.g-4 .card-header h3 {
            font-size: 15px !important;
            font-weight: 600 !important;
            margin: 0 !important;
        }

        .row.mt-3.g-4 .card-body h1 {
            font-size: 52px !important;
            font-weight: 700 !important;
            color: #15803d !important;
            margin: 8px 0 !important;
        }

        /* Supaya container utama tidak kepotong */
        .content {
            margin-top: 100px !important;
            padding: 20px 30px !important;
        }




        /* Override Bootstrap row/col biar flex horizontal */
        .row.mt-3.g-4 {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            justify-content: center !important;
            gap: 16px !important;
            padding: 0 15px !important;
        }

        .row.mt-3.g-4>div {
            flex: 1 1 0 !important;
            width: auto !important;
            max-width: 25% !important;
            padding: 0 !important;
        }

        .row.mt-3.g-4 .card {
            width: 100% !important;
            border-radius: 16px !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2) !important;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.95) !important;
        }

        .row.mt-3.g-4 .card-header {
            padding: 12px 8px !important;
        }

        .row.mt-3.g-4 .card-header h3 {
            font-size: 14px !important;
            font-weight: 600 !important;
            margin: 0 !important;
            white-space: nowrap !important;
        }

        .row.mt-3.g-4 .card-body h1 {
            font-size: 48px !important;
            font-weight: 700 !important;
            color: #15803d !important;
            margin: 6px 0 !important;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                    <h4 class="mb-0">Tabel Data Wisata Alam Jogja Utara</h4>
                </div>
                <div class="card-body text-center">
                    <p> Website ini dibuat sebagai media informasi dan visualisasi data wisata alam di wilayah Jogja Utara
                        berbasis WebGIS untuk memenuhi tugas Praktikum PGWEB-L
                        serta memudahkan pengguna dalam melihat persebaran lokasi wisata secara interaktif dan informatif. </p>
                    {{-- <div class="table-responsive"> --}}
                    {{-- <table class="table table-bordered table-striped table-hover text-center align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tempat</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Kaliurang</td>
                                    <td>Kaliurang, Hargobinangun, Pakem, Sleman</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Bukit Klangon</td>
                                    <td>Glagaharjo, Cangkringan, Sleman</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Stonehenge Merapi</td>
                                    <td>Kepuharjo, Cangkringan, Sleman</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Air Terjun Tlogo Muncar</td>
                                    <td>Hargobinangun, Pakem, Sleman</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Embung Kaliaji</td>
                                    <td>Glagaharjo, Cangkringan, Sleman</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Lava Tour Merapi</td>
                                    <td>Kepuharjo, Cangkringan, Sleman</td>
                                </tr>
                            </tbody>
                        </table> --}}
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-3 g-4">

        <div class="col-3">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                    <h3>Jumlah Point</h3>
                </div>
                <div class="card-body text-center">
                    <h1>
                        {{ $points_count}}
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                    <h3>Jumlah Polyline</h3>
                </div>
                <div class="card-body text-center">
                    <h1>
                        {{ $polylines_count}}
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                    <h3>Jumlah Polygon</h3>
                </div>
                <div class="card-body text-center">
                    <h1>
                        {{ $polygons_count}}
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                    <h3>Jumlah User</h3>
                </div>
                <div class="card-body text-center">
                    <h1>
                        {{ $users_count}}
                    </h1>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
