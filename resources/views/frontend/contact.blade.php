@extends('frontend.layouts.app')
@section('title', 'Kontak - NexPark')
@push('styles')
    @include('frontend.layouts.navbar-style')
    <style>
        #map {
            height: 400px;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .contact-info .border {
            border-radius: 15px !important;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            padding: 1.5rem !important;
            margin-bottom: 1rem !important;
        }

        .contact-info .border:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: #01d28e !important;
        }

        .contact-form {
            border-radius: 15px !important;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .form-control {
            border-radius: 10px !important;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #01d28e;
            box-shadow: 0 0 0 0.2rem rgba(1, 210, 142, 0.25);
        }

        textarea.form-control {
            border-radius: 15px !important;
        }

        .btn-primary {
            border-radius: 10px !important;
            padding: 12px 30px;
            transition: all 0.3s ease;
            background: #01d28e !important;
            border: none;
            box-shadow: 0 3px 10px rgba(1, 210, 142, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(1, 210, 142, 0.4);
        }

        .icon {
            min-width: 50px;
            height: 50px;
            background: rgba(1, 210, 142, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem !important;
            transition: all 0.3s ease;
        }

        .border:hover .icon {
            background: #01d28e;
            transform: scale(1.1);
        }

        .icon span {
            color: #01d28e;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .border:hover .icon span {
            color: white;
        }

        .contact-info p {
            margin: 0;
            font-size: 1rem;
            line-height: 1.5;
        }

        .contact-info p span {
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 0.25rem;
        }

        .contact-info a {
            color: #01d28e;
            transition: all 0.3s ease;
        }

        .contact-info a:hover {
            color: #019d6a;
            text-decoration: none;
        }
    </style>
@endpush
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('frontend/images/bg1.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href=" {{ url('/') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Kontak <i
                                class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Kontak Kami</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-4">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="border w-100 rounded">
                                <div class="icon">
                                    <span class="icon-map-o"></span>
                                </div>
                                <div class="text">
                                    <p><span>Alamat</span> Jl. Gatot Subroto No.8, Cimone, Kec. Karawaci, Kota Tangerang,
                                        Banten 15114</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border w-100 rounded">
                                <div class="icon">
                                    <span class="icon-mobile-phone"></span>
                                </div>
                                <div class="text">
                                    <p><span>Telepon</span> <a href="tel://1234567920">0812-3456-7890</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border w-100 rounded">
                                <div class="icon">
                                    <span class="icon-envelope-o"></span>
                                </div>
                                <div class="text">
                                    <p><span>Email</span> <a href="mailto:info@nexpark.com">info@nexpark.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 block-9 mb-md-5">
                    <form action="#" class="bg-light p-5 contact-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="7" class="form-control"
                                placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async
        defer></script>
    <script>
        function initMap() {
            // Koordinat lokasi NexPark (sesuaikan dengan alamat yang benar)
            const nexParkLocation = {
                lat: -6.1766,  // Latitude Tangerang
                lng: 106.6301  // Longitude Tangerang
            };

            // Membuat peta
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: nexParkLocation,
                styles: [
                    {
                        "featureType": "all",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "weight": "2.00"
                            }
                        ]
                    },
                    {
                        "featureType": "all",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#9c9c9c"
                            }
                        ]
                    },
                    {
                        "featureType": "all",
                        "elementType": "labels.text",
                        "stylers": [
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#f2f2f2"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.man_made",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": -100
                            },
                            {
                                "lightness": 45
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#7b7b7b"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#46bcec"
                            },
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#c8d7d4"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#070707"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    }
                ]
            });

            // Menambahkan marker
            const marker = new google.maps.Marker({
                position: nexParkLocation,
                map: map,
                title: 'NexPark',
                animation: google.maps.Animation.DROP
            });

            // Menambahkan info window
            const infowindow = new google.maps.InfoWindow({
                content: '<div style="padding: 10px;"><h5 style="margin: 0;">NexPark</h5><p style="margin: 5px 0;">Jl. Gatot Subroto No.8, Cimone, Kec. Karawaci, Kota Tangerang, Banten 15114</p></div>'
            });

            // Menampilkan info window saat marker diklik
            marker.addListener('click', () => {
                infowindow.open(map, marker);
            });
        }
    </script>
@endpush