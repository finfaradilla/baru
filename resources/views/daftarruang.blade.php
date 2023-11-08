@extends('layouts.main')

@section('container')
    <!--====== Daftar Ruang ======-->
    <section id="blog" class="blog-area pt-170 pb-140">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">Daftar Ruangan</h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Pesan Ruang dengan Lebih Mudah! Kami menyediakan solusi
                            peminjaman ruang yang praktis untuk mahasiswa dan staf universitas.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($rooms as $room)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-img">

                                <a href="/showruang/{{ $room->code }}">
                                    <img class="randomImage" data-src="{{ $room->image_url }}" alt="Gambar Blog">
                                </a>

                            </div>
                            <div class="blog-content">
                                <h4><a href="/showruang/{{ $room->code }}">{{ $room->name }}</a></h4>
                                <p>Gedung : {{ $room->building->name }}</p>
                                <p>Kapasitas : {{ $room->capacity }}</p>

                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-end">
                    {{ $rooms->links() }}
                </div>
            </div>


        </div>
    </section>

    <section id="contact" class="contact-area">
        <div class="map-bg">
            <img src="assets/images/map-bg.svg" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">Form Pinjam Ruang</h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Isi form secara lengkap untuk meminjam ruangan</p>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7">
                    <div class="contact-form-wrapper">
                        <form action="assets/contact.php">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" placeholder="Name" name="name" id="name">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" placeholder="Email" name="email" id="email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" placeholder="Subject" name="subject" id="subject">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <textarea name="message" id="message" rows="4" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button class="main-btn btn-hover" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Daftar Ruang ======-->
@endsection
