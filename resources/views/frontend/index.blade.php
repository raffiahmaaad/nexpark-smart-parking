@extends('frontend.layouts.app')
@section('title', 'NexPark')
@push('styles')
    @include('frontend.layouts.navbar-style')
    <style>
        .car-wrap {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(1, 210, 142, 0.1);
        }

        .car-wrap:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(1, 210, 142, 0.2);
        }

        .car-wrap .img {
            height: 280px;
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
        }

        .car-wrap .img::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6) 0%, transparent 100%);
        }

        .car-wrap .text {
            padding: 2rem;
            position: relative;
            background: white;
        }

        .car-wrap .text h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #333;
            text-align: center;
        }

        .car-wrap .text h2 a {
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .car-wrap .text h2 a:hover {
            color: #01d28e;
        }

        .car-wrap .price-category {
            background: rgba(1, 210, 142, 0.1);
            padding: 1.2rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }

        .car-wrap .cat {
            color: #333;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
            text-align: center;
            margin-bottom: 0.8rem;
            background: white;
            padding: 0.5rem 1rem;
            border-radius: 10px;
        }

        .car-wrap .price {
            color: #01d28e;
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin: 0;
            line-height: 1.2;
        }

        .car-wrap .price span {
            font-size: 1rem;
            font-weight: 500;
            color: #666;
        }

        .btn-book {
            background: #01d28e;
            color: white;
            padding: 1rem 2rem;
            border-radius: 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
            width: 100%;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(1, 210, 142, 0.2);
        }

        .btn-book:hover {
            background: #019d6a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(1, 210, 142, 0.3);
            color: white;
            text-decoration: none;
        }

        .d-flex {
            align-items: center;
        }

        .carousel-car .owl-stage {
            padding: 1rem 0;
        }

        @media (max-width: 768px) {
            .car-wrap .img {
                height: 200px;
            }

            .car-wrap .text {
                padding: 1.5rem;
            }

            .car-wrap .text h2 {
                font-size: 1.3rem;
                margin-bottom: 1rem;
            }

            .car-wrap .price {
                font-size: 1.8rem;
            }

            .car-wrap .cat {
                font-size: 0.9rem;
            }

            .btn-book {
                padding: 0.8rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        /* Testimonial Styles */
        .testimony-section {
            padding: 7em 0;
            background: #f8f9fa;
            position: relative;
            overflow: hidden;
        }

        .testimony-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(to bottom, #fff 0%, transparent 100%);
        }

        .testimony-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(to top, #fff 0%, transparent 100%);
        }

        .carousel-testimony .owl-stage {
            display: flex;
            align-items: stretch;
        }

        .carousel-testimony .item {
            height: 100%;
            display: flex;
        }

        .testimony-wrap {
            background: white;
            padding: 2.5rem;
            border-radius: 40px;
            position: relative;
            margin: 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(1, 210, 142, 0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .testimony-wrap:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(1, 210, 142, 0.1);
        }

        .testimony-wrap .text {
            text-align: center;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1rem 0;
        }

        .testimony-wrap .text p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #666;
            font-style: italic;
            margin-bottom: 1.5rem;
            position: relative;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        .testimony-wrap .info-wrapper {
            margin-top: auto;
        }

        .testimony-wrap .name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .testimony-wrap .position {
            font-size: 1rem;
            color: #01d28e;
            font-weight: 600;
            display: inline-block;
            padding: 0.3rem 1rem;
            background: rgba(1, 210, 142, 0.1);
            border-radius: 20px;
            margin-bottom: 0;
        }

        .testimony-wrap .user-img {
            width: 100px !important;
            height: 100px !important;
            border-radius: 50%;
            position: relative;
            margin: 0 auto 2rem auto;
            border: 5px solid #fff;
            box-shadow: 0 5px 15px rgba(1, 210, 142, 0.2);
            background-size: cover;
            background-position: center;
        }

        .carousel-testimony .owl-dots {
            text-align: center;
            margin-top: 30px;
        }

        .carousel-testimony .owl-dot {
            display: inline-block;
            margin: 0 5px;
        }

        .carousel-testimony .owl-dot span {
            display: block;
            width: 10px;
            height: 10px;
            background: rgba(1, 210, 142, 0.2);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .carousel-testimony .owl-dot.active span {
            background: #01d28e;
            width: 20px;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .testimony-wrap {
                padding: 2rem;
                margin: 10px;
            }

            .testimony-wrap .user-img {
                width: 80px !important;
                height: 80px !important;
            }

            .testimony-wrap .text p {
                font-size: 1rem;
            }

            .testimony-wrap .name {
                font-size: 1.1rem;
            }

            .testimony-wrap .position {
                font-size: 0.9rem;
            }
        }
    </style>
@endpush
@section('content')
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('frontend/images/bg1.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
                <div class="col-lg-8 ftco-animate">
                    <div class="text w-100 text-center mb-md-5 pb-md-5">
                        <h1 class="mb-4">Parkir Aman &amp; Nyaman</h1>
                        <p style="font-size: 18px;">Temukan kemudahan parkir di era digital dengan NexPark <br>
                            Kami menghadirkan solusi parkir modern yang menggabungkan teknologi canggih dan kemudahan akses
                            untuk pengalaman parkir yang lebih baik.</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12	featured-top">
                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex align-items-center">

                        </div>

                    </div>
                </div>
            </div>
    </section>


    <section class="ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <span class="subheading">Kami Tawarkan untuk Anda</span>
                    <h2 class="mb-2">Tempat Parkir yang Nyaman dan Aman</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-car owl-carousel">
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end"
                                    style="background-image: url(frontend/images/bg2.jpg);">
                                </div>
                                <div class="text">
                                    <h2><a href="#">Parkir - Area B</a></h2>
                                    <div class="price-category">
                                        <div class="cat">Khusus untuk Mobil</div>
                                        <div class="price">Rp. 5.000 <span>/jam</span></div>
                                    </div>
                                    <a href="{{ route('frontend.parking.form') }}" class="btn-book">Book now</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end"
                                    style="background-image: url(frontend/images/parkir_bis.jpg);">
                                </div>
                                <div class="text">
                                    <h2><a href="#">Parkir - Area C</a></h2>
                                    <div class="price-category">
                                        <div class="cat">Khusus untuk Bus</div>
                                        <div class="price">Rp. 10.000 <span>/jam</span></div>
                                    </div>
                                    <a href="{{ route('frontend.parking.form') }}" class="btn-book">Book now</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end"
                                    style="background-image: url(frontend/images/parkir_motor.jpg);">
                                </div>
                                <div class="text">
                                    <h2><a href="#">Parkir - Area A</a></h2>
                                    <div class="price-category">
                                        <div class="cat">Khusus untuk Motor</div>
                                        <div class="price">Rp. 2.000 <span>/jam</span></div>
                                    </div>
                                    <a href="{{ route('frontend.parking.form') }}" class="btn-book">Book now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Testimoni Pelanggan</span>
                    <h2 class="mb-3">Apa Kata Mereka?</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        <div class="item">
                            <div class="testimony-wrap rounded text-center">
                                <div class="user-img" style="background-image: url(frontend/images/person_1.jpg);">
                                </div>
                                <div class="text">
                                    <p>"Sistem parkir yang sangat membantu! Saya tidak perlu khawatir lagi mencari tempat
                                        parkir dan pembayarannya sangat mudah."</p>
                                    <div class="name">Ahmad Rizki</div>
                                    <span class="position">Pengusaha</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap rounded text-center">
                                <div class="user-img" style="background-image: url(frontend/images/person_2.jpg);">
                                </div>
                                <div class="text">
                                    <p>"Aplikasi yang luar biasa! Sekarang saya bisa memesan tempat parkir sebelum sampai ke
                                        lokasi. Sangat menghemat waktu."</p>
                                    <div class="name">Andi Wibowo</div>
                                    <span class="position">Karyawan Swasta</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap rounded text-center">
                                <div class="user-img" style="background-image: url(frontend/images/person_3.jpg);">
                                </div>
                                <div class="text">
                                    <p>"Keamanan parkir terjamin dan staff sangat membantu. Harga yang ditawarkan juga
                                        sangat terjangkau."</p>
                                    <div class="name">Budi Santoso</div>
                                    <span class="position">Dosen</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-counter ftco-section img bg-light" id="section-counter">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center justify-content-center">
                            <strong class="number" data-number="3" style="color: #01d28e;">0</strong>
                            <span>Tahun <br>Pengalaman</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center justify-content-center">
                            <strong class="number" data-number="500" style="color: #01d28e;">0</strong>
                            <span>Total <br>Kendaraan</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center justify-content-center">
                            <strong class="number" data-number="610" style="color: #01d28e;">0</strong>
                            <span>Pelanggan <br>Puas</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text d-flex align-items-center justify-content-center">
                            <strong class="number" data-number="10" style="color: #01d28e;">0</strong>
                            <span>Total <br>Cabang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection