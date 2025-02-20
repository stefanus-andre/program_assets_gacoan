<!DOCTYPE html>
<html lang="en">
  <head>
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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
      .btn-link {
          color: #007bff;
          text-decoration: none;
      }

      .btn-link:hover {
          text-decoration: underline;
      }

      .disabled {
          color: #6c757d; /* Grey color for disabled links */
          cursor: not-allowed; /* Change cursor for disabled links */
      }

      .mt-4 {
          margin-top: 1.5rem; /* Margin adjustment for spacing */
      }

      .mt-2 {
          margin-top: 0.5rem; /* Margin adjustment for spacing */
      }

      .pagination-container {
          display: flex;
          justify-content: space-between;
          align-items: center;
      }

      .pagination-info {
          text-align: center;
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
                  <li><a href="/logout"><i data-feather="log-out"> </i><span>Log Out</span></a></li>
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
       @include('AM.layouts.right_sidebar_am')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->

          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Disposal Out Name List</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">ASMI</li>
                    <li class="breadcrumb-item active">Disposal Out Name List</li>
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
                    <h5>Disposal Out Name List</h5>
                    <span>adalah daftar atau kumpulan aset yang dimiliki oleh seseorang, organisasi, atau perusahaan. Daftar ini biasanya mencakup rincian tentang setiap aset, seperti jenis aset, nilai, lokasi, dan informasi relevan lainnya.</span>
                  </div>
					<div class="card-body"> 
						<div class="btn-showcase">
                            <div class="button_between">
                            <a href="{{ url('/am/add_data_disposal_out') }}" class="btn btn-square btn-primary">+ Add Data Disposal Out</a>
                                {{-- <button class="btn btn-square btn-primary" type="button" data-toggle="modal" data-target="#importDataExcel"> <i class="fa fa-file-excel-o" ></i> Import Data Excel </button>
                                <button class="btn btn-square btn-primary" type="button"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                Download PDF Data</button> --}}
                            </div>
						  </div>
						</div>


                    <!-- Button trigger modal -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Modal add -->
                    <!-- Modal Add Data Asset -->
                    <div class="modal fade" id="addDataMoveOut" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add Data Disposal Out</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form id="addMoveOutForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                  <!-- Tanggal, Lokasi, dan Deskripsi -->
                                  <div class="col-sm-12">
                                    <label for="out_date">Tanggal Disposal Out:</label>
                                    <input type="date" name="out_date" id="out_date" class="form-control" required>
                                  </div>
                                  <div class="col-sm-12">
                                    <label for="from_loc">Lokasi Asal:</label>
                                    <input type="text" name="from_loc" id="from_loc" class="form-control" required>
                                  </div>
                                  <div class="col-sm-12">
                                    <label for="dest_loc">Lokasi Tujuan:</label>
                                    <input type="text" name="dest_loc" id="dest_loc" class="form-control" required>
                                  </div>
                                  <div class="col-sm-12">
                                    <label for="out_desc">Deskripsi Disposal Out:</label>
                                    <input type="text" name="out_desc" id="out_desc" class="form-control" required>
                                  </div>
                                  <div class="col-sm-12">
                                    <label for="reason_id">Alasan Disposal Out:</label>
                                    <select name="reason_id" id="reason_id" class="form-control" required>
                                      <option value="">Pilih Alasan</option>
                                      @foreach($reasons as $reason)
                                        <option value="{{ $reason->reason_id }}">{{ $reason->reason_name }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="col-sm-12">
                                    <label for="images">Upload Images:</label>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                                </div>
                      
                                  <!-- Container untuk data asset -->
                                  <div id="assetFieldsContainer">
                                    <!-- Field Asset Pertama -->
                                    <div class="asset-fields">
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <label for="asset_id">Data Asset:</label>
                                          <select name="asset_id[]" class="form-control asset-select" required>
                                            <option value="">Pilih Asset</option>
                                            @foreach($assets as $asset)
                                              <option value="{{ $asset->id }}">{{ $asset->asset_name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="col-sm-12">
                                          <label for="merk">Merk:</label>
                                          <input type="text" name="merk[]" class="form-control" readonly>
                                        </div>
                                        <div class="col-sm-12">
                                          <label for="qty">Quantity:</label>
                                          <input type="text" name="qty[]" class="form-control" readonly>
                                        </div>
                                        <div class="col-sm-12">
                                          <label for="satuan">Satuan:</label>
                                          <input type="text" name="satuan[]" class="form-control" readonly>
                                        </div>
                                        <div class="col-sm-12">
                                          <label for="serial_number">Serial Number:</label>
                                          <input type="text" name="serial_number[]" class="form-control" readonly>
                                        </div>
                                        <div class="col-sm-12">
                                          <label for="register_code">Register Code:</label>
                                          <input type="text" name="register_code[]" class="form-control" readonly>
                                        </div>
                                        <div class="col-sm-12">
                                          <label for="condition_id">Kondisi Asset:</label>
                                          <select name="condition_id[]" class="form-control" required>
                                            <option value="">Pilih Kondisi</option>
                                            @foreach($conditions as $condition)
                                              <option value="{{ $condition->condition_id }}">{{ $condition->condition_name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <!-- Tombol untuk menambah atau menghapus field -->
                                      <button type="button" class="btn btn-success btn-add-asset mt-2">+</button>
                                      <button type="button" class="btn btn-danger btn-remove-asset mt-2">-</button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary" id="saveMoveOutButton">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      

                            <!-- Update Modal -->
                            <div id="updateModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Update Disposal Out</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <form id="updateForm">
                                          @csrf
                                          @method('PUT') <!-- Method override untuk PUT -->
                                          <div class="modal-body">
                                              <div class="row">
                                                  <div class="col-sm-12">
                                                      <label for="out_date">Tanggal Disposal Out: </label>
                                                      <input type="date" name="out_date" id="out_date" class="form-control" placeholder="Enter Tanggal Disposal Out" required>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="from_loc">Lokasi Asal: </label>
                                                      <input type="text" name="from_loc" id="from_loc" class="form-control" placeholder="Enter Lokasi Asal" required>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="dest_loc">Lokasi Tujuan: </label>
                                                      <input type="text" name="dest_loc" id="dest_loc" class="form-control" placeholder="Enter Lokasi Tujuan" required>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="out_desc">Deskripsi Disposal Out: </label>
                                                      <input type="text" name="out_desc" id="out_desc" class="form-control" placeholder="Enter Deskripsi Disposal Out" required>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="reason_id">Alasan Disposal Out: </label>
                                                      <select name="reason_id" id="reason_id" class="form-control" required>
                                                          <option value="">Pilih Alasan</option>
                                                          @foreach($reasons as $reason)
                                                              <option value="{{ $reason->reason_id }}">{{ $reason->reason_name }}</option>
                                                          @endforeach
                                                      </select>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="asset_id">Data Asset: </label>
                                                      <select name="asset_id" id="asset_id" class="form-control" required>
                                                          <option value="">Pilih Asset</option>
                                                          @foreach($assets as $asset)
                                                              <option value="{{ $asset->id }}">{{ $asset->asset_name }}</option>
                                                          @endforeach
                                                      </select>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="merk">Merk: </label>
                                                      <input type="text" name="merk" id="merk" class="form-control" readonly>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="qty">Quantity: </label>
                                                      <input type="text" name="qty" id="qty" class="form-control" readonly>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="satuan">Satuan: </label>
                                                      <input type="text" name="satuan" id="satuan" class="form-control" readonly>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="serial_number">Serial Number: </label>
                                                      <input type="text" name="serial_number" id="serial_number" class="form-control" readonly>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="register_code">Register Code: </label>
                                                      <input type="text" name="register_code" id="register_code" class="form-control" readonly>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="condition_id">Kondisi Asset: </label>
                                                      <select name="condition_id" id="condition_id" class="form-control" required>
                                                          <option value="">Pilih Kondisi</option>
                                                          @foreach($conditions as $condition)
                                                              <option value="{{ $condition->condition_id }}">{{ $condition->condition_name }}</option>
                                                          @endforeach
                                                      </select>
                                                  </div>
                                                  <input type="hidden" name="out_id" id="out_id">
                                              </div>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>

                          <div class="modal fade" id="MoveOutDetailModal" tabindex="-1" role="dialog" aria-labelledby="brandModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="brandModalLabel">Detail Disposal Out</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                      <p><strong>ID:</strong> <span id="moveout-id"></span></p>
                                      <p><strong>No Disposal Out:</strong> <span id="moveout-no"></span></p>
                                      <p><strong>Tanggal:</strong> <span id="out-date"></span></p>
                                      <p><strong>Lokasi Asal:</strong> <span id="from-loc"></span></p>
                                      <p><strong>Lokasi Tujuan:</strong> <span id="dest-loc"></span></p>
                                      <p><strong>ID Movement In:</strong> <span id="in-id"></span></p>
                                      <p><strong>Deskripsi:</strong> <span id="out-desc"></span></p>
                                      <p><strong>ID Asset:</strong> <span id="asset-id"></span></p>
                                      <p><strong>Nama Asset:</strong> <span id="asset-name"></span></p>
                                      <p><strong>Tag Asset:</strong> <span id="asset-tag"></span></p>
                                      <p><strong>Serial Number:</strong> <span id="serial-number"></span></p>
                                      <p><strong>Brand:</strong> <span id="asset-brand"></span></p>
                                      <p><strong>Quantity:</strong> <span id="asset-qty"></span></p>
                                      <p><strong>Satuan:</strong> <span id="asset-uom"></span></p>
                                      <p><strong>Condition:</strong> <span id="asset-cond"></span></p>
                                      <p><strong>Gambar:</strong> <span id="asset-img"></span></p>
                                      <!-- You can add more brand details here -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                                <form action="" method="post" enctype="multipart/form-data">
                                    <label for="import-data">Import Data Excel : </label>
                                    <input type="file" name="data_excel" id="data_excel" class="form-control" placeholder="Upload File Excel">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    


                    <div class="card-body">
                      <div class="table-responsive product-table" style="max-width: 100%; overflow-x: auto;">
                        <div class="d-flex justify-content-between mb-3 mt-3">
                            <h5>Disposal Out Data</h5> <!-- Add a heading for the table if needed -->
                            <!-- Search Input Field aligned to the right -->
                        </div>
                        <form action="{{ route('admin.filterdisout') }}" method="POST">
                              @csrf
                              <div class="row">
                                  <div class="col-md-4">
                                      <label for="start_date">Start Date</label>
                                      <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                                  </div>
                                  <div class="col-md-4">
                                      <label for="end_date">End Date</label>
                                      <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                                  </div>
                                  <div class="col-md-4 d-flex align-items-end">
                                      <button type="submit" class="btn btn-primary">Filter</button>
                                      <a href="{{ route('Admin.disout') }}" class="btn btn-secondary ml-2">Reset</a>
                                  </div>
                              </div>
                          </form>
                          <div class="d-flex justify-content-between mb-3 mt-3">
                            <h5></h5> <!-- Add a heading for the table if needed -->
                            <!-- Search Input Field aligned to the right -->
                            <div class="input-group" style="width: 250px;">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search for assets..." />
                            </div>
                        </div>
                        
                        <table class="table table-striped display" id="coba" style="width: 100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>ID Disposal Out</th>
                                    <th>Tanggal Disposal Out</th>
                                    <th>Lokasi Asal</th>
                                    <th>Quantity</th>
                                    <th>Satuan</th>
                                    <th>Merk</th>
                                    <th>Deskripsi</th>
                                    <th>Alasan</th>
                                    <th>Status Disposal</th>
                                    <th>Approval Tahap 1</th>
                                    <th>Approval Tahap 2</th>
                                    <th>Approval Tahap 3</th>
                                    <th>Data Disposal Out Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                              @php $no = 1; @endphp
                                @foreach($moveouts as $moveout) 
                                @if($moveout->from_loc == auth()->user()->location_now)
                                    <tr class="text-center">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $moveout->out_id }}</td>
                                        <td>{{ $moveout->out_date }}</td>
                                        <td>{{ $moveout->name_store_street }}</td>
                                        <td>{{ $moveout->uom_name }}</td>
                                        <td>{{ $moveout->brand_name }}</td>
                                        <td>{{ $moveout->out_desc }}</td>
                                        <td>{{ $moveout->reason_name }}</td>
                                        <td>{{ $moveout->approval_name }}</td>
                                        <td>
                                                    {{ 
                                                        $moveout->appr_1 == 2 ? "Approved" : 
                                                        ($moveout->appr_1 == 4 ? "Rejected" : "Belum Approved") 
                                                    }}
                                                </td>
                                                <td>
                                                    {{ 
                                                        $moveout->appr_2 == 2 ? "Approved" : 
                                                        ($moveout->appr_2 == 4 ? "Rejected" : "Belum Approved") 
                                                    }}
                                                </td>
                                                <td>
                                                    {{ 
                                                        $moveout->appr_3 == 2 ? "Approved" : 
                                                        ($moveout->appr_3 == 4 ? "Rejected" : "Belum Approved") 
                                                    }}
                                                </td>
                                        <td>
                                        @if($moveout->deleted_at)
                                                          Nonactive
                                                      @else
                                                          Active
                                                      @endif
                                        </td>
                                        <td class="text-center">
                                            @if($moveout->appr_1 != 2)
                                            <a href="{{ url('/admin/edit_data_disposal_out', $moveout->out_id) }}"
                                            data-id="{{ $moveout->out_id }}" 
                                            title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form class="delete-form" action="{{ url('admin/disouts/delete', $moveout->out_id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              @method('DELETE')
                                              <button type="button" class="delete-button" title="Delete" style="border: none; background: none; cursor: pointer;" onclick="confirmDelete(event, this)">
                                                  <i class="fas fa-trash-alt" style="color: red;"></i>
                                              </button>
                                          </form>
                                          @endif
                                          <a href="{{ url('/admin/get_detail_data_disposal_out/' . $moveout->out_id) }}" title="Detail">
                                                <i class="fas fa-book"></i>
                                            </a>
                                          <a href="{{ route('admin.disoutPDF', $moveout->out_id) }}" target="_blank"><i class="fas fa-print mx-1"></i></a></a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                          <div>
                              <!-- Previous Button -->
                              @if ($moveouts->onFirstPage())
                                  <span class="disabled"><< Previous</span>
                              @else
                                  <a href="{{ $moveouts->previousPageUrl() }}" class="btn btn-link"><< Previous</a>
                              @endif
                          </div>
                          <div>
                              <!-- Next Button -->
                              @if ($moveouts->hasMorePages())
                                  <a href="{{ $moveouts->nextPageUrl() }}" class="btn btn-link">Next >></a>
                              @else
                                  <span class="disabled">Next >></span>
                              @endif
                          </div>
                        </div>
                      
                        <!-- Display current page and total pages -->
                        <div class="d-flex justify-content-center mt-2">
                            <span>Page {{ $moveouts->currentPage() }} of {{ $moveouts->lastPage() }}</span>
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
    <!-- latest jquery-->
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
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
    <script src="{{asset('assets/js/data-asset.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

    {{-- Get Data moveout --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  

    {{-- Add Data moveout --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
        
          

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            $('#saveMoveOutButton').click(function (e) {
                e.preventDefault();

                // Ambil data form
                var moveoutData = {
        out_date: $('#out_date').val(),
        from_loc: $('#from_loc').val(),
        dest_loc: $('#dest_loc').val(),
        out_desc: $('#out_desc').val(),
        reason_id: $('#reason_id').val(),
        // Gather asset data as arrays
        asset_id: [],
        register_code: [],
        serial_number: [],
        merk: [],
        qty: [],
        satuan: [],
        condition_id: []
    };

    // Loop through each asset field
    $('.asset-select').each(function(index) {
        moveoutData.asset_id.push($(this).val());
    });
    $('input[name^="register_code"]').each(function(index) {
        moveoutData.register_code.push($(this).val());
    });
    $('input[name^="serial_number"]').each(function(index) {
        moveoutData.serial_number.push($(this).val());
    });
    $('input[name^="merk"]').each(function(index) {
        moveoutData.merk.push($(this).val());
    });
    $('input[name^="qty"]').each(function(index) {
        moveoutData.qty.push($(this).val());
    });
    $('input[name^="satuan"]').each(function(index) {
        moveoutData.satuan.push($(this).val());
    });
    $('select[name^="condition_id"]').each(function(index) {
        moveoutData.condition_id.push($(this).val());
    });

    // Send the gathered data
    $.ajax({
        url: '/add-moveout', // Update this to your correct URL
        method: 'POST',
        data: moveoutData,
        success: function(response) {
            console.log(response);
            if (response.status === 'success') {
                $('#addDataMoveOut').modal('hide');
                window.location.href = response.redirect_url;
            } else {
                alert(response.message);
            }
        },
        error: function(jqXHR) {
            const message = jqXHR.responseJSON?.message || 'Failed to update moveout.';
            alert(message);
        }
    });
});
        });
    </script>

    {{-- Update Data moveout --}}
    <script>
      $(document).on('click', '.edit-button', function() {
    const outId = $(this).data('id');

    // Make an AJAX call to fetch the moveout data
    $.ajax({
        url: `/moveout/${outId}`,
        method: 'GET',
        success: function(data) {
            // Populate the modal fields with the fetched data
            $('#out_id').val(data.out_id);
            $('#out_date').val(data.out_date);
            $('#from_loc').val(data.from_loc);
            $('#dest_loc').val(data.dest_loc);
            $('#out_desc').val(data.out_desc);
            $('#reason_id').val(data.reason_id);
            $('#asset_id').val(data.asset_id).change(); // Trigger change to fetch asset details
            $('#merk').val(data.merk);
            $('#qty').val(data.qty);
            $('#satuan').val(data.satuan);
            $('#serial_number').val(data.serial_number);
            $('#register_code').val(data.register_code);
            $('#condition_id').val(data.condition_id);

            // Show the modal
            $('#updateModal').modal('show');
        },
        error: function(xhr) {
            alert('Error fetching moveout data: ' + xhr.responseJSON.message);
        }
    });
});

$('#asset_id').on('change', function() {
    const assetId = $(this).val();

    if (assetId) {
        fetch(`/get-asset-details/${assetId}`)
            .then(response => response.json())
            .then(data => {
                $('#merk').val(data.merk || '');
                $('#qty').val(data.qty || '');
                $('#satuan').val(data.satuan || '');
                $('#serial_number').val(data.serial_number || '');
                $('#register_code').val(data.register_code || '');
            })
            .catch(error => console.error('Error fetching asset details:', error));
    } else {
        $('#merk').val('');
        $('#qty').val('');
        $('#satuan').val('');
        $('#serial_number').val('');
        $('#register_code').val('');
    }
});

// Mengirim permintaan edit melalui Ajax
$('#updateForm').on('submit', function(e) {
    e.preventDefault(); // Cegah form reload halaman

    $.ajax({
        url: '/admin/moveouts/edit/' + $('#out_id').val(),
        method: 'PUT', // Menggunakan PUT untuk memperbarui data
        data: $(this).serialize(), // Serialisasi data form untuk dikirim
        success: function(response) {
            if (response.status === 'success') {
                window.location.href = '/admin/disout' // Redirect ke halaman yang sudah diatur
            }
        },
        error: function(jqXHR) {
            const message = jqXHR.responseJSON?.message || 'Failed to update moveout.';
            alert(message); // Tampilkan pesan error jika gagal
        }
    });
});
  </script>
    
    {{-- Detail --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.detail-button', function() {
        var outId = $(this).data('id');

        // AJAX request to fetch data from the server
        $.ajax({
            url: '/fetch-moveout-details/' + outId, // Adjust URL as needed
            method: 'GET',
            success: function(response) {
                // Assuming response is a JSON object containing the necessary data
                $('#moveout-id').text(response.out_id);
                $('#moveout-no').text(response.out_no);
                $('#out-date').text(response.out_date);
                $('#from-loc').text(response.from_loc);
                $('#dest-loc').text(response.dest_loc);
                $('#in-id').text(response.in_id);
                $('#out-desc').text(response.out_desc);
                $('#asset-id').text(response.asset_id);
                $('#asset-name').text(response.asset_name);
                $('#asset-tag').text(response.asset_tag);
                $('#serial-number').text(response.serial_number);
                $('#asset-brand').text(response.brand);
                $('#asset-qty').text(response.qty);
                $('#asset-uom').text(response.uom);
                $('#asset-cond').text(response.condition);
                $('#asset-img').text(response.image); // Change this to an <img> tag if needed

                // Show the modal
                $('#MoveOutDetailModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching move out details:', error);
                alert('Unable to fetch details. Please try again.');
            }
        });
    });
</script>
    
    {{-- Delete data moveout --}}
    <script>
        $(document).on('click', '.delete-button', function(e) {
            e.preventDefault(); // Prevent default form submission
            const form = $(this).closest('form'); // Get the closest form to the button
    
            // Display confirmation dialog
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak, simpan'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Get the action URL from the form
                    const actionUrl = form.attr('action');
                    
                    // Perform AJAX DELETE request
                    $.ajax({
                        url: actionUrl, // Form action URL
                        method: 'DELETE', // HTTP method
                        data: form.serialize(), // Serialize form data
                        success: function(response) {
                            if (response.status === 'success') {
                                window.location.href = response.redirect_url; // Redirect on success
                            } else {
                                Swal.fire('Error!', response.message, 'error'); // Show error message
                            }
                        },
                        error: function(jqXHR) {
                            Swal.fire('Gagal!', 'Gagal menghapus data. Coba lagi.', 'error'); // Error message
                        }
                    });
                }
            });
        });
    </script>
    
    <script>
      // JavaScript for searching/filtering the table rows
      document.getElementById('searchInput').addEventListener('keyup', function() {
          var input, filter, table, tr, td, i, j, txtValue;
          input = document.getElementById('searchInput');
          filter = input.value.toLowerCase();
          table = document.getElementById('coba');
          tr = table.getElementsByTagName('tr');
          
          // Loop through all table rows, and hide those who don't match the search query
          for (i = 1; i < tr.length; i++) { // Start from 1 to skip table header
              tr[i].style.display = "none"; // Hide the row initially
              
              // Loop through all columns in the row
              for (j = 0; j < tr[i].getElementsByTagName('td').length; j++) {
                  td = tr[i].getElementsByTagName('td')[j];
                  if (td) {
                      txtValue = td.textContent || td.innerText;
                      if (txtValue.toLowerCase().indexOf(filter) > -1) {
                          tr[i].style.display = ""; // Show the row if match is found
                          break; // Exit loop once a match is found
                      }
                  }
              }
          }
      });
  </script>
  
  <script>
    $(document).ready(function() {
        // This will handle all modals that have a button with the data-dismiss attribute
        $('[data-dismiss="modal"]').on('click', function() {
            $('.modal').modal('hide');  // Hide any open modal
        });
    });
  </script>

<script>
  document.getElementById('asset_id').addEventListener('change', function () {
      const assetId = this.value;
  
      if (assetId) {
          fetch(`/get-asset-details/${assetId}`)
              .then(response => response.json())
              .then(data => {
                  document.getElementById('merk').value = data.merk || '';
                  document.getElementById('qty').value = data.qty || '';
                  document.getElementById('satuan').value = data.satuan || '';
                  document.getElementById('serial_number').value = data.serial_number || '';
                  document.getElementById('register_code').value = data.register_code || '';
              })
              .catch(error => console.error('Error fetching asset details:', error));
      } else {
          document.getElementById('merk').value = '';
          document.getElementById('qty').value = '';
          document.getElementById('satuan').value = '';
          document.getElementById('serial_number').value = '';
          document.getElementById('register_code').value = '';
      }
  });
  </script>
  <script>
    $(document).ready(function() {
      // Menambahkan field baru
      $('.btn-add-asset').click(function() {
        var assetFields = $(this).closest('.asset-fields').clone(); // Clone field
        assetFields.find('input').val(''); // Reset nilai input
        assetFields.find('select').val(''); // Reset nilai select
        $('#assetFieldsContainer').append(assetFields); // Tambahkan field yang baru
      });
  
      // Menghapus field aset
      $('#assetFieldsContainer').on('click', '.btn-remove-asset', function() {
        if ($('.asset-fields').length > 1) {
          $(this).closest('.asset-fields').remove();
        }
      });
    });
  </script>
  
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>