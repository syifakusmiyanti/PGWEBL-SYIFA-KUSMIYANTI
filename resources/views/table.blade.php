@extends('layouts.template')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap5.css">
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
            margin-top: 100px;
            padding: 20px 30px;
        }

        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.25);
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(5px);
        }

        .table thead {
            background: #111827;
            color: white;
        }

        /* ===== DataTables ===== */
        div.dataTables_wrapper {
            padding: 15px 5px 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
        }

        div.dataTables_wrapper div.dataTables_length,
        div.dataTables_wrapper div.dataTables_filter {
            margin-bottom: 12px;
            color: #374151;
        }

        div.dataTables_wrapper div.dataTables_length label,
        div.dataTables_wrapper div.dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }

        div.dataTables_wrapper div.dataTables_filter {
            text-align: right;
        }

        div.dataTables_wrapper div.dataTables_filter label {
            justify-content: flex-end;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            border: 1.5px solid rgba(34, 197, 94, 0.5) !important;
            border-radius: 20px !important;
            padding: 6px 14px !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            outline: none !important;
            color: #1f2937 !important;
            width: 200px;
        }

        div.dataTables_wrapper div.dataTables_filter input:focus {
            border-color: #22c55e !important;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.15) !important;
        }

        div.dataTables_wrapper div.dataTables_length select {
            border: 1.5px solid rgba(34, 197, 94, 0.5) !important;
            border-radius: 10px !important;
            padding: 5px 10px !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            outline: none !important;
            color: #1f2937;
        }

        div.dataTables_wrapper div.dataTables_info {
            font-size: 12px;
            color: #6b7280;
            padding: 10px 0 5px;
        }

        div.dataTables_wrapper div.dataTables_paginate {
            padding: 8px 0;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 3px;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button {
            padding: 5px 12px !important;
            border-radius: 8px !important;
            border: 1.5px solid #e5e7eb !important;
            font-size: 13px !important;
            font-family: 'Poppins', sans-serif !important;
            color: #374151 !important;
            cursor: pointer;
            background: white !important;
            margin: 0 2px;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button.current,
        div.dataTables_wrapper div.dataTables_paginate .paginate_button.current:hover {
            background: linear-gradient(135deg, #166534, #22c55e) !important;
            color: white !important;
            border-color: transparent !important;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button:hover {
            background: #f0fdf4 !important;
            color: #15803d !important;
            border-color: #22c55e !important;
        }

        div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled,
        div.dataTables_wrapper div.dataTables_paginate .paginate_button.disabled:hover {
            color: #d1d5db !important;
            background: white !important;
            border-color: #f3f4f6 !important;
            cursor: default;
        }

        /* Sinkronkan baris atas DataTables */
        div.dataTables_wrapper div.row:first-child {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            margin-bottom: 10px;
        }

        div.dataTables_wrapper div.dataTables_length label,
        div.dataTables_wrapper div.dataTables_filter label {
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            margin: 0 !important;
            height: 36px !important;
            font-size: 13px;
            color: #374151;
            font-family: 'Poppins', sans-serif;
        }

        div.dataTables_wrapper div.dataTables_length select,
        div.dataTables_wrapper div.dataTables_filter input {
            height: 36px !important;
            border: 1.5px solid rgba(34, 197, 94, 0.5) !important;
            border-radius: 10px !important;
            padding: 0 12px !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            outline: none !important;
            color: #1f2937 !important;
            background: white !important;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            border-radius: 20px !important;
            width: 200px !important;
        }

        div.dataTables_wrapper div.dataTables_filter input:focus {
            border-color: #22c55e !important;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.15) !important;
        }

        /* Baris bawah — showing + pagination sejajar */
        div.dataTables_wrapper div.row:last-child {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            margin-top: 10px;
        }

        div.dataTables_wrapper div.dataTables_info {
            font-size: 12px !important;
            color: #6b7280 !important;
            font-family: 'Poppins', sans-serif !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        div.dataTables_wrapper div.dataTables_paginate {
            padding: 0 !important;
            margin: 0 !important;
        }

        div.dataTables_wrapper .paginate_button {
            height: 34px !important;
            padding: 0 12px !important;
            border-radius: 8px !important;
            border: 1.5px solid #e5e7eb !important;
            font-size: 13px !important;
            font-family: 'Poppins', sans-serif !important;
            color: #374151 !important;
            background: white !important;
            cursor: pointer;
            margin: 0 2px !important;
            display: inline-flex !important;
            align-items: center !important;
        }

        div.dataTables_wrapper .paginate_button.current,
        div.dataTables_wrapper .paginate_button.current:hover {
            background: linear-gradient(135deg, #166534, #22c55e) !important;
            color: white !important;
            border-color: transparent !important;
        }

        div.dataTables_wrapper .paginate_button:hover {
            background: #f0fdf4 !important;
            color: #15803d !important;
            border-color: #22c55e !important;
        }

        div.dataTables_wrapper .paginate_button.disabled,
        div.dataTables_wrapper .paginate_button.disabled:hover {
            color: #d1d5db !important;
            background: white !important;
            border-color: #f3f4f6 !important;
            cursor: default !important;
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center align-middle"
                            id="tabeldatapoints">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tempat</th>
                                    <th>Alamat</th>
                                    <th>Foto</th>
                                    <th>Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($points as $p)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->description }}</td>
                                        <td><img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                                width="100"
                                                style="max-height:80px; object-fit:cover; border-radius:8px;"></td>
                                        <td>{{ $p->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach

                                {{-- <tr><td>1</td><td>Kaliurang</td><td>Kaliurang, Hargobinangun, Pakem, Sleman</td><td><img src="path/to/foto1.jpg" alt="Foto 1" width="100"></td><td>2023-01-01</td></tr>
                            <tr><td>2</td><td>Bukit Klangon</td><td>Glagaharjo, Cangkringan, Sleman</td><td><img src="path/to/foto2.jpg" alt="Foto 2" width="100"></td><td>2023-01-02</td></tr>
                            <tr><td>3</td><td>Stonehenge Merapi</td><td>Kepuharjo, Cangkringan, Sleman</td><td><img src="path/to/foto3.jpg" alt="Foto 3" width="100"></td><td>2023-01-03</td></tr>
                            <tr><td>4</td><td>Air Terjun Tlogo Muncar</td><td>Hargobinangun, Pakem, Sleman</td><td><img src="path/to/foto4.jpg" alt="Foto 4" width="100"></td><td>2023-01-04</td></tr>
                            <tr><td>5</td><td>Embung Kaliaji</td><td>Glagaharjo, Cangkringan, Sleman</td><td><img src="path/to/foto5.jpg" alt="Foto 5" width="100"></td><td>2023-01-05</td></tr>
                            <tr><td>6</td><td>Lava Tour Merapi</td><td>Kepuharjo, Cangkringan, Sleman</td></tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- polyline --}}
                <div class="card-body mt-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center align-middle"
                            id="tabeldatapolylines">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tempat</th>
                                    <th>Alamat</th>
                                    <th>Foto</th>
                                    <th>Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($polylines as $p)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->description }}</td>
                                        <td><img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                                width="100"
                                                style="max-height:80px; object-fit:cover; border-radius:8px;"></td>
                                        <td>{{ $p->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach

                                {{-- <tr><td>1</td><td>Kaliurang</td><td>Kaliurang, Hargobinangun, Pakem, Sleman</td><td><img src="path/to/foto1.jpg" alt="Foto 1" width="100"></td><td>2023-01-01</td></tr>
                            <tr><td>2</td><td>Bukit Klangon</td><td>Glagaharjo, Cangkringan, Sleman</td><td><img src="path/to/foto2.jpg" alt="Foto 2" width="100"></td><td>2023-01-02</td></tr>
                            <tr><td>3</td><td>Stonehenge Merapi</td><td>Kepuharjo, Cangkringan, Sleman</td><td><img src="path/to/foto3.jpg" alt="Foto 3" width="100"></td><td>2023-01-03</td></tr>
                            <tr><td>4</td><td>Air Terjun Tlogo Muncar</td><td>Hargobinangun, Pakem, Sleman</td><td><img src="path/to/foto4.jpg" alt="Foto 4" width="100"></td><td>2023-01-04</td></tr>
                            <tr><td>5</td><td>Embung Kaliaji</td><td>Glagaharjo, Cangkringan, Sleman</td><td><img src="path/to/foto5.jpg" alt="Foto 5" width="100"></td><td>2023-01-05</td></tr>
                            <tr><td>6</td><td>Lava Tour Merapi</td><td>Kepuharjo, Cangkringan, Sleman</td></tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- polygon --}}
                <div class="card-body mt-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center align-middle"
                            id="tabeldatapolygons">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tempat</th>
                                    <th>Alamat</th>
                                    <th>Foto</th>
                                    <th>Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($polygons as $p)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->description }}</td>
                                        <td><img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                                width="100"
                                                style="max-height:80px; object-fit:cover; border-radius:8px;"></td>
                                        <td>{{ $p->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach

                                {{-- <tr><td>1</td><td>Kaliurang</td><td>Kaliurang, Hargobinangun, Pakem, Sleman</td><td><img src="path/to/foto1.jpg" alt="Foto 1" width="100"></td><td>2023-01-01</td></tr>
                            <tr><td>2</td><td>Bukit Klangon</td><td>Glagaharjo, Cangkringan, Sleman</td><td><img src="path/to/foto2.jpg" alt="Foto 2" width="100"></td><td>2023-01-02</td></tr>
                            <tr><td>3</td><td>Stonehenge Merapi</td><td>Kepuharjo, Cangkringan, Sleman</td><td><img src="path/to/foto3.jpg" alt="Foto 3" width="100"></td><td>2023-01-03</td></tr>
                            <tr><td>4</td><td>Air Terjun Tlogo Muncar</td><td>Hargobinangun, Pakem, Sleman</td><td><img src="path/to/foto4.jpg" alt="Foto 4" width="100"></td><td>2023-01-04</td></tr>
                            <tr><td>5</td><td>Embung Kaliaji</td><td>Glagaharjo, Cangkringan, Sleman</td><td><img src="path/to/foto5.jpg" alt="Foto 5" width="100"></td><td>2023-01-05</td></tr>
                            <tr><td>6</td><td>Lava Tour Merapi</td><td>Kepuharjo, Cangkringan, Sleman</td></tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.bootstrap5.js"></script>
    <script>
        var langID = {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            paginate: {
                first: "«",
                last: "»",
                next: "›",
                previous: "‹"
            }
        };
        new DataTable('#tabeldatapoints', {
            language: langID
        });
        new DataTable('#tabeldatapolylines', {
            language: langID
        });
        new DataTable('#tabeldatapolygons', {
            language: langID
        });
    </script>
@endsection
