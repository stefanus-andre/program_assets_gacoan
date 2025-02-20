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
      #coba {
        table-layout: fixed !important;
        word-wrap: break-word;
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
                  <?php $session = session(); ?>
                  <div class="flex-grow-1"><span>{{ Auth::user()->username }}</span>
                    <p class="mb-0 font-roboto">{{ Auth::user()->role}}<i class="middle fa fa-angle-down"></i></p>
                  </div>
              
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="user-profile.html"><i data-feather="user"></i><span>Account </span></a></li>
                  <!-- <li><a href="email_inbox.html"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li><a href="kanban.html"><i data-feather="file-text"></i><span>Taskboard</span></a></li> -->
                  <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      <i data-feather="log-out"></i><span>Log Out</span></a></li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </ul>
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
       @include('SM.layouts.right_sidebar_sm')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->

          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Product Asset List</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">ASMI</li>
                    <li class="breadcrumb-item active">Product Asset List</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>

          <!-- Container-fluid starts-->
          <div class="container-fluid list-products">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Product Asset List</h5><span>adalah daftar atau kumpulan aset yang dimiliki oleh seseorang, organisasi, atau perusahaan. Daftar ini biasanya mencakup rincian tentang setiap aset, seperti jenis aset, nilai, lokasi, dan informasi relevan lainnya.</span>
                  </div>
					<div class="card-body"> 
						<div class="btn-showcase">
              <div class="button_between">
              <a href="{{ route('laman_tambah_registrasi_asset') }}" class="btn btn-square btn-primary">Add Data Asset</a>
				        <button class="btn btn-square btn-primary" type="button" data-toggle="modal" data-target="#importDataExcel"> <i class="fa fa-file-excel-o" ></i> Import Data Excel </button>
                <a href="{{ url('/admin/registrasi_asset/export_data_asset') }}" class="btn btn-square btn-primary" role="button">
    <i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel Data
</a>

              </div>
						  </div>
						</div>


    <!-- Button trigger modal -->


            <!-- Modal add -->
    <!-- Modal Add Data Asset -->
