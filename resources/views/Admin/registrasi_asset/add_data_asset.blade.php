<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Enzo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Enzo admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href=" {{asset('assets/images/favicon/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon/favicon.png')}}" type="image/x-icon">
    <title>ASMI - Asset System Management Integration</title>
    
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/font-awesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset( 'assets/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/prism.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

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
        .form-group > div {
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
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search In Enzo .." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
              <a href="index.html">
                <img class="img-fluid" src="{{asset('assets/images/logo/login.png')}}" alt="">
              </a>
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
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
                    <div class="d-flex"><img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/user/1.jpg')}}">
                      <div class="status-circle online"></div>
                      <div class="flex-grow-1"><a href="chat.html"> <span>Ain Chavez</span>
                          <p>Do you want to go see movie?</p></a></div>
                      <p class="f-12 font-success">1 mins ago</p>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex"><img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/user/2.png')}}">
                      <div class="status-circle online"></div>
                      <div class="flex-grow-1"><a href="chat.html"> <span>Kori Thomas</span>
                          <p>What`s the project report update?</p></a></div>
                      <p class="f-12 font-success">3 mins ago</p>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex"><img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/dashboard/admins.png')}}">
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
              <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <li class="profile-nav onhover-dropdown p-0 me-0">
                <div class="d-flex profile-media"><img class="b-r-50" src="{{asset('assets/images/dashboard/profile.jpg')}}">
              
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="user-profile.html"><i data-feather="user"></i><span>Account </span></a></li>
                  <!-- <li><a href="email_inbox.html"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li><a href="kanban.html"><i data-feather="file-text"></i><span>Taskboard</span></a></li> -->
                  <>
                  <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                    @csrf
                    <li>
    <button id="logoutBtn"><i data-feather="log-out"> </i><span>Log Out</span></button>
</li>
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
            <br>
          <div class="card">
  <!-- Card Header -->
  <div class="card-header">
    <h3><b>Add Data Registrasi Asset</b></h3>
  </div>

  <!-- Card Body -->
  <div class="card-body">
    <div class="container-fluid">
      <div class="section">
        <div class="form-group">
          <form action="{{ url('/tambah_data_registrasi_asset') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-sm-6 mb-3">
                <label for="register_code">Asset Tag : </label>
                <input type="text" name="register_code" id="register_code" class="form-control" placeholder="Masukkan Kode Registrasi..." readonly>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="asset_name">Asset Name : </label>
                <select name="asset_name" id="asset_name" class="form-control">
                  <option value="" selected disabled> --- Pilih Asset Name ---</option>
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="serial_number">Serial Number : </label>
                <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Masukkan Serial Number" required>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="type_asset">Type Asset : </label>
                <select name="type_asset" id="type_asset" class="form-control">
                  <option value="" selected disabled></option>
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="category_asset">Category Asset : </label>
                <select name="category_asset" id="category_asset" class="form-control">
                  <option value="" selected disabled> --- PILIH CATEGORY ASSET ---- </option>
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="prioritas">Priority : </label>
                <select name="prioritas" id="prioritas" class="form-control">
                  <option value="" selected disabled> --- PILIH PRIORITAS ---- </option>
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="merk">Merk : </label>
                <select name="merk" id="merk" class="form-control">
                  <option value="" selected disabled> --- Pilih Merk ---</option>
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="qty">Quantity : </label>
                <input type="number" name="qty" id="qty" class="form-control" placeholder="Masukkan Quantity" required min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1">
              </div>
              <div class="col-sm-6 mb-3">
                <label for="satuan">Satuan : </label>
                <select name="satuan" id="satuan" class="form-control">
                  <option value="" selected disabled> --- PILIH SATUAN ---- </option>
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="width">Width : </label>
                <input type="number" name="width" id="width" class="form-control" placeholder="Masukkan Width Barang" required min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1">
              </div>
              <div class="col-sm-6 mb-3">
                <label for="height">Height : </label>
                <input type="number" name="height" id="height" class="form-control" placeholder="Masukkan Height Barang" required min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1">
              </div>
              <div class="col-sm-6 mb-3">
                <label for="depth">Depth : </label>
                <input type="number" name="depth" id="depth" class="form-control" placeholder="Masukkan Depth Barang" required min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1">
              </div>
              <div class="col-sm-6 mb-3">
                <label for="register_location">Register Location :</label>
                <select name="register_location" id="register_location" class="form-control">
                  <option value=""> --- Pilih Register Location ---- </option>
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="layout">Layout : </label>
                <select name="layout" id="layout" class="form-control">
                  <option value="" selected disabled> --- Pilih Layout ---</option>
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="asset_model">Condition : </label>
                <select name="condition" id="condition" class="form-control">
                  <option value="" selected disabled> --- Pilih Condition Barang ---</option>
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="register_date">Register Date : </label>
                <input type="date" name="register_date" id="register_date" class="form-control" placeholder="Masukkan Register Date" required>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="supplier">Supplier : </label>
                <select name="supplier" id="supplier" class="form-control">
                  <option value="" selected disabled> --- Pilih Supplier ---</option>
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="purchase_number">Purchase Number : </label>
                <input type="text" name="purchase_number" id="purchase_number" class="form-control" placeholder="Masukkan Purchase Number" required>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="purchase_date">Purchase Date : </label>
                <input type="date" name="purchase_date" id="purchase_date" class="form-control" placeholder="Masukkan Purchase Date" required>
              </div>
              <input type="hidden" name="approve_status" id="approve_status" class="form-control">
              <div class="col-sm-6 mb-3">
                <label for="warranty">Warranty : </label>
                <select name="warranty" id="warranty" class="form-control">
                  <option value=""> --- PILIH WARRANTY ---- </option>
                </select>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="periodic_maintenance">Periodic Maintenance : </label>
                <select name="periodic_maintenance" id="periodic_maintenance" class="form-control">
                  <option value="" selected disabled> --- Pilih Periodic Maintenance ---</option>
                </select>
              </div>
              <div class="col-sm-12 text-right mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
              </div>
            </div>
          </form>
        </div>
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

  <!-- Correct order: jQuery first, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
=<!-- Popper.js next (use the CDN) -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

<!-- Bootstrap JS (use the CDN or your local version) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>



    <script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- scrollbar js-->
    <script src="{{asset('assets/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{asset('assets/js/scrollbar/custom.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
    <script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
    <script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
    <script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
    <script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
    <script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
    <script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
    <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
    <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/js/dashboard/default.js')}}"></script>
    <script src="{{asset('assets/js/slick-slider/slick.min.js')}}"></script>
    <script src="{{asset('assets/js/slick-slider/slick-theme.js')}}"></script>
    <script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
    <script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
    <script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
    <script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/data-registrasi-asset.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});



  $('#downloadExcel').on('click', function(){
    window.open('/admin/download_asset_excel', '_blank');
  });

  $('#downloadPDF').on('click', function(){
    window.open('/admin/download_asset_pdf', '_blank');
  });

    function generateRandomCode(length) {
        return Math.floor(Math.pow(10, length-1) + Math.random() * 9 * Math.pow(10, length - 1));
      }
  
      function generateAssetCode() {
        const date = new Date();
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        const randomCode = generateRandomCode(4);
  
        const assetCode = `RG-${day}-${month}-${year}-${randomCode}`;
        return assetCode;
      }
  
      function newSetAssetCode() {
        document.getElementById('register_code').value =generateAssetCode();
      }
  
      newSetAssetCode();

     
  
  // Handle "Submit Approve" button click
  $(document).on('click', '.approve-btn', function() {
      var assetId = $(this).data('id');
      
      // Confirm approval action
      if (confirm("Are you sure you want to approve this asset?")) {
          $.ajax({
              url: '/admin/registrasi_asset/approve',  // Adjust this to your actual endpoint
              type: 'POST',
              data: {
                  id: assetId,
                  approve_status: 'sudah approve'
              },
              success: function(response) {
                  if (response.status === 'success') {
                      alert('Asset approved successfully!');
                      table.ajax.reload();  // Reload the DataTable to reflect the changes
                  } else {
                      alert('Failed to approve the asset.');
                  }
              },
              error: function() {
                  alert('An error occurred while approving the asset.');
              }
          });
      }
  });


    $(document).ready(function() {
      function restrictNonNumericInput(selector) {
        $(selector).on('input', function() {
          var value = $(this).val();
          // Allow only digits and remove non-numeric characters
          value = value.replace(/[^0-9]/g, '');
          $(this).val(value);
        });
      }
    
      restrictNonNumericInput('#add_asset_quantity');
      restrictNonNumericInput('#update_asset_quantity');
    
      $('#saveAssetButton').click(function(e) {
        e.preventDefault(); // Prevent the form from submitting the traditional way
    
        // Perform form validation before showing SweetAlert
        var isValid = true;
    
        // Validate Asset Code
      //   if ($('#asset_code').val() === '') {
      //     isValid = false;
      //     $('#asset_code').addClass('is-invalid'); // Highlight the input
      //   } else {
      //     $('#asset_code').removeClass('is-invalid');
      //   }
    
      //   // Validate Asset Model
      //   if ($('#asset_model').val() === '') {
      //     isValid = false;
      //     $('#asset_model').addClass('is-invalid');
      //   } else {
      //     $('#asset_model').removeClass('is-invalid');
      //   }
    
      //   // Validate Asset Status
      //   if ($('#asset_status').val() === '') {
      //     isValid = false;
      //     $('#asset_status').addClass('is-invalid');
      //   } else {
      //     $('#asset_status').removeClass('is-invalid');
      //   }
    
      //   var assetQuantity = $('#add_asset_quantity').val();
      //   if (assetQuantity === '' || assetQuantity <= 0) {
      //     isValid = false;
      //     $('#add_asset_quantity').addClass('is-invalid');
      //   } else {
      //     $('#add_asset_quantity').removeClass('is-invalid');
      //   }
    
        // If the form is valid, show the SweetAlert confirmation
        if (isValid) {
          // SweetAlert confirmation
          Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to save this asset?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, save it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              // If confirmed, submit the form via AJAX
              var formData = new FormData($('#addAssetForm')[0]); // Create FormData object
    
              $.ajax({
                url: '/admin/registrasi_asset/tambah_data_registrasi_asset', // Adjust your URL accordingly
                type: 'POST',
                data: formData,
                contentType: false,  // Prevent jQuery from setting content-type header
                processData: false,  // Prevent jQuery from processing the data
                success: function(response) {
                  // Show success message
                  Swal.fire(
                    'Tersimpan',
                    'Data Asset Sudah Tersimpan.',
                    'success'
                  ).then(() => {
                    // Hide the modal after SweetAlert success confirmation
                    $('#addDataAsset').modal('hide');
                  });
                  $('#addAssetForm')[0].reset(); // Clear the form
                  $('#coba').DataTable().ajax.reload(); // Reload the DataTable
                },
                error: function(xhr, status, error) {
                  // Show error message
                  Swal.fire(
                    'Error!',
                    'Failed to add the asset: ' + error,
                    'error'
                  );
                }
              });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              Swal.fire(
                'Cancelled',
                'Batal isi data asset',
                'error'
              );
            }
          });
        } else {
          // If form is not valid, show error message
          Swal.fire(
            'Error!',
            'Isi Semua Form Tersebut',
            'error'
          );
        }
      });
    });
    
    $(document).on('click', '.update-btn', function() {
      var assetId = $(this).data('id'); // Get the ID of the asset from the button
  
      // Make an AJAX request to fetch the asset details
      $.ajax({
          url: `/admin/registrasi_asset/get_detail/${assetId}`, // Define the route to get the asset details
          method: 'GET',
          success: function(data) {
              // Populate the modal fields with the fetched data
              $('#edit-register_code').val(data.register_code);
              $('#edit-asset_name').val(data.asset_name).get();
              $('#edit-serial_number').val(data.serial_number);
              $('#edit-type_asset').val(data.type_asset).get();
              $('#edit-category_asset').val(data.category_asset).get();
              $('#edit-prioritas').val(data.prioritas).get();
              $('#edit-merk').val(data.merk).get();
              $('#edit-qty').val(data.qty).get();
              $('#edit-satuan').val(data.satuan).get();
              $('#edit-width').val(data.width);
              $('#edit-height').val(data.width);
              $('#edit-depth').val(data.width);

              $('#edit-register_location').val(data.register_location).trigger('change');
              $('#edit-layout').val(data.layout).get();
              $('#edit-register_date').val(data.register_date);
              $('#edit-supplier').val(data.supplier).get();
              $('#edit-status').val(data.status).get();
              $('#edit-purchase_number').val(data.purchase_number);
              $('#edit-purchase_date').val(data.purchase_date);
              $('#edit-warranty').val(data.warranty).get();
              $('#edit-region').val(data.region).get();

              $('#edit-periodic_maintenance').val(data.periodic_maintenance).get();
              $('#submitUpdate').attr('data_id', assetId);
              // Show the modal
              $('#editDataAsset').modal('show');
          },
          error: function(xhr, status, error) {
              console.log(error);
          }
      });
  });
  
  
  
  $('#updateAssetForm').on('submit', function(e) {
      e.preventDefault();
  
      const assetId = $('#submitUpdate').attr('data_id');
      console.log(assetId)
      if (!assetId) {
          alert("Asset ID is missing!");
          return;
      }
  
      $.ajax({
          url: `/admin/registrasi_asset/update_data_registrasi_asset/${assetId}`,
          method: 'PUT',
          data: $(this).serialize(),
          success: function(response) {
              alert(response.message);
              $('#editDataAsset').modal('hide');
              table.ajax.reload();
          },
          error: function(xhr) {
              const errors = xhr.responseJSON.errors;
              let errorMessage = 'Please fix the following errors:<ul>';
              $.each(errors, function(key, value) {
                  errorMessage += `<li>${value[0]}</li>`;
              });
              errorMessage += '</ul>';
              alert(errorMessage);
          }
      });
  });
  

    //get detail data
    // $('#coba').on('click', '.update-btn', function() {
    //   var assetId = $(this).data('id');

    //   $.ajax({
    //       url: `/admin/registrasi_asset/get_detail_data_asset/${assetId}`,
    //       type: "GET",
    //       success: function(data) {
    //         $('#updateForm [name="register_code"]').val(data.register_code);
    //         $('#updateForm [name="asset_name"]').val(data.asset_name);
    //         $('#updateForm [name="serial_number"]').val(data.serial_number);
    //         $('#updateForm [name="type_asset"]').val(data.type_asset).change();
    //         $('#updateForm [name="category_asset"]').val(data.category_asset);
    //         $('#updateForm [name="prioritas"]').val(data.prioritas);
    //         $('#updateForm [name="merk"]').val(data.merk);
    //         $('#updateForm [name="qty"]').val(data.qty);
    //         $('#updateForm [name="satuan"]').val(data.satuan);
    //         $('#updateForm [name="register_location"]').val(data.register_location);
    //         $('#updateForm [name="layout"]').val(data.layout);
    //         $('#updateForm [name="status"]').val(data.status).change();
    //         $('#updateForm [name="register_date"]').val(data.register_date);
    //         $('#updateForm [name="supplier"]').val(data.supplier);
    //         $('#updateForm [name="purchase_number"]').val(data.purchase_number);
    //         $('#updateForm [name="purchase_date"]').val(data.purchase_date);
    //         $('#updateForm [name="warranty"]').val(data.warranty);
    //         $('#updateForm [name="periodic_maintenance"]').val(data.periodic_maintenance);
    //         $('#updateModal').modal('show');
    //       }
    //   });
    // });




$('#updateForm').on('submit', function(e) {
e.preventDefault();

// Ensure you get the asset ID correctly
const assetId = $('#assetId').val(); // Get the ID from the hidden input

// Log the ID for debugging
console.log("Asset ID:", assetId);

// Log form data for debugging
console.log("Form Data:", $(this).serialize());

// Make sure the assetId is defined before making the request
if (!assetId) {
    console.error("Asset ID is undefined!");
    Swal.fire('Error', 'Asset ID is not set.', 'error');
    return; // Prevent the AJAX call
}

$.ajax({
    url: '/admin/registrasi_asset/update_data_registrasi_asset/' + assetId, // Include ID in the URL
    type: "PUT", // Change to PUT
    data: $(this).serialize(),
    success: function(response) {
        Swal.fire('Updated!', 'Data Berhasil Terupdate', 'success');
        table.ajax.reload(); // Reload your DataTable if needed
        $('#updateModal').modal('hide'); // Hide modal
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText); // Log error response
        Swal.fire('Error', 'Ada kesalahan ketika update data asset', 'error');
    }
});
});

  
  

    // delete data
$('#coba').on('click', '.delete-btn', function(){
        var assetId = $(this).data('id');
        console.log("Asset ID:", assetId);

        if (!assetId) {
            Swal.fire(
                'Error!',
                'Asset ID is not defined.',
                'error'
            );
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/registrasi_asset/delete_data_registrasi_asset/${assetId}`,
                    type: 'DELETE',
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your asset has been deleted.',
                            'success'
                        );
                    
                        table.ajax.reload(); 
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'There was an error deleting the asset.',
                            'error'
                        );
                    }
                });
            }
        });
    });


    $(document).on('click', '.detail-btn', function() {
        var assetId = $(this).data('id');
    
        // Fetch the row data from the DataTable
        var rowData = table.row($(this).closest('tr')).data();
    
        // Populate the modal with the QR code path and other details
        $('#qrCodeImage').attr('src', rowData.qr_code_path ? rowData.qr_code_path : '');

        var priorityBgColor;
        if (rowData.prioritas === 'HIGH') {
            priorityBgColor = 'red';
        } else if (rowData.prioritas === 'MEDIUM') {
            priorityBgColor = 'yellow';
        } else if (rowData.prioritas === 'LOW') {
            priorityBgColor = 'blue';
        }

        $('#assetDetails').html(
            'Register Code: ' + rowData.register_code + '<br>' +
            'Asset Name : ' + rowData.asset_name + '<br>' +
            'Serial Number : ' + rowData.serial_number + '<br>' +
            'Type Asset : ' + rowData.type_asset     + '<br>' +
            'Category Asset : ' + rowData.category_asset + '<br>' +
            'Prioritas : ' + rowData.prioritas + '<br>' +
            'Merk : ' + rowData.merk + '<br>' +
            'Quantity : ' + rowData.qty + '<br>' +
            'Width : ' + rowData.width + '<br>' +
            'Height: ' + rowData.height + '<br>' +
            'Register Location : ' + rowData.register_location + '<br>' +
            'Layout : ' + rowData.layout + '<br>' +
            'Condition : ' + rowData.condition + '<br>' +
            'Register Date : ' + rowData.register_date + '<br>' +
            'Supplier : ' + rowData.supplier + '<br>' +
            'Purchase Number : ' + rowData.purchase_number + '<br>' +
            'Warranty : ' + rowData.warranty + '<br>' +
            'Periodic Maintenance : ' + rowData.periodic_maintenance + '<br>' +
            'Model: ' + rowData.asset_name + '<br>' +
            '<span style="display: inline-block; padding: 5px 10px; background-color: ' + priorityBgColor + '; color: ' + (priorityBgColor === 'yellow' ? 'black' : 'white') + '; border-radius: 4px;">' + rowData.prioritas + '</span>'
        );
    
        // Change modal color based on the status
        var modalHeader = $('#detailDataAsset .modal-header');
        modalHeader.removeClass('bg-danger bg-warning bg-success'); // Remove any previous color classes
    
        if (rowData.prioritas === 'HIGH') {
            modalHeader.addClass('bg-danger'); // Red for PRIORITY
        } else if (rowData.prioritas === 'MEDIUM') {
            modalHeader.addClass('bg-warning'); // Yellow for NOT PRIORITY
        } else if (rowData.prioritas === 'LOW') {
            modalHeader.addClass('bg-primary'); // Blue for BASIC
        }
  
        // Show the modal
        $('#detailDataAsset').modal('show');
      
    });    
});

