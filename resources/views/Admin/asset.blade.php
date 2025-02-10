<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Enzo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, Enzo admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="pixelstrap">
  <link rel="icon" href="{{ asset('assets/images/favicon/favicon.png')}}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.png')}}" type="image/x-icon">
  <title>ASMI - Asset System Management Integration</title>
  <!-- Google font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/font-awesome.css')}}">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css')}}">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css')}}">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css')}}">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css')}}">
  <!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css')}}">
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css')}}">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
  <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css')}}" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css')}}">
  <!-- Add these in your <head> section -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
       @include('Admin.layouts.right_sidebar_admin')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->

          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Asset Name List</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">ASMI</li>
                    <li class="breadcrumb-item active">Asset Name List</li>
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
                            <h5>Asset Name List</h5>
                            <span>Adalah daftar atau kumpulan aset yang dimiliki oleh seseorang, organisasi, atau perusahaan. Daftar ini biasanya mencakup rincian tentang setiap aset, seperti jenis aset, nilai, lokasi, dan informasi relevan lainnya.</span>
                        </div>
        
                        <div class="card-body">
                            <div class="btn-showcase">
                                <div class="button_between">
                                    <button class="btn btn-square btn-primary" type="button" data-toggle="modal" data-target="#addDataAsset">+ Add Data Asset</button>
                                 
                                    <button class="btn btn-square btn-primary" type="button" data-toggle="modal" data-target="#importDataExcel"> 
                                        <i class="fa fa-file-excel-o"></i> Import Data Excel 
                                    </button>
                                    <a href="{{ url('/admin/regist/export-master-asset') }}" class="btn btn-square btn-primary" role="button">
    <i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel Data
</a>
                                  
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
                            <div class="modal fade" id="addDataAsset" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Data Asset</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addAssetForm" enctype="multipart/form-data">  
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12">
                                                <label for="asset_code">Asset Code : </label>
                                                <input type="text" name="asset_code" id="asset_code" class="form-control" placeholder="Enter Asset Code" required>
                                                </div>
                                                <div class="col-sm-12">
                                                <label for="asset_model">Asset Model : </label>
                                                <input type="text" name="asset_model" id="asset_model" class="form-control" placeholder="Enter Asset Model" required>
                                                </div>
                                                <!-- <div class="col-sm-12">
                                                <label for="asset_status">Asset Status : </label>
                                                <input type="text" name="asset_status" id="asset_status" class="form-control" placeholder="Enter Asset Status" required>
                                                </div>
                                                <div class="col-sm-12">
                                                <label for="asset_quantity">Asset Quantity : </label>
                                                <input type="text" name="asset_quantity" id="asset_quantity" class="form-control" placeholder="Enter Asset Quantity" required>
                                                </div> -->
                                                <div class="col-sm-12">
                                                    <label for="asset_image">Asset Image: </label>
                                                    <input type="file" name="asset_image" id="asset_image" class="form-control" required accept="image/*">
                                                </div>
                                                <div class="col-sm-12">
                                                  <label for="priority_id">Prioritas: </label>
                                                  <select name="priority_id" id="priority_id" class="form-control" required>
                                                    <option value="">Pilih Prioritas</option>
                                                    @foreach($priorities as $priority)
                                                        <option value="{{ $priority->priority_id }}">{{ $priority->priority_name }}</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                                <div class="col-sm-12">
                                                <label for="cat_id">Kategori : </label>
                                                    <select name="cat_id" id="cat_id" class="form-control" required>
                                                      <option value="">Pilih Kategori</option>
                                                      @foreach($categories as $category)
                                                          <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                                                      @endforeach
                                                  </select>
                                                </div>
                                                <div class="col-sm-12">
                                                <label for="type_id">Tipe : </label>
                                                    <select name="type_id" id="type_id" class="form-control" required>
                                                      <option value="">Pilih Tipe</option>
                                                      @foreach($tipies as $type)
                                                          <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                                                      @endforeach
                                                  </select>
                                                </div>
                                                <div class="col-sm-12">
                                                <label for="uom_id">Satuan : </label>
                                                    <select name="uom_id" id="uom_id" class="form-control" required>
                                                      <option value="">Pilih Satuan</option>
                                                      @foreach($uomies as $uom)
                                                          <option value="{{ $uom->uom_id }}">{{ $uom->uom_name }}</option>
                                                      @endforeach
                                                  </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="saveAssetButton">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Update Modal -->
                            <div id="updateModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Update Asset</h5>
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
                                                      <label for="edit-asset_code">Assets Code : </label>
                                                      <input type="text" name="asset_code" id="edit-asset_code" class="form-control" required readonly>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="edit-asset_model">Assets Model : </label>
                                                      <input type="text" name="asset_model" id="edit-asset_model" class="form-control" required>
                                                  </div>
                                                  <!-- <div class="col-sm-12">
                                                      <label for="edit-asset_status">Assets Status : </label>
                                                      <input type="text" name="asset_status" id="edit-asset_status" class="form-control" required>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="edit-asset_quantity">Assets Quantity : </label>
                                                      <input type="text" name="asset_quantity" id="edit-asset_quantity" class="form-control" required>
                                                  </div> -->
                                                  <div class="col-sm-12">
                                                    <label for="edit-asset_image">Asset Image: </label>
                                                    <input type="file" name="asset_image" id="edit-asset_image" class="form-control" accept="image/*">
                                                    <small class="form-text text-muted">Leave empty to keep the current image.</small>
                                                </div>
                                                  <div class="col-sm-12">
                                                    <label for="edit-priority_id">Priority: </label>
                                                    <select name="priority_id" id="edit-priority_id" class="form-control" required>
                                                        <option value="">Select Priority</option>
                                                        @foreach($priorities as $priority)
                                                            <option value="{{ $priority->priority_id }}">{{ $priority->priority_name }}</option>
                                                        @endforeach
                                                    </select>
                                                  </div>
                                                  <div class="col-sm-12">
                                                      <label for="edit-cat_id">Category : </label>
                                                      <select name="cat_id" id="edit-cat_id" class="form-control" required>
                                                          <option value="">Select Category</option>
                                                          @foreach($categories as $category)
                                                              <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                                                          @endforeach
                                                      </select>
                                                    </div>
                                                  <div class="col-sm-12">
                                                      <label for="edit-type_id">Type : </label>
                                                      <select name="type_id" id="edit-type_id" class="form-control" required>
                                                          <option value="">Select Type</option>
                                                          @foreach($tipies as $type)
                                                              <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                                                          @endforeach
                                                      </select>
                                                    </div>
                                                  <div class="col-sm-12">
                                                      <label for="edit-uom_id">Uom : </label>
                                                      <select name="uom_id" id="edit-uom_id" class="form-control" required>
                                                          <option value="">Select Uom</option>
                                                          @foreach($uomies as $uom)
                                                              <option value="{{ $uom->uom_id }}">{{ $uom->uom_name }}</option>
                                                          @endforeach
                                                      </select>
                                                    </div>
                                                  <input type="hidden" name="asset_id" id="edit-asset_id">
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

                            <div class="modal fade" id="assetDetailModal" tabindex="-1" role="dialog" aria-labelledby="assetModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="assetModalLabel">Detail asset</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                        <p><strong>ID:</strong> <span id="asset-id"></span></p>
                                        <p><strong>Kode:</strong> <span id="asset-code"></span></p>
                                        <!-- <p><strong>Status:</strong> <span id="asset-status"></span></p> -->
                                        <p><strong>Model:</strong> <span id="asset-model"></span></p>
                                        <!-- <p><strong>Quantity:</strong> <span id="asset-quantity"></span></p> -->
                                        <p><strong>Prioritas:</strong> <span id="priority-id"></span></p>
                                        <p><strong>Kategori:</strong> <span id="cat-id"></span></p>
                                        <p><strong>Tipe:</strong> <span id="type-id"></span></p>
                                        <p><strong>Satuan:</strong> <span id="uom-id"></span></p> 
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
                                        <form action="{{ url('/admin/regist/import-master-asset')}}" method="post" enctype="multipart/form-data">
                                          @csrf
                                            <label for="import-data">Import Data Excel : </label>
                                            <input type="file" name="file" id="file" class="form-control" placeholder="Upload File Excel">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
        
                            <div class="table-responsive product-table" style="max-width: 100%; overflow-x: auto;">
                                <div class="d-flex justify-content-between mb-3 mt-3">
                                    <h5>Asset Data</h5> <!-- Add a heading for the table if needed -->
                                    <!-- Search Input Field aligned to the right -->
                                    <!-- <div class="input-group" style="width: 250px;">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search for assets..." />
                                    </div> -->
                                </div>
                                <table class="table table-striped display" id="coba" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Asset Code</th>
                                            <th>Asset Model</th>
                                            <th>Prioritas</th>
                                            <th>Kategori</th>
                                            <th>Tipe</th>
                                            <th>Satuan</th>
                                            <!-- <th>Status</th>
                                            <th>Quantity</th>
                                            <th>Priority</th> -->
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="coba-tbody">
                                        @foreach($assets as $asset)
                                            <tr>
                                            <td>{{ $asset->asset_id }}</td>
                                            <td>{{ $asset->asset_code }}</td>
                                            <td>{{ $asset->asset_model }}</td>
                                            <td>{{ $asset->priority_name }}</td>
                                            <td>{{ $asset->cat_name }}</td>
                                            <td>{{ $asset->type_name }}</td>
                                            <td>{{ $asset->uom_name }}</td>

                                           
                                                
                                                <td>
                                                  <a href="javascript:void(0);" class="edit-button" 
                                                  data-id="{{ $asset->asset_id }}" 
                                                  data-code="{{ $asset->asset_code }}" 
                                                  data-status="{{ $asset->asset_status }}" 
                                                  data-model="{{ $asset->asset_model }}" 
                                                  data-quantity="{{ $asset->asset_quantity }}" 
                                                  data-image="{{ $asset->asset_image }}" 
                                                  data-priority="{{ $asset->priority_id }}" 
                                                  data-category="{{ $asset->cat_id }}" 
                                                  data-type="{{ $asset->type_id }}" 
                                                  data-uom="{{ $asset->uom_id }}" 
                                                  title="Edit">
                                                     <i class="fas fa-edit"></i>
                                               </a>
                                                    <a href="javascript:void(0);" class="detail-button" 
                                                    data-id="{{ $asset->asset_id }}" 
                                                    data-code="{{ $asset->asset_code }}" 
                                                    data-status="{{ $asset->asset_status }}" 
                                                    data-model="{{ $asset->asset_model }}" 
                                                    data-quantity="{{ $asset->asset_quantity }}" 
                                                    data-image="{{ $asset->asset_image }}" 
                                                    data-priority="{{ $asset->priority_name }}" 
                                                    data-category="{{ $asset->cat_name }}" 
                                                    data-type="{{ $asset->type_name }}" 
                                                    data-uom="{{ $asset->uom_name }}" 
                                                    title="Detail">
                                                        <i class="fas fa-book"></i>
                                                    </a>
                                                    <form class="delete-form" action="{{ url('admin/regists/delete', $asset->asset_id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="delete-button" title="Delete" style="border: none; background: none; cursor: pointer;">
                                                            <i class="fas fa-trash-alt" style="color: red;"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
   
    <!-- <script src="{{asset('assets/js/data-asset.js')}}"></script> -->

    
    {{-- Get Data asset --}}
    
      <script>
        var table = $('#coba-tbody').DataTable({
          columnDefs: [
          {
              targets: 0, // Targeting the Asset Tag column
              width: "250px", // Ensure enough space for Asset Tag
              render: function (data, type, row) {
                  return `<div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="${data}">${data}</div>`;
              },
          },
          { targets: "_all", width: "auto" }, // Default auto-width for other columns
      ],
      "ajax": {
          "url": "/reports/get_data_mutasi_stock",
          "type": "GET",
          "dataSrc": ""
      },
      "columns" : [
        { "data": "register_code" }, 

        { "data": "asset_tag" },
        { 
          "data" : "create_by"
        },
        {
                data: "appr_1_date",
                render: function (data, type, row) {
                    return data ? data : "Belum Approve"; // Handle null values
                }
            },
            {
                data: "appr_2_date",
                render: function (data, type, row) {
                    return data ? data : "Belum Approve"; // Handle null values
                }
            },
            {
                data: "appr_3_date",
                render: function (data, type, row) {
                    return data ? data : "Belum Approve"; // Handle null values
                }
            },
        {
          "data" : "asset_model"
        },
        {
          "data" : "qty"
        },
        {
          "data" : "uom_name"
        },
        {
          "data" : "from_store"
        },
        {
          "data" : "dest_store"
        },
        {
          "data" : "out_date"
        },
        {
          "data" : "create_date"
        },
        {
          "data" : "condition_name"
        }
    ]
        });
      </script>


    <script>

      
    function generateRandomCode(length) {
          return Math.floor(Math.pow(10, length-1) + Math.random() * 9 * Math.pow(10, length - 1));
        }
    
        function generateAssetCode() {
          const date = new Date();
          const day = String(date.getDate()).padStart(2, '0');
          const month = String(date.getMonth() + 1).padStart(2, '0');
          const year = date.getFullYear();
          const randomCode = generateRandomCode(4);
    
          const assetCode = `AST-${day}-${month}-${year}-${randomCode}`;
          return assetCode;
        }
    
        function newSetAssetCode() {
          document.getElementById('asset_code').value =generateAssetCode();
        }
    
        newSetAssetCode();


       $(document).ready(function() {
        $('#coba').DataTable({
          paging: true, // Enable pagination
          searching: true, // Enable searching
          ordering: true // Enable sorting
        });
      });

       
    </script>

    {{-- Add Data Asset --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $('#saveAssetButton').click(function (e) {
          e.preventDefault();
          
          // Create a FormData object from the form
          var formData = new FormData($('#addAssetForm')[0]);
  
          $.ajax({
              url: "{{ route('add-regist') }}", // Correct URL
              method: 'POST',
              data: formData,
              contentType: false, // Important: Prevent jQuery from setting the content type
              processData: false, // Important: Prevent jQuery from processing the data
              success: function(response) {
                  console.log(response);
                  if (response.status === 'success') {
                      $('#addDataAsset').modal('hide');
                      window.location.href = '/admin/regist';
                  } else {
                      alert(response.message);
                  }
              },
              error: function(jqXHR) {
                  console.log(jqXHR.responseJSON); // Check error details
                  const message = jqXHR.responseJSON?.message || 'Failed to update Asset.';
                  alert(message); // Show error message
              }
          });
      });
  </script>

    {{-- Update Data Asset --}}
    <script>
      
      $(document).ready(function() {
          $(document).on('click', '.edit-button', function() {
              const assetId = $(this).data('id');
              const assetCode = $(this).data('code');
              const assetModel = $(this).data('model');
              const assetQuantity = $(this).data('quantity');
              const assetStatus = $(this).data('status');
              // const assetImage = $(this).data('image');
              const priorityId = $(this).data('priority');
              const catId = $(this).data('category');
              const typeId = $(this).data('type');
              const uomId = $(this).data('uom');
  
              $('#edit-asset_id').val(assetId);
              $('#edit-asset_code').val(assetCode);
              $('#edit-asset_model').val(assetModel);
              $('#edit-asset_quantity').val(assetQuantity);
              $('#edit-asset_status').val(assetStatus);
              // $('#edit-asset_image').val(assetImage);
              $('#edit-priority_id').val(priorityId).change();
              $('#edit-cat_id').val(catId).change();
              $('#edit-type_id').val(typeId).change();
              $('#edit-uom_id').val(uomId).change();
  
              $('#updateModal').modal('show');
          });
  
          $('#updateForm').on('submit', function(e) {
              e.preventDefault();
  
              $.ajax({
                  url: '/admin/regist/update_master_asset/' + $('#edit-asset_id').val(),
                  method: 'PUT',
                  data: $(this).serialize(),
                  success: function(response) {
                      if (response.status === 'success') {
                          window.location.href = '/admin/regist';
                      }
                  },
                  error: function(jqXHR) {
                      const message = jqXHR.responseJSON?.message || 'Failed to update Asset.';
                      alert(message);
                  }
              });
          });
      });
  </script>

{{-- Detail --}}
<script>
  $(document).ready(function() {
      // Event listener for detail button
      $('.detail-button').on('click', function() {
          // Get brand data from the clicked button
          var assetId = $(this).data('id');
              var assetCode = $(this).data('code');
              var assetModel = $(this).data('model');
              var assetQuantity = $(this).data('quantity');
              var assetStatus = $(this).data('status');
              var assetImage = $(this).data('image');
              var priorityId = $(this).data('priority');
              var catId = $(this).data('category');
              var typeId = $(this).data('type');
              var uomId = $(this).data('uom');
          
          // Set the data into the modal
          $('#asset-id').text(assetId);
              $('#asset-code').text(assetCode);
              $('#asset-model').text(assetModel);
              $('#asset-quantity').text(assetQuantity);
              $('#asset-status').text(assetStatus);
              $('#asset-image').text(assetImage);
              $('#priority-id').text(priorityId);
              $('#cat-id').text(catId);
              $('#type-id').text(typeId);
              $('#uom-id').text(uomId);
          
          // Show the modal
          $('#assetDetailModal').modal('show');
      });
  });
</script>
    
    {{-- Delete data Asset --}}
    <script>
        $(document).on('click', '.delete-button', function(e) {
        e.preventDefault(); // Mencegah submit form default
        const form = $(this).closest('form'); // Ambil form yang terdekat dari tombol

        // Tampilkan dialog konfirmasi
        if (confirm('Apakah Anda yakin ingin menghapus Asset ini?')) {
            // Ambil URL dari action form
            const actionUrl = form.attr('action');
            
            $.ajax({
                url: actionUrl, // URL dari form
                method: 'DELETE', // Method untuk delete
                data: form.serialize(), // Kirim data form
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = response.redirect_url; // Redirect ke Admin.Asset
                    } else {
                        alert(response.message); // Tampilkan pesan error jika gagal
                    }
                },
                error: function(jqXHR) {
                    alert('Gagal menghapus data. Coba lagi.');
                }
            });
        }
    });
    </script>
    <!-- <script>
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
  </script> -->
  
  <script>
    $(document).ready(function() {
        // This will handle all modals that have a button with the data-dismiss attribute
        $('[data-dismiss="modal"]').on('click', function() {
            $('.modal').modal('hide');  // Hide any open modal
        });
    });
  </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

   <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>