<div class="modal fade" id="addDataAsset" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data Registrasi Asset</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addAssetForm" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6">
                <label for="register_code">Register Code : </label>
                <input type="text" name="register_code" id="register_code" class="form-control" placeholder="Masukkkan Kode Registrasi..." required>
              </div>
              <div class="col-sm-6">
                <label for="asset_name">Asset Name : </label>
                <!-- <input type="text" name="periodic_maintenance" id="periodic_maintenance" class="form-control" placeholder="Masukkan Periodic Maintenance" required> -->
                <select name="asset_name" id="asset_name" class="form-control">
                  <option value="" selected disabled> --- Pilih Asset Name ---</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="serial_number">Serial Number : </label>
                <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Masukkan Serial Number" required>
              </div>
              <div class="col-sm-6">
                <label for="type_asset">Type Asset : </label>
                <select name="type_asset" id="type_asset" class="form-control">
                  <option value="" selected disabled></option>
                  <!-- <option value="sparepart">Sparepart</option>
                  <option value="unit">Unit</option> -->
                </select>
              </div>
              <div class="col-sm-6">
                <label for="category_asset">Category Asset : </label>
                <!-- <input type="text" name="category_asset" id="category_asset" class="form-control" placeholder="Masukkan Category Asset" required> -->
                <select name="category_asset" id="category_asset" class="form-control">
                  <option value="" selected disabled> --- PILIH CATEGORY ASSET ---- </option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="prioritas">Prioritas : </label>
                <!-- <input type="text" name="prioritas" id="prioritas" class="form-control" placeholder="Masukkan Prioritas" required> -->
                <select name="prioritas" id="prioritas" class="form-control">
                  <option value="" selected disabled> --- PILIH PRIORITAS ---- </option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="merk">Merk : </label>
                <select name="merk" id="merk" class="form-control">
                  <option value="" selected disabled> --- Pilih Merk ---</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="qty">Quantity : </label>
                <input type="number" name="qty" id="qty" class="form-control" placeholder="Masukkan Quantity" required
                min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1" />
              </div>
              <div class="col-sm-6">
                <label for="satuan">Satuan : </label>
                <!-- <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Masukkan Satuan" required> -->
                <select name="satuan" id="satuan" class="form-control">
                  <option value="" selected disabled> --- PILIH SATUAN ---- </option>o
                </select>
              </div>
              <div class="col-sm-6">
                <label for="width">Width : </label>
                <input type="number" name="width" id="width" class="form-control" placeholder="Masukkan Width Barang" required
                min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1" />
              </div>
              <div class="col-sm-6">
                <label for="height">Height : </label>
                <input type="number" name="height" id="height" class="form-control" placeholder="Masukkan Height Barang" required
                min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1" />
              </div>
              <div class="col-sm-6">
                <label for="depth">Depth : </label>
                <input type="number" name="depth" id="depth" class="form-control" placeholder="Masukkan Depth Barang" required
                min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1" />
              </div>
              <div class="col-sm-6">
                  <label for="register_location">Register Location :</label>
                  <!-- <input type="text" name="register_location" id="register_location" class="form-control" placeholder="Masukkan Register Location" required> -->
                  <select name="register_location" id="register_location" class="form-control">
                    <option value=""> --- Pilih Register Location ---- </option>
                  </select>
              </div>
              <div class="col-sm-6">
                <label for="layout">Layout : </label>
                <!-- <input type="text" name="layout" id="layout" class="form-control" placeholder="Masukkan Layout" required> -->
                <select name="layout" id="layout" class="form-control">
                  <option value="" selected disabled> --- Pilih Layout ---</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="asset_model">Status : </label>
                <select name="status" id="status" class="form-control">
                  <option value=""></option>
                  <option value="PRIORITY">PRIORITY</option>
                  <option value="NOT PRIORITY">NOT PRIORITY</option>
                  <option value="BASIC">BASIC</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="register_date">Register Date : </label>
                <input type="date" name="register_date" id="register_date" class="form-control" placeholder="Masukkan Register Date" required>
              </div>
              <div class="col-sm-6">
                <label for="supplier">Supplier : </label>
                <!-- <input type="text" name="supplier" id="supplier" class="form-control" placeholder="Masukkan Supplier" required> -->
                <select name="supplier" id="supplier" class="form-control">
                  <option value="" selected disabled> --- Pilih Supplier ---</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="purchase_number">Purchase Number : </label>
                <input type="text" name="purchase_number" id="purchase_number" class="form-control" placeholder="Masukkan Purchase Number" required>
              </div>
              <div class="col-sm-6">
                <label for="purchase_date">Purchase Date : </label>
                <input type="date" name="purchase_date" id="purchase_date" class="form-control" placeholder="Masukkan Purchase Date" required>
              </div>
                <input type="hidden" name="approve_status" id="approve_status" class="form-control">
              <div class="col-sm-6">
                <label for="warranty">Warranty : </label>
                <select name="warranty" id="warranty" class="form-control">
                  <option value=""> --- PILIH WARRANTY ---- </option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="periodic_maintenance">Periodic Maintenace : </label>
                <!-- <input type="text" name="periodic_maintenance" id="periodic_maintenance" class="form-control" placeholder="Masukkan Periodic Maintenance" required> -->
                <select name="periodic_maintenance" id="periodic_maintenance" class="form-control">
                  <option value="" selected disabled> --- Pilih Periodic Maintenance ---</option>
                </select>
              </div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveAssetButton">Save changes</button>
      </div>
    </div>
  </div>
</div>

  <!-- Update Modal -->