$(document).ready(function() {
  $('#logoutBtn').on('click', function(e) {
      e.preventDefault();

      if (confirm('Are you sure you want to log out?')) {
          $.ajax({
              url: $('#logout-form').attr('action'), // Use the form action URL
              type: 'POST', // Use POST method
              data: $('#logout-form').serialize(), // Serialize the form data
              success: function(response) {
                  window.location.href = '/login'; // Redirect to login page on success
              },
              error: function(xhr, status, error) {
                  console.error(error); // Log any errors
                  alert('Logout failed. Please try again.'); // Notify user of failure
              }
          });
      }
  });
});


$(document).ready(function() {
  // Initialize Select2 with AJAX search
  $('#region').select2({
      placeholder: '--- Pilih Region ---',
      ajax: {
          url: '/admin/get-region', // Route to fetch regions
          dataType: 'json',
          delay: 250, // Delay to avoid overloading the server
          data: function(params) {
              return {
                  search: params.term || '', // Send the search term if available, otherwise an empty string
              };
          },
          processResults: function(data) {
              console.log(data);
              return {
                  results: $.map(data, function(region) {
                      return {
                          id:  region.region_name,  
                          text: region.region_name
                      };
                  })
              };
          },
          cache: true
      },
      minimumInputLength: 0
  });
});


