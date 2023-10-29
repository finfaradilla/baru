@extends('layouts.main')

@section('container')
    <!-- Start Hero -->
    <div class="hero">
        <div class="hero__inner container">
            <div class="hero-description">
                <h3>Universitas Teknokrat Indonesia | Peminjaman Ruangan Kampus</h3>
                <p>Streamline loan, make it easy for you to keep working and creating!</p>
            </div>
        </div>
    </div>
    <!-- End Hero -->
    <!-- Start Daftar Ruangan -->
    <div class="daftar-ruangan my-5 container">
        <h3 class="title-daftar-ruangan text-center">
            Daftar Ruangan
        </h3>
        <div class="list-ruangan d-flex flex-wrap justify-content-center">
            <div class="card m-3" style="width: 18rem;">
                <img src="img/ruang-kelas.jpeg" style="height: 250px" class="card-img-top" alt="Ruang Kelas">
                <div class="card-body">
                    <h5 class="card-title text-center">Ruang Kelas</h5>
                    <p class="card-text">Ruang kelas ini memiliki kapasitas 20-30 orang dan biasanya dipakai untuk
                        perkuliahan.</p>
                </div>
            </div>
            <div class="card m-3" style="width: 18rem;">
                <img src="img/lab-komputer.jpeg" style="height: 250px" class="card-img-top" alt="Ruang Kelas">
                <div class="card-body">
                    <h5 class="card-title text-center">Ruang Lab</h5>
                    <p class="card-text">Ruang lab berisi komputer yang biasanya dipakai untuk praktikum. Kapasitas ruangan
                        ini biasanya mencapai 20-25 orang</p>
                </div>
            </div>
            <div class="card m-3" style="width: 18rem;">
                <img src="img/noPhoto.png" style="height: 250px" class="card-img-top" alt="Ruang Kelas">
                <div class="card-body">
                    <h5 class="card-title text-center">Ruang Dosen</h5>
                    <p class="card-text">Ruang ini digunakan oleh dosen untuk istirahat</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Daftar Ruangan -->
@endsection
