<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Enzo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Enzo admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href=" {{ asset('assets/images/favicon/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.png') }}" type="image/x-icon">
    <title>ASMI - Asset System Management Integration</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Google font-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <style>
        #myChart {
            width: 100% !important;
            height: 314PX;
        }

        * {
            box-sizing: border-box;
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            font-size: 30px;
            text-align: left;
            gap: 5rem;
            padding-left: 8rem;
        }

        .flex-item-left {
            background-color: #f1f1f1;
            padding: 50px;
            flex: 50%;
        }

        .flex-item-right {
            background-color: dodgerblue;
            padding: 10px;
            flex: 50%;
        }

        .card-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1;
            text-align: center;
        }

        .card h2 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .card .count {
            margin: 10px 0;
            font-size: 36px;
            font-weight: bold;
            color: #333;
        }

        .card .count.red {
            color: #e63946;
        }

        .card .description {
            font-size: 14px;
            color: #00796b;
            margin: 0;
        }

        .card:nth-child(2) .description {
            color: #e63946;
        }

        .card:nth-child(3) .description {
            color: #00796b;
        }

        .card:nth-child(4) .description {
            color: #00796b;
        }

        .total_asset h2 {
            font-size: 24px;
            /* Heading size */
            color: #333;
            /* Text color */
            margin-bottom: 10px;
            /* Space below heading */

        }

        .bad_asset h2 {
            font-size: 24px;
            /* Heading size */
            color: #333;
            /* Text color */
            margin-bottom: 10px;
            /* Space below heading */
        }

        .good_asset h2 {
            font-size: 24px;
            /* Heading size */
            color: #333;
            /* Text color */
            margin-bottom: 10px;
            /* Space below heading */
        }

        .total_asset h3 {
            font-size: 32px;
            font-weight: bolder;
        }

        .bad_asset h3 {
            font-size: 32px;
            font-weight: bolder;
        }

        .good_asset h3 {
            font-size: 32px;
            font-weight: bolder;
        }



        /* Responsive layout - makes a one column-layout instead of a two-column layout */
        @media (max-width: 800px) {

            .flex-item-right,
            .flex-item-left {
                flex: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <form class="form-inline search-full col" action="#" method="get">
                    <div class="form-group w-100">
                        <div class="Typeahead Typeahead--twitterUsers">
                            <div class="u-posRelative">
                                <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                                    placeholder="Search In Enzo .." name="q" title="" autofocus>
                                <div class="spinner-border Typeahead-spinner" role="status"><span
                                        class="sr-only">Loading...</span></div><i class="close-search"
                                    data-feather="x"></i>
                            </div>
                            <div class="Typeahead-menu"></div>
                        </div>
                    </div>
                </form>
                <div class="header-logo-wrapper col-auto p-0">
                    <aiv class="logo-wrapper">
                        <a href="index.html">
                            <img class="img-fluid" src="{{ asset('assets/images/logo/login.png') }}" alt="">
                        </a>
                    </aiv>
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle"
                            data-feather="align-center"></i></div>
                </div>
                <!-- <div class="left-header col horizontal-wrapper ps-0">
            <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text mobile-search"><i class="fa fa-search"></i></span></div>
              <input class="form-control" type="text" placeholder="Search Here........">
            </div>
          </div> -->
                <div class="nav-right col-8 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li class="onhover-dropdown">
                            <div class="notification-box"><i class="fa fa-bell-o"> </i><span
                                    class="badge rounded-pill badge-primary">4</span></div>
                            <ul class="notification-dropdown onhover-show-div">
                                <li><i data-feather="bell"> </i>
                                    <h6 class="f-18 mb-0">Notifications</h6>
                                </li>
                                <li><a href="email_read.html">
                                        <p><i class="fa fa-circle-o me-3 font-primary"> </i>Delivery processing <span
                                                class="pull-right">10 min.</span></p>
                                    </a></li>
                                <li><a href="email_read.html">
                                        <p><i class="fa fa-circle-o me-3 font-success"></i>Order Complete<span
                                                class="pull-right">1 hr</span></p>
                                    </a></li>
                                <li><a href="email_read.html">
                                        <p><i class="fa fa-circle-o me-3 font-info"></i>Tickets Generated<span
                                                class="pull-right">3 hr</span></p>
                                    </a></li>
                                <li><a href="email_read.html">
                                        <p><i class="fa fa-circle-o me-3 font-danger"></i>Delivery Complete<span
                                                class="pull-right">6 hr</span></p>
                                    </a></li>
                                <li><a class="btn btn-primary" href="email_read.html">Check all notification</a></li>
                            </ul>
                        </li>
                        <li class="onhover-dropdown"><i class="fa fa-comment-o"></i>
                            <ul class="chat-dropdown onhover-show-div">
                                <li><i data-feather="message-square"></i>
                                    <h6 class="f-18 mb-0">Message Box</h6>
                                </li>
                                <li>
                                    <div class="d-flex"><img class="img-fluid rounded-circle me-3"
                                            src="{{ asset('assets/images/user/1.jpg') }}">
                                        <div class="status-circle online"></div>
                                        <div class="flex-grow-1"><a href="chat.html"> <span>Ain Chavez</span>
                                                <p>Do you want to go see movie?</p>
                                            </a></div>
                                        <p class="f-12 font-success">1 mins ago</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex"><img class="img-fluid rounded-circle me-3"
                                            src="{{ asset('assets/images/user/2.png') }}">
                                        <div class="status-circle online"></div>
                                        <div class="flex-grow-1"><a href="chat.html"> <span>Kori Thomas</span>
                                                <p>What`s the project report update?</p>
                                            </a></div>
                                        <p class="f-12 font-success">3 mins ago</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex"><img class="img-fluid rounded-circle me-3"
                                            src="{{ asset('assets/images/dashboard/admins.png') }}">
                                        <div class="status-circle offline"></div>
                                        <div class="flex-grow-1"><a href="chat.html"> <span>Ain Chavez</span>
                                                <p>Thank you for rating us.</p>
                                            </a></div>
                                        <p class="f-12 font-danger">9 mins ago</p>
                                    </div>
                                </li>
                                <li class="text-center"> <a class="btn btn-primary" href="chat.html">View All</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="mode"><i class="fa fa-moon-o"></i></div>
                        </li>
                        <li class="maximize"><a class="text-dark" href="#!"
                                onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                        <li class="profile-nav onhover-dropdown p-0 me-0">
                            <div class="d-flex profile-media"><img class="b-r-50"
                                    src="{{ asset('assets/images/dashboard/profile.jpg') }}">
                                @if (Auth::check())
                                    <div class="flex-grow-1">
                                        <span>{{ Auth::user()->username }}</span>
                                        <p class="mb-0 font-roboto">{{ session('role') ?? Auth::user()->role }} <i
                                                class="middle fa fa-angle-down"></i></p>
                                    </div>
                                @else
                                    <div class="flex-grow-1">
                                        <span>Guest</span>
                                        <p class="mb-0 font-roboto">No role <i class="middle fa fa-angle-down"></i>
                                        </p>
                                    </div>
                                @endif


                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="user-profile.html"><i data-feather="user"></i><span>Account </span></a>
                                </li>
                                <!-- <li><a href="email_inbox.html"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li><a href="kanban.html"><i data-feather="file-text"></i><span>Taskboard</span></a></li> -->
                                <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                                        <i data-feather="log-out"></i><span>Log Out</span></a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
                <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"></div>
            </div>
            </div>
          </script>
                <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('Admin.layouts.right_sidebar_admin')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <!-- Container-fluid starts-->
                <h2 class="py-4 ps-4">Dashboard</h2>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="card flex-row py-4">
                            <div class="col-sm-3">
                                <h2>Total Asset</h2>
                                {{-- {{Auth::user()->role;}} --}}
                                {{-- <ul>
                                    @foreach(auth()->user()->getAllPermissions() as $permission)
                                        <li>{{ $permission->name }}</li>
                                    @endforeach
                                </ul> --}}
                                @role('admin')
                                    {{-- ini adalah admin --}}
                                @endrole
                                <p class="count">{{ $totalAsset }}</p>
                                <p class="description">Total Keseluruhan Asset</p>
                            </div>
                            <div class="col-sm-3">
                                <h2>Bad Asset</h2>
                                <p class="count red">{{ $badAsset }}</p>
                                <p class="description">Total Asset Rusak</p>
                            </div>
                            <div class="col-sm-3">
                                <h2>Good Asset</h2>
                                <p class="count">{{ $goodAsset }}</p>
                                <p class="description">Total Asset Digunakan</p>
                            </div>
                            <div class="col-sm-3">
                                <h2>Total Resto</h2>
                                <p class="count">{{ $totalResto }}</p>
                                <p class="description">Total Registrasi Asset</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="pb-5">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="start_date">Start Date</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date">End Date</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button class="btn btn-primary me-2" onclick="filterNow()">Filter</button>
                                <a href="/admin/dashboard" class="btn btn-secondary ml-2">Reset</a>
                            </div>
                        </div>
                    </div>
                    <!-- Tombol untuk navigasi halaman -->
                    <div class="d-flex justify-content-end">
                        <button id="prevPage" class="btn btn-info me-2">Previous</button>
                        <span id="current-page"> 1</span> / <span id="total-pages">10 </span>
                        <button id="nextPage" class="btn btn-info ms-2">Next</button>
                    </div>
                    <div class="d-flex justify-content-center mb-4">
                        <h2>Asset Per Resto Mie Gacoan</h2>
                    </div>
                    <div id="posts-container"></div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 p-0 footer-left">
                            <!-- <p class="mb-0">Copyright © 2023 Enzo. All rights reserved.</p> -->
                        </div>
                        <div class="col-md-6 p-0 footer-right">
                            <ul class="color-varient">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <p class="mb-0 ms-3">Hand-crafted & made with <i class="fa fa-heart font-danger"></i></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
    <script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/slick-slider/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick-slider/slick-theme.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->

    <script>
        $(document).ready(function() {
            // Make an AJAX GET request to fetch the total data asset
            $.ajax({
                url: '/user/get_data_total_asset', // API endpoint
                method: 'GET',
                success: function(response) {
                    // Display the total count in the paragraph
                    $('#data_total_asset').text(`${response.total_count}`);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error fetching data:', error);
                    $('#data_total_asset').text('Failed to fetch data.');
                }
            });

            $.ajax({
                url: '/user/get_data_total_asset_rusak', // API endpoint
                method: 'GET',
                success: function(response) {
                    // Display the total count in the paragraph
                    $('#data_total_asset_rusak').text(`${response.total_count}`);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error fetching data:', error);
                    $('#data_total_asset_rusak').text('Failed to fetch data.');
                }
            });

            $.ajax({
                url: '/user/get_data_total_asset_bagus', // API endpoint
                method: 'GET',
                success: function(response) {
                    // Display the total count in the paragraph
                    $('#data_total_asset_bagus').text(`${response.total_count}`);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error fetching data:', error);
                    $('#data_total_asset_bagus').text('Failed to fetch data.');
                }
            });

        });
    </script>
    <script>
        let currentPage = 1; // Halaman saat ini
        const itemsPerPage = 10; // Jumlah restoran per halaman

        let labels = [];
        let data1 = []; // Data pertama
        let data2 = []; // Data kedua
        let data3 = []; // Data ketiga (data disposal)

        $(document).ready(function() {
            // Mengambil data melalui AJAX ketika halaman siap
            fetchRestoData();
        });

        // Fungsi filter berdasarkan tanggal
        function filterNow() {
            const startDate = $("#start_date").val();
            const endDate = $("#end_date").val();

            // Pastikan startDate dan endDate valid
            if (startDate && endDate) {
                // Panggil fetchRestoData dengan startDate dan endDate
                fetchRestoData(startDate, endDate);
            } else {
                alert('Silakan pilih tanggal dengan benar!');
            }
        }

        // Fungsi mengambil data restoran
        function fetchRestoData(startDate, endDate) {
            $.ajax({
                url: '{{ url('/admin/get-resto-json') }}', // URL untuk mengambil data
                method: 'GET',
                data: {
                    start_date: startDate, // Ambil nilai start_date dari input
                    end_date: endDate // Ambil nilai end_date dari input
                },
                dataType: 'json', // Format data yang diharapkan
                success: function(response) {
                    if (response && Object.keys(response).length > 0) {
                        processRestoData(response);
                    } else {
                        $('#posts-container').html('<p>Tidak ada data.</p>');
                    }
                },
                error: function() {
                    $('#posts-container').html('<p>Terjadi kesalahan saat mengambil data.</p>');
                }
            });
        }

        // Fungsi untuk memproses data restoran dan membuat chart
        function processRestoData(response) {
            // Reset data setiap kali pemrosesan baru dilakukan
            labels = [];
            data1 = [];
            data2 = [];
            data3 = [];

            var restoMap = {};

            response.forEach(function(resto) {
                if (resto.asset_model !== null) {
                    if (!restoMap[resto.id_resto]) {
                        restoMap[resto.id_resto] = {
                            id_resto: resto.id_resto,
                            asset_model: resto.asset_model,
                            condition_name: resto.condition_name,
                            condition_id: resto.condition_id,
                            qty: resto.qty,
                            qty_disposal: resto.qty_disposal
                        };
                    } else {
                        restoMap[resto.id_resto].qty += resto.qty;
                    }
                    if (resto.condition_id === 3 || resto.condition_id === 1) {
                        restoMap[resto.id_resto].qty_good = (restoMap[resto.id_resto].qty_good || 0) + resto.qty;
                    }
                    if (resto.out_id.includes("DA")) {
                        restoMap[resto.id_resto].qty_disposal = (restoMap[resto.id_resto].qty_disposal || 0) + resto
                            .qty;
                    }

                    // Memisahkan name_store_street berdasarkan '-'
                    const explode_street = resto.name_store_street.split('-');

                    // Ambil elemen 1 dan 2 dari hasil split
                    if (explode_street.length > 1) {
                        restoMap[resto.id_resto].name_store_street = explode_street[1].trim() + " - " +
                            explode_street[2].trim();
                    }

                }
            });

            // Mengubah restoMap menjadi array yang bisa digunakan untuk chart
            Object.values(restoMap).forEach(function(resto) {
                labels.push(resto.name_store_street);
                data1.push(resto.qty);
                data2.push(resto.qty_good || 0);
                data3.push(resto.qty_disposal);
            });

            // Perbarui chart untuk halaman pertama
            updateChart();
        }

        // Fungsi untuk memperbarui chart berdasarkan halaman yang aktif
        function updateChart() {
            // Mendapatkan konteks canvas
            var ctx = document.getElementById('myChart').getContext('2d');

            // Mengecek apakah chart sudah ada sebelumnya dan menghancurkannya
            if (window.myChart instanceof Chart) {
                window.myChart.destroy();
            }

            // Membatasi data yang akan ditampilkan pada halaman ini
            const startIdx = (currentPage - 1) * itemsPerPage;
            const endIdx = startIdx + itemsPerPage;
            const pageLabels = labels.slice(startIdx, endIdx);
            const pageTotalAsset = data1.slice(startIdx, endIdx);
            const pageGoodAsset = data2.slice(startIdx, endIdx);
            const pageDisposalAsset = data3.slice(startIdx, endIdx);

            // Membuat chart baru dan menyimpannya ke dalam window.myChart
            window.myChart = new Chart(ctx, {
                type: 'bar', // Jenis chart, bisa diganti dengan line, pie, dll
                data: {
                    labels: pageLabels, // Label sumbu X
                    datasets: [{
                            label: 'Total Asset',
                            data: pageTotalAsset, // Data asli
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang
                            borderColor: 'rgba(75, 192, 192, 1)', // Warna border
                            borderWidth: 1
                        },
                        {
                            label: 'Good Asset',
                            data: pageGoodAsset, // Data good
                            backgroundColor: 'rgba(153, 102, 255, 0.2)', // Warna latar belakang
                            borderColor: 'rgba(153, 102, 255, 1)', // Warna border
                            borderWidth: 1
                        },
                        {
                            label: 'Disposal Asset',
                            data: pageDisposalAsset, // Data disposal
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Warna latar belakang
                            borderColor: 'rgba(255, 159, 64, 1)', // Warna border
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Perbarui tombol navigasi (Next dan Previous)
            updatePagination();
        }

        // Fungsi untuk memperbarui tombol pagination
        function updatePagination() {
            const totalPages = Math.ceil(labels.length / itemsPerPage);
            $('#current-page').text(currentPage);
            $('#total-pages').text(totalPages);

            // Sembunyikan tombol "Previous" jika sudah di halaman pertama
            $('#prevPage').prop('disabled', currentPage === 1);

            // Sembunyikan tombol "Next" jika sudah di halaman terakhir
            $('#nextPage').prop('disabled', currentPage === totalPages);
        }

        // Event listeners untuk tombol navigasi paging
        $('#nextPage').on('click', function() {
            const totalPages = Math.ceil(labels.length / itemsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                updateChart(); // Perbarui chart untuk halaman berikutnya
            }
        });

        $('#prevPage').on('click', function() {
            if (currentPage > 1) {
                currentPage--;
                updateChart(); // Perbarui chart untuk halaman sebelumnya
            }
        });
    </script>
</body>

</html>