$(document).ready(function() {
  // Initialize Select2 with AJAX search
  $('#merk').select2({
      placeholder: '--- Pilih Brand ---',
      ajax: {
          url: '/admin/get-brand', // Route to fetch regions
          dataType: 'json',
          delay: 250, // Delay to avoid overloading the server
          data: function(params) {
              return {
                  search: params.term || '', // Send the search term if available, otherwise an empty string
              };
          },
          processResults: function(data) {
              console.log(data);
              return {
                  results: $.map(data, function(brand) {
                      return {
                          id:  brand.brand_id,  
                          text: brand.brand_name
                      };
                  })
              };
          },
          cache: true
      },
      minimumInputLength: 0
  });
});


$(document).ready(function() {
  // Initialize Select2 with AJAX search
  $('#asset_name').select2({
      placeholder: '--- Pilih Nama Asset ---',
      ajax: {
          url: '/get-regist', // Route to fetch regions
          dataType: 'json',
          delay: 250, // Delay to avoid overloading the server
          data: function(params) {
              return {
                  search: params.term || '', // Send the search term if available, otherwise an empty string
              };
          },
          processResults: function(data) {
              console.log(data);
              return {
                  results: $.map(data, function(asset) {
                      return {
                          id:  asset.asset_id,  
                          text: asset.asset_model
                      };
                  })
              };
          },
          cache: true
      },
      minimumInputLength: 0
  });
});


