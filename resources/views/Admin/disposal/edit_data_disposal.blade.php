<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <!-- Google font-->
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #f0f7ff;
            padding: 20px;
            border-radius: 10px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .form-group>div {
            flex: 1;
            min-width: 200px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .qr-code {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
            width: 150px;
            height: 150px;
            margin-top: 10px;
            background-color: #f0f0f0;
        }

        .button-form {
            text-align: right;
        }

        .asset-fields {
            margin-bottom: 30px;
            /* Adjust value as needed for spacing */
        }

        .scan-container {
            border: 2px solid #007bff;
            /* Blue border */
            border-radius: 8px;
            /* Rounded corners */
            padding: 20px;
            /* Spacing inside the container */
            background-color: #f7fbff;
            /* Light blue background */
            width: 100%;
            /* Full width of the container */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
        }

        .scan-header h3 {
            margin: 0 0 10px 0;
            /* Remove margin at the top and add space below */
            font-family: Arial, sans-serif;
            font-size: 18px;
            color: #333;
            /* Dark text color */
        }

        .scan-input {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            /* Space between input and action buttons */
        }

        .scan-input input {
            flex: 1;
            /* Takes the remaining space */
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .scan-input .search-button {
            background-color: #007bff;
            /* Blue button */
            color: white;
            border: none;
            padding: 10px 15px;
            margin-left: 5px;
            /* Space between input and button */
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .scan-input .search-button i {
            font-size: 16px;
        }

        .scan-actions {
            text-align: right;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #555;
            /* Slightly darker text */
        }

        .scan-actions span {
            margin-left: 20px;
            /* Space between each action */
        }


        .btn-showcase {
            position: relative;
            top: 1.5rem;
        }

        #assetFieldsContainer {
            position: relative;
            top: 2.2rem;
        }

        .btn-submit-form {
            position: relative;
            top: 1rem;
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
                    <div class="logo-wrapper">
                        <a href="index.html">
                            <img class="img-fluid" src="{{ asset('assets/images/logo/login.png') }}" alt="">
                        </a>
                    </div>
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
                        <!-- <li class="onhover-dropdown">
                <div class="notification-box"><i class="fa fa-bell-o"> </i><span class="badge rounded-pill badge-primary">4</span></div>
                <ul class="notification-dropdown onhover-show-div">
                  <li><i data-feather="bell">            </i>
                    <h6 class="f-18 mb-0">Notifications</h6>
                  </li>
                  <li><a href="email_read.html">
                      <p><i class="fa fa-circle-o me-3 font-primary"> </i>Delivery processing <span class="pull-right">10 min.</span></p></a></li>
                  <li><a href="email_read.html">
                      <p><i class="fa fa-circle-o me-3 font-success"></i>Order Complete<span class="pull-right">1 hr</span></p></a></li>
                  <li><a href="email_read.html">
                      <p><i class="fa fa-circle-o me-3 font-info"></i>Tickets Generated<span class="pull-right">3 hr</span></p></a></li>
                  <li><a href="email_read.html">
                      <p><i class="fa fa-circle-o me-3 font-danger"></i>Delivery Complete<span class="pull-right">6 hr</span></p></a></li>
                  <li><a class="btn btn-primary" href="email_read.html">Check all notification</a></li>
                </ul>
              </li> -->
                        <!-- <li class="onhover-dropdown"><i class="fa fa-comment-o"></i>
                <ul class="chat-dropdown onhover-show-div">
                  <li><i data-feather="message-square"></i>
                    <h6 class="f-18 mb-0">Message Box</h6>
                  </li>
                  <li>
                    <div class="d-flex"><img class="img-fluid rounded-circle me-3" src="{{ asset('assets/images/user/1.jpg') }}">
                      <div class="status-circle online"></div>
                      <div class="flex-grow-1"><a href="chat.html"> <span>Ain Chavez</span>
                          <p>Do you want to go see movie?</p></a></div>
                      <p class="f-12 font-success">1 mins ago</p>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex"><img class="img-fluid rounded-circle me-3" src="{{ asset('assets/images/user/2.png') }}">
                      <div class="status-circle online"></div>
                      <div class="flex-grow-1"><a href="chat.html"> <span>Kori Thomas</span>
                          <p>What`s the project report update?</p></a></div>
                      <p class="f-12 font-success">3 mins ago</p>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex"><img class="img-fluid rounded-circle me-3" src="{{ asset('assets/images/dashboard/admins.png') }}">
                      <div class="status-circle offline"></div>
                      <div class="flex-grow-1"><a href="chat.html"> <span>Ain Chavez</span>
                          <p>Thank you for rating us.</p></a></div>
                      <p class="f-12 font-danger">9 mins ago</p>
                    </div>
                  </li>
                  <li class="text-center"> <a class="btn btn-primary" href="chat.html">View All</a></li>
                </ul>
              </li> -->
                        <li>
                            <div class="mode"><i class="fa fa-moon-o"></i></div>
                        </li>
                        <li class="maximize"><a class="text-dark" href="#!"
                                onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                        <li class="profile-nav onhover-dropdown p-0 me-0">
                            <div class="d-flex profile-media"><img class="b-r-50"
                                    src="{{ asset('assets/images/dashboard/profile.jpg') }}">
                                <?php $session = session(); ?>
                                <div class="flex-grow-1"><span>{{ Auth::user()->username }}</span>
                                    <p class="mb-0 font-roboto">{{ Auth::user()->role }}<i
                                            class="middle fa fa-angle-down"></i></p>
                                </div>

                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="user-profile.html"><i data-feather="user"></i><span>Account </span></a>
                                </li>
                                <!-- <li><a href="email_inbox.html"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li><a href="kanban.html"><i data-feather="file-text"></i><span>Taskboard</span></a></li> -->
                                <li><a href="/logout"><i data-feather="log-out"> </i><span>Log Out</span></a></li>
                            </ul>
                        </li>
                    </ul>
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
                <br>
                <h3 class="ms-4"><b>Edit Data Asset Disposal</b></h3>



                <div class="modal fade" id="searchRegistData" tabindex="-1" role="dialog"
                    aria-labelledby="searchRegistDataLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                            </div>
                            <div class="modal-body">
                                <table id="assetTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Register Code</th>
                                            <th>Asset Name</th>
                                            <th>Type</th>
                                            <th>Category</th>
                                            <th>Condition</th>
                                            <th>Width</th>
                                            <th>Height</th>
                                            <th>Depth</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </div>
                </div>

                <br>
                <div class="container-fluid">
                    <div class="section">
                        <div class="card p-5">
                            <div class="form-group">
                                <form action="{{ url('/admin/update_data_disposal_out', $moveOutAssets->out_id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <input type="hidden" id="out_id" value="{{ $moveOutAssets->out_id }}">
                                        <!-- <input type="hidden" id="out_det_id" value="{{ $moveOutAssets->out_det_id }}"> -->
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="out_date">Tanggal Movement Out:</label>
                                                <input type="date" name="out_date" id="out_date" class="form-control"
                                                value="{{ $moveOutAssets->out_date }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="from_loc">Lokasi Asal:</label>
                                                <!-- Visible input for name_store_street -->
                                                <input type="text" id="from_loc" class="form-control" value="{{ $moveOutAssets->name_store_street }}" readonly>
                                                <!-- Hidden input for id -->
                                                <input type="hidden" id="from_loc_id" name="from_loc_id">
                                            </div>
                                        </div>




                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="out_desc">Deskripsi Disposal Out:</label>
                                                <input type="text" name="out_desc" id="out_desc" class="form-control"
                                                value="{{ $moveOutAssets->out_desc }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="reason_id">Alasan Disposal Out:</label>
                                                <select name="reason_id" id="reason_id" class="form-control" required>
                                                    @foreach ($reasons as $reason)
                                                    <option value="{{ $reason->reason_id }}"
                                                        @if ($reason->reason_id == $moveOutAssets->reason_id) selected @endif>
                                                        {{ $reason->reason_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div id="assetFieldsContainer">
                                            <div class="asset-fields">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="asset_id">Data Asset:</label>
                                                            <select name="asset_id[]" id="asset_id"
                                                            class="form-control asset-select" required>
                                                            <option value="">Pilih Asset</option>
                                                            @foreach ($assets as $asset)
                                                            <option value="{{ $asset->id }}">
                                                                {{ $asset->asset_model }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="merk">Merk:</label>
                                                            <input class="form-control" type="text" name="merk_display[]" readonly>
                                                            <input type="hidden" name="merk[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="qty">Quantity:</label>
                                                            <input type="text" name="qty[]" id="qty"
                                                            class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="satuan">Satuan:</label>
                                                            <input class="form-control" type="text" name="satuan_display[]" readonly>
                                                            <input type="hidden" name="satuan[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="serial_number">Serial Number:</label>
                                                            <input type="text" name="serial_number[]" id="serial_number"
                                                            class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="register_code">Register Code:</label>
                                                            <input type="text" name="register_code[]" id="register_code"
                                                            class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="condition_id_0">Kondisi Asset:</label>
                                                            <select name="condition_id[]" id="condition_id_0"
                                                            class="form-control condition-select" required>
                                                            <option value="">Pilih Kondisi</option>
                                                            @foreach ($conditions as $condition)
                                                            <option value="{{ $condition->condition_id }}">
                                                                {{ $condition->condition_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Image:</label>
                                                            <input type="file" name="image[]"
                                                            class="form-control image-input" accept="image/*">
                                                            <div class="selected-file-name"></div>
                                                        </div>
                                                    </div>
                                                    <br><br><br><br>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <label for="image">Image/Gambar Barang Data di dalam
                                                                database:</label>
                                                            <div class="container-image"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    class="btn btn-success btn-add-asset mt-2">+</button>
                                                <button type="button"
                                                    class="btn btn-danger btn-remove-asset mt-2">-</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="btn-submit-form">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>
        <!-- footer start-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 p-0 footer-left">
                        <!-- <p class="mb-0">Copyright © 2023 Enzo.  All rights reserved.</p> -->
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

    <!-- Correct order: jQuery first, then Bootstrap JS -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    =<!-- Popper.js next (use the CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    <!-- Bootstrap JS (use the CDN or your local version) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>



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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/data-registrasi-asset.js') }}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>


    <!-- login js-->
    <!-- Plugin used-->
</body>


<script>
    $(document).on('change', '.image-input', function() {
        const file = this.files[0];
        const $parent = $(this).closest('.col-sm-3');

        if (file) {
            // Show the selected file name
            $parent.find('.selected-file-name').text('Selected: ' + file.name);
        } else {
            $parent.find('.selected-file-name').text('');
        }
    });
</script>

{{-- <script>
    $.ajax({
        url: '/api/get-location',
        method: 'GET',
        success: function(response) {
            if (response) {
                // Display the name_store_street in the visible input
                $('#from_loc').val(response.name_store_street);

                // Store the id in the hidden input
                $('#from_loc_id').val(response.id);



            } else {
                console.warn('Location data not found.');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + error);
        }
    });
</script> --}}


<script>
    $(document).ready(function() {

        function initializeAssetSelect2(element) {
            $(element).select2({
                placeholder: 'Pilih Asset',
                allowClear: true,
                width: '100%',
                ajax: {
                    url: '/api/get-data-assets',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.asset_name
                                };
                            })
                        };
                    },
                    cache: true
                }
            }).on('select2:clear', function() {
                var $parent = $(this).closest('.asset-fields');
                $parent.find('input').val('');
            });
        }

        function initializeConditionSelect2(element) {
            $(element).select2({
                placeholder: 'Pilih Kondisi',
                allowClear: true,
                width: '100%'
            });
        }

        // Function to create a fresh asset field
        function createFreshAssetField() {
            // Clone the template
            const $template = $('.asset-fields').first();
            const $newField = $template.clone();

            // Generate unique ID
            const uniqueId = 'asset_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);

            // Reset and update all form elements
            $newField.find('input').each(function() {
                $(this).val('');
                $(this).attr('id', $(this).attr('id') + '_' + uniqueId);
            });

            // Clear and update asset select
            const $assetSelect = $newField.find('.asset-select');
            $assetSelect.empty();
            $assetSelect.attr('id', 'asset_select_' + uniqueId);
            $assetSelect.removeData();
            $assetSelect.removeClass('select2-hidden-accessible');
            $assetSelect.find('option').remove();

            // Clear and update condition select
            const $conditionSelect = $newField.find('select[name="condition_id[]"]');
            $conditionSelect.attr('id', 'condition_' + uniqueId);
            $conditionSelect.val('');
            $conditionSelect.removeData();
            $conditionSelect.removeClass('select2-hidden-accessible');

            // Remove any existing select2 containers
            $newField.find('.select2-container').remove();
            $newField.find('.image-input').val('');
            $newField.find('.selected-file-name').text('');

            return $newField;
        }



        // Initialize existing fields
        $(document).ready(function() {
            $('.asset-select').each(function() {
                initializeAssetSelect2(this);
            });

            $('select[name="condition_id[]"]').each(function() {
                initializeConditionSelect2(this);
            });
        });

        // Handle asset selection change
        $(document).on('change', '.asset-select', function() {
            const assetId = $(this).val();
            const $parent = $(this).closest('.asset-fields');

            if (!assetId) {
                $parent.find('input').val('');
                $parent.find('.selected-file-name').text('');
                return;
            }

            $.ajax({
                url: '/api/get-asset-details/' + assetId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $parent.find('input[name="merk_display[]"]').val(data.brand_name);
                    $parent.find('input[name="merk[]"]').val(data.brand_id);
                    $parent.find('input[name="qty[]"]').val(data.qty);
                    $parent.find('input[name="satuan_display[]"]').val(data.uom_name);
                    $parent.find('input[name="satuan[]"]').val(data.uom_id);
                    $parent.find('input[name="serial_number[]"]').val(data.serial_number ||
                        '');
                    $parent.find('input[name="register_code[]"]').val(data.register_code ||
                        '');
                    //         if (data.image) {
                    //     const fileName = data.image.split('/').pop(); // Extract filename from the path
                    //     $parent.find('.selected-file-name').text('Current: ' + fileName);
                    // }
                },
            });
        });

        // Add new asset field
        $(document).on('click', '.btn-add-asset', function() {
            // Create fresh field
            const $newField = createFreshAssetField();

            // Append the new field
            $('#assetFieldsContainer').append($newField);

            // Initialize Select2 on new fields
            initializeAssetSelect2($newField.find('.asset-select'));
            initializeConditionSelect2($newField.find('select[name="condition_id[]"]'));
        });

        // Remove asset field
        $(document).on('click', '.btn-remove-asset', function() {
            if ($('#assetFieldsContainer .asset-fields').length > 1) {
                const $field = $(this).closest('.asset-fields');
                // Destroy Select2 instances before removing
                $field.find('.select2-hidden-accessible').select2('destroy');
                $field.remove();
            } else {
                alert('At least one asset field must remain.');
            }
        });
        $('form').on('submit', function(e) {
            e.preventDefault();

            // Implement proper validation
            let isValid = true;

            // Check required fields
            $(this).find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Validate location
            const fromLocId = $('#from_loc_id').val();
            if (!fromLocId) {
                isValid = false;
                alert('Please select a source location.');
            }

            if (!isValid) {
                alert('Please fill in all required fields and select a location.');
                return false;
            }

            // Collect form data
            var formData = new FormData(this);

            // Submit form via AJAX
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Data submitted successfully');
                    window.location.href = '/admin/disout';
                },
                error: function(xhr) {
                    alert('Error submitting form: ' + xhr.responseText);
                }
            });
        });



    });
</script>



<script>
    $(document).ready(function() {
        const table = $('#assetTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '/api/ajaxGetDataRegistAsset',
                type: 'GET'
            },
            columns: [{
                    data: 'register_code'
                },
                {
                    data: 'asset_name'
                },
                {
                    data: 'type_asset'
                },
                {
                    data: 'category_asset'
                },
                {
                    data: 'condition'
                },
                {
                    data: 'width'
                },
                {
                    data: 'height'
                },
                {
                    data: 'depth'
                },

            ]
        });

        // Handle row click event
        $('#assetTable tbody').on('click', 'tr', function() {
            const rowData = table.row(this).data(); // Get row data

            if (!rowData) {
                alert('No data found for this row.');
                return;
            }

            const $newField = createFreshAssetField();

            $newField.find('select.asset-select').html(
                `<option value="${rowData.id}" selected>${rowData.asset_name}</option>`);
            $newField.find('input[name="merk_display[]"]').val(rowData.merk);
            $newField.find('input[name="merk[]"]').val(rowData.brand_id)
            $newField.find('input[name="qty[]"]').val(rowData.qty);
            $newField.find('input[name="satuan_display[]"]').val(rowData.satuan);
            $newField.find('input[name="satuan[]"]').val(rowData.uom_id);
            $newField.find('input[name="serial_number[]"]').val(rowData.serial_number);
            $newField.find('input[name="register_code[]"]').val(rowData.register_code);
            $newField.find('input[name="image[]"]').val(rowData.image);

            // Append the new field
            $('#assetFieldsContainer').append($newField);

            // Initialize Select2 for new fields
            initializeAssetSelect2($newField.find('.asset-select'));
            initializeConditionSelect2($newField.find('select[name="condition_id[]"]'));

            // Close modal
            $('#searchRegistData').modal('hide');
        });

        function createFreshAssetField() {
            // Clone the template
            const $template = $('.asset-fields').first();
            const $newField = $template.clone();

            // Generate unique ID
            const uniqueId = 'asset_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);

            // Reset and update all form elements
            $newField.find('input').each(function() {
                $(this).val('');
                $(this).attr('id', $(this).attr('id') + '_' + uniqueId);
            });

            // Clear and update asset select
            const $assetSelect = $newField.find('.asset-select');
            $assetSelect.empty();
            $assetSelect.attr('id', 'asset_select_' + uniqueId);
            $assetSelect.removeData();
            $assetSelect.removeClass('select2-hidden-accessible');
            $assetSelect.find('option').remove();

            // Clear and update condition select
            const $conditionSelect = $newField.find('select[name="condition_id[]"]');
            $conditionSelect.attr('id', 'condition_' + uniqueId);
            $conditionSelect.val('');
            $conditionSelect.removeData();
            $conditionSelect.removeClass('select2-hidden-accessible');

            // Remove any existing select2 containers
            $newField.find('.select2-container').remove();

            return $newField;
        }



    });
</script>


<script>
    $(document).ready(function() {
        // Load initial data if in edit mode
        const outId = $('#out_id').val(); // Assuming you have a hidden input with out_id

        if (outId) {
            $.ajax({
                url: `/api/get-out-details/${outId}`,
                type: 'GET',
                success: function(response) {
                    // Clear existing fields except the first template
                    $('#assetFieldsContainer .asset-fields:not(:first)').remove();

                    // Loop through each detail record and create fields
                    response.forEach((detail, index) => {
                        let $assetField;

                        if (index === 0) {
                            // Use the existing first field
                            $assetField = $('.asset-fields').first();
                        } else {
                            // Create new fields for additional records
                            $assetField = createFreshAssetField();
                            $('#assetFieldsContainer').append($assetField);
                        }

                        // Populate the fields
                        populateAssetField($assetField, detail);
                    });

                    // Initialize Select2 for all fields
                    $('.asset-select').each(function() {
                        initializeAssetSelect2($(this));
                    });

                    $('select[name="condition_id[]"]').each(function() {
                        initializeConditionSelect2($(this));
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading details:', error);
                    alert('Failed to load asset details');
                }
            });
        }

        function populateAssetField($field, detail) {

            const $assetSelect = $field.find('.asset-select');
            const assetOption = new Option(detail.asset_model, detail.asset_id, true, true);
            $assetSelect.append(assetOption).trigger('change');

            $field.find('input[name="merk_display[]"]').val(detail.brand_name);
            $field.find('input[name="merk[]"]').val(detail.brand_id);
            $field.find('input[name="qty[]"]').val(detail.qty);
            $field.find('input[name="satuan_display[]"]').val(detail.uom_name);
            $field.find('input[name="satuan[]"]').val(detail.uom_id);
            $field.find('input[name="serial_number[]"]').val(detail.serial_number);
            $field.find('input[name="register_code[]"]').val(detail.register_code);

            const $imageContainer = $field.find('.container-image');

            // Clear existing images
            $imageContainer.find('img.img-thumbnail').remove();
            $imageContainer.find('input[name="existing_image[]"]').remove();

            // Check if image path exists and is valid
            if (detail.image && detail.image.trim() !== '') {
                // Construct full image URL
                const imageUrl = `/storage/app/public/${detail.image}`;

                // Check if the image is already present in the container
                const existingImage = $imageContainer.find(`img[src="${imageUrl}"]`);

                if (existingImage.length === 0) {
                    // Create image preview with error handling
                    const $imagePreview = $('<img>', {
                        src: imageUrl,
                        class: 'img-thumbnail mt-2',
                        style: 'max-width: 800px; max-height: 800px;',
                        alt: 'Asset Image'
                    });

                    // Add error handling for image loading
                    $imagePreview.on('error', function() {
                        console.warn('Failed to load image:', imageUrl);
                        $(this).replaceWith('<p class="text-danger">Image not found</p>');
                    });

                    // Create a hidden input to store the existing image path
                    const $hiddenImageInput = $('<input>', {
                        type: 'hidden',
                        name: 'existing_image[]',
                        value: detail.image
                    });

                    // Append preview and hidden input
                    $imageContainer.append($imagePreview);
                    $imageContainer.append($hiddenImageInput);
                } else {
                    console.log('Image already present for this asset field:', imageUrl);
                }
            } else {
                // Handle the case where there's no image
                const existingWarning = $imageContainer.find('p.text-warning');
                if (existingWarning.length === 0) {
                    $imageContainer.append('<p class="text-warning">No image available</p>');
                }
            }
            const $conditionSelect = $field.find('select[name="condition_id[]"]');

            // Check if the condition already exists in the dropdown
            let existingOption = $conditionSelect.find(`option[value="${detail.condition_id}"]`);

            if (!existingOption.length) {
                // Add the condition as an option if it doesn't exist
                const newOption = new Option(detail.condition_name, detail.condition_id, true, true);
                $conditionSelect.append(newOption).trigger('change');
            } else {
                // Select the existing condition
                $conditionSelect.val(detail.condition_id).trigger('change');
            }

        }


        // Handle add new asset field button
        $('.btn-add-asset').on('click', function() {
            const $newField = createFreshAssetField();
            $('#assetFieldsContainer').append($newField);

            // Initialize Select2 for new fields
            initializeAssetSelect2($newField.find('.asset-select'));
            initializeConditionSelect2($newField.find('select[name="condition_id[]"]'));
        });

        $(document).on('click', '.btn-remove-asset', function() {
            if ($('#assetFieldsContainer .asset-fields').length > 1) {
                const $field = $(this).closest('.asset-fields');
                // Destroy Select2 instances before removing
                $field.find('.select2-hidden-accessible').select2('destroy');
                $field.remove();
            } else {
                alert('At least one asset field must remain.');
            }
        });



    });
</script>


<script>
    $(document).ready(function() {


        $('.asset-select').each(function() {
            initializeAssetSelect2(this);
        });

        $('select[name="condition_id[]"]').each(function() {
            initializeConditionSelect2(this);
        });

        // Handle add new asset field
        $('.btn-add-asset').on('click', function() {
            const $newField = createFreshAssetField();
            $('#assetFieldsContainer').append($newField);

            // Initialize Select2 for new fields
            initializeAssetSelect2($newField.find('.asset-select'));
            initializeConditionSelect2($newField.find('select[name="condition_id[]"]'));

            // Move the add button to the new field
            $(this).appendTo($newField);
        });

        $(document).on('click', '.btn-remove-asset', function() {
            if ($('#assetFieldsContainer .asset-fields').length > 1) {
                const $field = $(this).closest('.asset-fields');
                // Destroy Select2 instances before removing
                $field.find('.select2-hidden-accessible').select2('destroy');
                $field.remove();
            } else {
                alert('At least one asset field must remain.');
            }
        });
    });

    function createFreshAssetField() {
        // Clone the template
        const $template = $('.asset-fields').first();
        const $newField = $template.clone();

        // Generate unique ID
        const uniqueId = 'asset_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);

        // Reset and update all form elements
        $newField.find('input').each(function() {
            $(this).val('');
            $(this).attr('id', $(this).attr('id') + '_' + uniqueId);
        });

        // Clear and update asset select
        const $assetSelect = $newField.find('.asset-select');
        $assetSelect.empty();
        $assetSelect.attr('id', 'asset_select_' + uniqueId);
        $assetSelect.removeData();
        $assetSelect.removeClass('select2-hidden-accessible');
        $assetSelect.find('option').remove();

        // Clear and update condition select
        const $conditionSelect = $newField.find('select[name="condition_id[]"]');
        $conditionSelect.attr('id', 'condition_' + uniqueId);
        $conditionSelect.val('');
        $conditionSelect.removeData();
        $conditionSelect.removeClass('select2-hidden-accessible');

        // Remove any existing select2 containers
        $newField.find('.select2-container').remove();

        return $newField;
    }

    function initializeAssetSelect2(element) {
        $(element).select2({
            placeholder: 'Pilih Asset',
            allowClear: true,
            width: '100%',
            ajax: {
                url: '/api/get-data-assets',
                type: 'GET',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text: item.asset_model
                            };
                        })
                    };
                },
                cache: true
            }
        }).on('select2:clear', function() {
            var $parent = $(this).closest('.asset-fields');
            $parent.find('input').val('');
        });
    }

    function initializeConditionSelect2(element) {
        $(element).select2({
            placeholder: 'Pilih Kondisi',
            allowClear: true,
            width: '100%'
        });
    }

    $('#dest_loc').select2({
        placeholder: 'Pilih Lokasi Tujuan', // Placeholder text
        allowClear: true, // Allow clearing the selection
        ajax: {
            url: '/api/get-dest-locations', // API endpoint to fetch locations
            type: 'GET', // HTTP method
            dataType: 'json', // Data format
            delay: 250, // Delay to prevent rapid requests
            data: function(params) {
                return {
                    search: params.term // Pass the search term to the backend
                };
            },
            processResults: function(data) {
                // Transform the response to Select2 format
                return {
                    results: $.map(data, function(item) {
                        return {
                            id: item.id, // Value to be sent to the server
                            text: item.name_store_street // Label shown to the user
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 0 // Require at least 1 character for search
    });
</script>

</html>