<!-- Update Asset Modal -->
<div class="modal fade" id="editDataAsset" tabindex="-1" role="dialog" aria-labelledby="editDataAssetLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataAssetLabel">Update Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateAssetForm" >
                <div class="row">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="assetId" name="id">

                    <div class="col-sm-6">
              <label for="register_code">Register Code : </label>
              <input type="text" name="register_code" id="edit-register_code" class="form-control" placeholder="Masukkkan Kode Registrasi..." required>
            </div>

            <div class="col-sm-6">
              <label for="asset_name">Asset Name : </label>
              <!-- <input type="text" name="periodic_maintenance" id="periodic_maintenance" class="form-control" placeholder="Masukkan Periodic Maintenance" required> -->
              <select name="asset_name" id="edit-asset_name" class="form-control">
                <option value="" selected disabled> --- Pilih Asset Name ---</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="serial_number">Serial Number : </label>
              <input type="text" name="serial_number" id="edit-serial_number" class="form-control" placeholder="Masukkan Serial Number" required>
            </div>
            <div class="col-sm-6">
              <label for="type_asset">Type Asset : </label>
              <select name="type_asset" id="edit-type_asset" class="form-control">
                <option value="" selected disabled></option>
                <!-- <option value="sparepart">Sparepart</option>
                <option value="unit">Unit</option> -->
              </select>
            </div>
            <div class="col-sm-6">
              <label for="category_asset">Category Asset : </label>
              <!-- <input type="text" name="category_asset" id="category_asset" class="form-control" placeholder="Masukkan Category Asset" required> -->
              <select name="category_asset" id="edit-category_asset" class="form-control">
                <option value="" selected disabled> --- PILIH CATEGORY ASSET ---- </option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="prioritas">Prioritas : </label>
              <!-- <input type="text" name="prioritas" id="prioritas" class="form-control" placeholder="Masukkan Prioritas" required> -->
               <select name="prioritas" id="edit-prioritas" class="form-control">
                <option value="" selected disabled> --- PILIH PRIORITAS ---- </option>
               </select>
            </div>
            <div class="col-sm-6">
              <label for="merk">Merk : </label>
              <select name="merk" id="edit-merk" class="form-control">
                <option value="" selected disabled> --- Pilih Merk ---</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="qty">Quantity : </label>
              <input type="number" name="qty" id="edit-qty" class="form-control" placeholder="Masukkan Quantity" required
              min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1" />
            </div>
            <div class="col-sm-6">
              <label for="satuan">Satuan : </label>
              <!-- <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Masukkan Satuan" required> -->
               <select name="satuan" id="edit-satuan" class="form-control">
                <option value="" selected disabled> --- PILIH SATUAN ---- </option>o
               </select>
            </div>

            <div class="col-sm-6">
              <label for="satuan">Satuan : </label>
              <!-- <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Masukkan Satuan" required> -->
               <select name="satuan" id="edit-satuan" class="form-control">
                <option value="" selected disabled> --- PILIH SATUAN ---- </option>o
               </select>
            </div>

            </div>
            <div class="col-sm-6">
              <label for="edit-width">Width : </label>
              <input type="number" name="width" id="edit-width" class="form-control" placeholder="Masukkan Width Barang" required
              min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1" />
            </div>
            <div class="col-sm-6">
              <label for="edit-height">Height : </label>
              <input type="number" name="height" id="edit-height" class="form-control" placeholder="Masukkan Height Barang" required
              min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1" />
            </div>
            <div class="col-sm-6">
              <label for="edit-depth">Depth : </label>
              <input type="number" name="depth" id="edit-depth" class="form-control" placeholder="Masukkan Depth Barang" required
              min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="1" />
            </div>



          <div class="col-sm-6">
    <label for="register_location">Register Location:</label>
    <select name="register_location" id="edit-register_location" class="form-control">
      
    </select>
</div>

            <div class="col-sm-6">
              <label for="layout">Layout : </label>
              <!-- <input type="text" name="layout" id="layout" class="form-control" placeholder="Masukkan Layout" required> -->
              <select name="layout" id="edit-layout" class="form-control">
                <option value="" selected disabled> --- Pilih Layout ---</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="asset_model">Status : </label>
              <select name="status" id="edit-status" class="form-control">
                <option value=""></option>
                <option value="PRIORITY">PRIORITY</option>
                <option value="NOT PRIORITY">NOT PRIORITY</option>
                <option value="BASIC">BASIC</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="register_date">Register Date : </label>
              <input type="date" name="register_date" id="edit-register_date" class="form-control" placeholder="Masukkan Register Date" required>
            </div>
            <div class="col-sm-6">
              <label for="supplier">Supplier : </label>
              <!-- <input type="text" name="supplier" id="supplier" class="form-control" placeholder="Masukkan Supplier" required> -->
              <select name="supplier" id="edit-supplier" class="form-control">
                <option value="" selected disabled> --- Pilih Supplier ---</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="purchase_number">Purchase Number : </label>
              <input type="text" name="purchase_number" id="edit-purchase_number" class="form-control" placeholder="Masukkan Purchase Number" required>
            </div>
            <div class="col-sm-6">
              <label for="purchase_date">Purchase Date : </label>
              <input type="date" name="purchase_date" id="edit-purchase_date" class="form-control" placeholder="Masukkan Purchase Date" required>
            </div>
              <input type="hidden" name="approve_status" id="approve_status" class="form-control">
            <div class="col-sm-6">
              <label for="warranty">Warranty : </label>
              <select name="warranty" id="edit-warranty" class="form-control">
                <option value=""> --- PILIH WARRANTY ---- </option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="periodic_maintenance">Periodic Maintenace : </label>
              <!-- <input type="text" name="periodic_maintenance" id="periodic_maintenance" class="form-control" placeholder="Masukkan Periodic Maintenance" required> -->
              <select name="periodic_maintenance" id="edit-periodic_maintenance" class="form-control">
                <option value="" selected disabled> --- Pilih Periodic Maintenance ---</option>
              </select>
            </div>
              </div>
           
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="submitUpdate">Update Asset</button>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>


  <div class="modal fade" id="detailDataAsset" tabindex="-1" role="dialog" aria-labelledby="detailDataAssetLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailDataAssetLabel"><b>Detail Barang Asset</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="qrCodeImage" src="" alt="QR Code" style="width: 150px; height: 150px;">
                <p id="assetDetails"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="importDataExcel" tabindex="-1" role="dialog" aria-labelledby="importDataExcelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importDataExcelLabel">Import Data Excel Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="data_excel">Import Data Excel:</label>
                        <input type="file" name="file" class="form-control" placeholder="Upload File Excel" required accept=".xlsx,.xls">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
                </form>
                @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif


                        <div class="card">
                          <div class="card-body">
                            <div class="table-responsive product-table" style="border-radius: 8px; overflow-x: auto; scrollbar-width: thin;">
                              <table class="display" id="coba" style="min-width: 1200px; border-collapse: separate; border-radius: 8px; overflow: hidden;">
                                <thead>
                                  <tr>
                                    <th style="width: 10px;">Asset Tag</th>
                                    <th>Asset Name</th>
                                    <th>Serial Number</th>
                                    <th>Type Asset</th>
                                    <th>Category Asset</th>
                                    <th>Priority</th>
                                    <th>Merk</th>
                                    <th>Satuan</th>
                                    <th>Register Location</th>
                                    <th>Layout</th>
                                    <th>Register Date</th>
                                    <th>Supplier</th>
                                    <th>Condition</th>
                                    <th>Purchase Date</th>
                                    <th>Warranty</th>
                                    <th>Periodic Maintenance</th>
                                    <th>Data Registrasi Asset Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <!-- Table rows will be dynamically populated -->
                                </tbody>
                              </table>
                            </div>
   
                            </div>
                        </div>
                   </div>
                </div>
              <!-- Individual column searching (text inputs) Ends-->
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
         // Check if DataTable is already initialized and destroy it if necessary