$(document).ready(function() {
  // Initialize Select2 with AJAX search
  $('#supplier').select2({
      placeholder: '--- Pilih Supplier ---',
      ajax: {
          url: '/admin/get-supplier', // Route to fetch regions
          dataType: 'json',
          delay: 250, // Delay to avoid overloading the server
          data: function(params) {
              return {
                  search: params.term || '', // Send the search term if available, otherwise an empty string
              };
          },
          processResults: function(data) {
              console.log(data);
              return {
                  results: $.map(data, function(supplier) {
                      return {
                          id:  supplier.supplier_code,  
                          text: supplier.supplier_name
                      };
                  })
              };
          },
          cache: true
      },
      minimumInputLength: 0
  });
});




      // $(document).ready(function(){
      //     // Fetch regions and populate the dropdown
      //     $.ajax({
      //         url: '/admin/get-brand', // Route to fetch regions
      //         method: 'GET',
      //         success: function(data) {
      //             var regionSelect = $('#merk');
      //             $.each(data, function(index, merk) {
      //                 regionSelect.append($('<option>', {
      //                     value: merk.brand_name, // Assuming 'id' is the unique identifier for the region
      //                     text: merk.brand_name // Assuming 'name' is the display name of the region
      //                 }));
      //             });
      //         }
      //     });
      // });



      // $(document).ready(function(){
      //     // Fetch regions and populate the dropdown
      //     $.ajax({
      //         url: '/admin/get-supplier', // Route to fetch regions
      //         method: 'GET',
      //         success: function(data) {
      //             var regionSelect = $('#supplier');
      //             $.each(data, function(index, supplier) {
      //                 regionSelect.append($('<option>', {
      //                     value: supplier.supplier_name, // Assuming 'id' is the unique identifier for the region
      //                     text: supplier.supplier_name // Assuming 'name' is the display name of the region
      //                 }));
      //             });
      //         }
      //     });
      // });




      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/admin/get-warranty', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#warranty');
                  $.each(data, function(index, warranty) {
                      regionSelect.append($('<option>', {
                          value: warranty.warranty_id, // Assuming 'id' is the unique identifier for the region
                          text: warranty.warranty_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });




      $(document).ready(function() {
        $.ajax({
            url: '/admin/get-regist-ajax',
            method: 'GET',
            success: function(data) {
                var assetName = $('#edit-asset_name');
                assetName.empty(); // Clear existing options
                
                // Add a blank option if needed
                assetName.append($('<option>', {
                    value: '',
                    text: '-- Select Asset Name --'
                }));
                
                $.each(data, function(index, asset) {
                    var option = $('<option>', {
                        value: asset.asset_id,  // Use name as value
                        text: asset.asset_model
                    });
                    
                    // If this is the currently selected value, mark it as selected
                    if (asset.asset_model === assetName.data('current')) {
                        option.prop('selected', true);
                    }
                    
                    assetName.append(option);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching periodic maintenance data:', error);
            }
        });
    });
  




// Fetch the existing asset data and set it in Select2 before editing
function loadExistingAssetData(assetId) {
  $.ajax({
      url: '/get-regist', // URL for fetching existing asset data
      type: 'GET',
      dataType: 'json',
      data: {
          asset_id: assetId // Pass the asset ID if needed
      },
      success: function(data) {
          if (data && data.asset_model) {
              // Create a new option with the existing data
              var newOption = new Option(data.asset_model, data.asset_model, true, true);
              $('#edit-asset_name').append(newOption).trigger('change');
          } else {
              console.warn('No asset data found');
          }
      },
      error: function(xhr, status, error) {
          console.error('Error fetching data:', error);
      }
  });
}

// Example: Call the function to pre-fill the Select2 input when the form loads
loadExistingAssetData(123);


      // $(document).ready(function(){
      //     $.ajax({
      //         url: '/get-regist',  // Ensure this matches your actual route for getAssets
      //         method: 'GET',
      //         success: function(response) {
      //             if (response.status === 'success') {
      //                 var regionSelect = $('#asset_name');
      //                 regionSelect.empty(); // Clear existing options
                      
      //                 // Loop through the assets and append them to the dropdown
      //                 $.each(response.data, function(index, asset) {
      //                     regionSelect.append($('<option>', {
      //                         value: asset.asset_model, // Assuming 'asset_id' is a field in MasterAsset
      //                         text: asset.asset_model // Assuming 'asset_model' is a field in MasterAsset
      //                     }));
      //                 });
      //             } else {
      //                 alert('Failed to fetch assets');
      //             }
      //         },
      //         error: function() {
      //             alert('An error occurred while fetching assets');
      //         }
      //     });
      // });

      

      $(document).ready(function() {
        // Fetch data and populate the dropdown
        $.ajax({
            url: '/admin/get-periodic', // Route to fetch data
            method: 'GET',
            success: function(data) {
                var regionSelect = $('#periodic_maintenance');
                $.each(data, function(index, periodic) {
                    regionSelect.append($('<option>', {
                        value: periodic.periodic_mtc_id, // Set value to id for submission
                        text: periodic.periodic_mtc_name // Display name in the dropdown
                    }));
                });
            }
        });
    });
    


      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/get-layout', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#layout');
                  $.each(data, function(index, layout) {
                      regionSelect.append($('<option>', {
                          value: layout.layout_code, // Assuming 'id' is the unique identifier for the region
                          text:  layout.layout_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });

      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/get-category', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#category_asset');
                  $.each(data, function(index, category) {
                      regionSelect.append($('<option>', {
                          value:  category.cat_code , // Assuming 'id' is the unique identifier for the region
                          text:  category.cat_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });


      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/get-priority', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#prioritas');
                  $.each(data, function(index, prioritas) {
                      regionSelect.append($('<option>', {
                          value:  prioritas.priority_code, // Assuming 'id' is the unique identifier for the region
                          text: prioritas.priority_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });



      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/get-type', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#type_asset');
                  $.each(data, function(index, type) {
                      regionSelect.append($('<option>', {
                          value: type.type_code, // Assuming 'id' is the unique identifier for the region
                          text:  type.type_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });



      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/get-uom', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#satuan');
                  $.each(data, function(index, uom) {
                      regionSelect.append($('<option>', {
                          value: uom.uom_id, // Assuming 'id' is the unique identifier for the region
                          text: uom.uom_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });




      $(document).ready(function() {
          // Initialize Select2 with AJAX search
          $('#register_location').select2({
              placeholder: '--- Pilih Register Location ---',
              ajax: {
                  url: '/admin/get-resto', // Route to fetch regions
                  dataType: 'json',
                  delay: 250, // Delay to avoid overloading the server
                  data: function(params) {
                      return {
                          search: params.term || '', // Send the search term if available, otherwise an empty string
                      };
                  },
                  processResults: function(data) {
                      console.log(data);
                      return {
                          results: $.map(data, function(resto) {
                              return {
                                  id:  resto.id ,  
                                  text: resto.name_store_street  
                              };
                          })
                      };
                  },
                  cache: true
              },
              minimumInputLength: 0
          });
      });
      
      

  //edit javascript


      // $(document).ready(function(){
      //     $.ajax({
      //         url: '/get-regist',  // Ensure this matches your actual route for getAssets
      //         method: 'GET',
      //         success: function(response) {
      //             if (response.status === 'success') {
      //                 var regionSelect = $('#edit-asset_name');
      //                 regionSelect.empty(); // Clear existing options
                      
      //                 // Loop through the assets and append them to the dropdown
      //                 $.each(response.data, function(index, asset) {
      //                     regionSelect.append($('<option>', {
      //                         value: asset.asset_model, // Assuming 'asset_id' is a field in MasterAsset
      //                         text: asset.asset_model // Assuming 'asset_model' is a field in MasterAsset
      //                     }));
      //                 });
      //             } else {
      //                 alert('Failed to fetch assets');
      //             }
      //         },
      //         error: function() {
      //             alert('An error occurred while fetching assets');
      //         }
      //     });
      // });



      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/get-type', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#edit-type_asset');
                  $.each(data, function(index, type) {
                      regionSelect.append($('<option>', {
                          value: type.type_code, // Assuming 'id' is the unique identifier for the region
                          text: type.type_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });


      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/get-category', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#edit-category_asset');
                  $.each(data, function(index, category) {
                      regionSelect.append($('<option>', {
                          value: category.cat_code, // Assuming 'id' is the unique identifier for the region
                          text: category.cat_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });


      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/get-priority', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#edit-prioritas');
                  $.each(data, function(index, prioritas) {
                      regionSelect.append($('<option>', {
                          value: prioritas.priority_code, // Assuming 'id' is the unique identifier for the region
                          text:  prioritas.priority_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });


      
      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/admin/get-brand', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#edit-merk');
                  $.each(data, function(index, merk) {
                      regionSelect.append($('<option>', {
                          value: merk.brand_id, // Assuming 'id' is the unique identifier for the region
                          text: merk.brand_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });


      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/get-uom', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#edit-satuan');
                  $.each(data, function(index, uom) {
                      regionSelect.append($('<option>', {
                          value: uom.uom_id, // Assuming 'id' is the unique identifier for the region
                          text: uom.uom_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });

      
 
      $(document).ready(function(){
          // Fetch regions and populate the dropdown
          $.ajax({
              url: '/admin/get-region', // Route to fetch regions
              method: 'GET',
              success: function(data) {
                  var regionSelect = $('#edit-region');
                  $.each(data, function(index, region) {
                      regionSelect.append($('<option>', {
                          value: region.region_id, // Assuming 'id' is the unique identifier for the region
                          text: region.region_name // Assuming 'name' is the display name of the region
                      }));
                  });
              }
          });
      });
      
      $(document).ready(function() {
          // Initialize Select2 with AJAX search
          $('#edit-register_location').select2({
              placeholder: '--- Pilih Register Location ---',
              ajax: {
                  url: '/admin/get-resto', // Route to fetch data
                  dataType: 'json',
                  delay: 250, // Delay to avoid overloading the server
                  data: function(params) {
                      return {
                          search: params.term || '' // Send the search term if available
                      };
                  },
                  processResults: function(data) {
                      console.log('Data fetched:', data); // Debugging line to inspect fetched data
                      return {
                          results: $.map(data, function(resto) {
                              return {
                                  id:resto.id , // Set the ID for value
                                  text: resto.name_store_street  // Display text
                              };
                          })
                      };
                  },
                  cache: true
              },
              minimumInputLength: 0
          });
      
          // Event listener to capture selected item data
          $('#edit-register_location').on('select2:select', function(e) {
              var selectedData = e.params.data; // Get the full selected data
              console.log('Selected Data:', selectedData); // Log the data to the console
      
              // Update the placeholder to show only 'kode_resto'
              var newPlaceholder = selectedData.id; // Set the new placeholder to the 'kode_resto' only
      
              // Change the Select2 placeholder dynamically by updating the displayed text
              var select2Element = $('#edit-register_location').data('select2').$container.find('.select2-selection__rendered');
              select2Element.text(newPlaceholder).removeClass('select2-selection__placeholder');
          });
      });
      
      
      
      
      
  
  $(document).ready(function(){
      // Fetch regions and populate the dropdown
      $.ajax({
          url: '/get-layout', // Route to fetch regions
          method: 'GET',
          success: function(data) {
              var regionSelect = $('#edit-layout');
              $.each(data, function(index, layout) {
                  regionSelect.append($('<option>', {
                      value:  layout.layout_code, // Assuming 'id' is the unique identifier for the region
                      text:  layout.layout_name // Assuming 'name' is the display name of the region
                  }));
              });
          }
      });
  });



  $(document).ready(function(){
      // Fetch regions and populate the dropdown
      $.ajax({
          url: '/admin/get-supplier', // Route to fetch regions
          method: 'GET',
          success: function(data) {
              var regionSelect = $('#edit-supplier');
              $.each(data, function(index, supplier) {
                  regionSelect.append($('<option>', {
                      value: supplier.supplier_code, // Assuming 'id' is the unique identifier for the region
                      text: supplier.supplier_name // Assuming 'name' is the display name of the region
                  }));
              });
          }
      });
  });

  
  $(document).ready(function(){
      // Fetch regions and populate the dropdown
      $.ajax({
          url: '/admin/get-warranty', // Route to fetch regions
          method: 'GET',
          success: function(data) {
              var regionSelect = $('#edit-warranty');
              $.each(data, function(index, warranty) {
                  regionSelect.append($('<option>', {
                      value: warranty.warranty_id, // Assuming 'id' is the unique identifier for the region
                      text: warranty.warranty_name // Assuming 'name' is the display name of the region
                  }));
              });
          }
      });
  });


//   $(document).ready(function() {
//     // Fetch data and populate the dropdown
//     $.ajax({
//         url: '/admin/get-periodic', // Route to fetch data
//         method: 'GET',
//         success: function(data) {
//             var regionSelect = $('#edit-periodic_maintenance');
//             $.each(data, function(index, periodic) {
//                 regionSelect.append($('<option>', {
//                     value: periodic.periodic_mtc_id, // Set value to id for submission
//                     text: periodic.periodic_mtc_name // Display name in the dropdown
//                 }));
//             });
//         }
//     });
// });




  $(document).ready(function() {
    $.ajax({
        url: '/admin/get-periodic-ajax',
        method: 'GET',
        success: function(data) {
            var periodicSelect = $('#edit-periodic_maintenance');
            periodicSelect.empty(); // Clear existing options
            
            // Add a blank option if needed
            periodicSelect.append($('<option>', {
                value: '',
                text: '-- Select Periodic Maintenance --'
            }));
            
            $.each(data, function(index, periodic) {
                var option = $('<option>', {
                    value: periodic.periodic_mtc_id,  // Use name as value
                    text: periodic.periodic_mtc_name
                });
                
                // If this is the currently selected value, mark it as selected
                if (periodic.periodic_mtc_name === periodicSelect.data('current')) {
                    option.prop('selected', true);
                }
                
                periodicSelect.append(option);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching periodic maintenance data:', error);
        }
    });
});


//get condition
$(document).ready(function(){
    // Fetch regions and populate the dropdown
    $.ajax({
        url: '/admin/get-condition', // Route to fetch regions
        method: 'GET',
        success: function(data) {
            var regionSelect = $('#condition');
            $.each(data, function(index, condition) {
                regionSelect.append($('<option>', {
                    value: condition.condition_id, // Assuming 'id' is the unique identifier for the region
                    text: condition.condition_name // Assuming 'name' is the display name of the region
                }));
            });
        }
    });
});


//get update condition
$(document).ready(function(){
    // Fetch regions and populate the dropdown
    $.ajax({
        url: '/admin/get-condition', // Route to fetch regions
        method: 'GET',
        success: function(data) {
            var regionSelect = $('#edit-condition');
            $.each(data, function(index, condition) {
                regionSelect.append($('<option>', {
                    value: condition.condition_id, // Assuming 'id' is the unique identifier for the region
                    text: condition.condition_name // Assuming 'name' is the display name of the region
                }));
            });
        }
    });
});






  // $(document).ready(function() {
  //     // Initialize Select2 with AJAX search
  //     $('#edit-register_location').select2({
  //         placeholder: '--- Pilih Register Location ---',
  //         ajax: {
  //             url: '/admin/get-resto', // Route to fetch regions
  //             dataType: 'json',
  //             delay: 250, // Delay to avoid overloading the server
  //             data: function(params) {
  //                 return {
  //                     search: params.term || '', // Send the search term if available, otherwise an empty string
  //                 };
  //             },
  //             processResults: function(data) {
  //                 return {
  //                     results: $.map(data, function(resto) {
  //                         return {
  //                             id: resto.kode_resto + ' - ' + resto.resto + ' - ' + resto.kom_resto, // Unique ID combining fields
  //                             text: resto.kode_resto + ' - ' + resto.resto + ' - ' + resto.kom_resto // Display text combining fields
  //                         };
  //                     })
  //                 };
  //             },
  //             cache: true
  //         },
  //         minimumInputLength: 0
  //     });
  
  //     // Assuming `data` is a JavaScript object that contains `register_location`
  //     var data = {
  //         register_location: 'some_value' // Replace with the actual value you want to set
  //     };
  
  //     // Set the value of the select2 element and trigger change for visual update
  //     $('#edit-register_location').val(data.register_location).trigger('change');
  
  //     // Get the value of the select2 element
  //     var selectedValue = $('#edit-register_location').val();
  //     console.log('Selected value:', selectedValue);
  // });
    </script>

    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>