if ($.fn.DataTable.isDataTable('#coba')) {
    $('#coba').DataTable().destroy();
    $('#coba').empty(); // Clear the table to prevent duplicate data
}

// Initialize DataTable
var table = $('#coba').DataTable({
    scrollX: true,
    "ajax": {
        "url": "/admin/registrasi_asset/get_data_registrasi_asset",
        "type": "GET",
        "dataSrc": ""
    },
    "columns": [
        {"data": "register_code"},
        {"data": "asset_model"},
        {"data": "serial_number"},
        {"data": "type_name"},
        {"data": "cat_name"},
        {
            "data": "priority_name",
            "render": function(data, type, row) {
                let color, bgColor;
                if (data === "PRIORITY") {
                    bgColor = 'red';
                    color = 'white';
                } else if (data === "NOT PRIORITY") {
                    bgColor = 'yellow';
                    color = 'black';
                } else if (data === "BASIC") {
                    bgColor = 'blue';
                    color = 'white';
                }
                return `<span style="display: inline-block; padding: 5px 10px; background-color: ${bgColor}; border-radius: 4px; color: ${color};">${data}</span>`;
            }
        },
        {"data": "brand_name"},
        {"data": "uom_name"},
        {"data": "name_store_street"},
        {"data": "layout_name"},
        {"data": "register_date"},
        {"data": "supplier_name"},
        {"data": "condition_name"},  
        {"data": "purchase_date"},
        {"data": "warranty_name"},
        {"data": "periodic_mtc_name"},
        {
            "data": "data_registrasi_asset_status",
            "render": function(data, type, row) {
                if (data === "active") {
                    return `<span style="color: green;">${data}</span>`;
                } else {
                    return `<span style="color: red;">${data}</span>`;
                }
            }
        },
        {
            "data": "null",
            "render": function(data, type, row) {
                let approveButton = '';
                if (row.approve_status !== 'sudah approve') {
                    approveButton = `<button class="dropdown-item approve-btn" data-id="${row.id}">Submit Approve</button>`;
                }

                return `
                <div class="dropdown">
                    <button class="btn btn-large btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton${row.id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row.id}">
                        <a class="dropdown-item" href="/generate-pdf/${row.register_code}" target="_blank">Cetak QR Code</a>
                        <a class="dropdown-item" href="/admin/registrasi_asset/detail_data_registrasi_asset/${row.id}" target="_blank">Detail Barang Asset</a>
                        <a class="dropdown-item" href="/admin/registrasi_asset/update/${row.id}">Update</a>
                        <button class="dropdown-item delete-btn" data-id="${row.id}">Delete</button>
                        ${approveButton}
                    </div>
                </div>
                <br>
                `;
            }
        }
    ]
});
      </script>

      <script>

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
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
      </script>

    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>