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
       @include('Admin.layouts.right_sidebar_admin')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->

          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Adjustment Stock Name List</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">ASMI</li>
                    <li class="breadcrumb-item active">Adjustment Stock Name List</li>
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
                    <h5>Adjustment Stock Name List</h5>
                    <span>adalah daftar atau kumpulan aset yang dimiliki oleh seseorang, organisasi, atau perusahaan. Daftar ini biasanya mencakup rincian tentang setiap aset, seperti jenis aset, nilai, lokasi, dan informasi relevan lainnya.</span>
                  </div>
					<div class="card-body"> 
						<div class="btn-showcase">
                            <div class="button_between">
                                {{-- <button class="btn btn-square btn-primary" type="button" data-toggle="modal" data-target="#addDataMoveOut">+ Add Data Adjustment Stock</button> --}}
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
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add Data Stock Opname</h5>
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
                                        <label for="loc_id">Lokasi :</label>
                                        <input type="text" name="loc_id" id="loc_id" class="form-control" value="{{ $locId }}" readonly>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="opname_desc">Deskripsi Stock Opname:</label>
                                        <input type="text" name="opname_desc" id="opname_desc" class="form-control" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="so_id">Alasan Stock Opname:</label>
                                        <select name="so_id" id="so_id" class="form-control" required>
                                            <option value="">Pilih Alasan</option>
                                            @foreach($reasons as $reason)
                                                <option value="{{ $reason->reason_id }}">{{ $reason->reason_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                      
                                  <!-- Container untuk data asset -->
                                  <div id="assetFieldsContainer">
                                    <!-- Asset Field Section -->
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
                                          <label for="satuan">Satuan:</label>
                                          <input type="text" name="satuan[]" class="form-control satuan" readonly>
                                        </div>
                                        <div class="col-sm-12">
                                          <label for="register_code">Asset Tag:</label>
                                          <input type="text" name="register_code[]" class="form-control register_code" readonly>
                                        </div>
                                        <div class="col-sm-12">
                                          <label for="qty">Qty OnHand:</label>
                                          <input type="text" name="qty[]" class="form-control qty" readonly>
                                        </div>
                                        <div class="col-sm-12">
                                          <label for="qty_physical">Qty Actual:</label>
                                          <input type="number" name="qty_physical[]" class="form-control" required>
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
                                          <h5 class="modal-title" id="exampleModalLabel">Update Stock Opname</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <form id="updateForm">
                                          @csrf
                                          @method('PUT') <!-- Metode override untuk request PUT -->
                                          <div class="modal-body">
                                              <div class="row">
                                                  <div class="col-sm-12 mb-2">
                                                      <label for="edit-qty_physical">Qty Physical:</label>
                                                      <input type="number" name="qty_physical" id="edit-qty_physical" class="form-control" required>
                                                  </div>
                                                  <input type="hidden" name="opname_id" id="opname_id">
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
                                        <h5 class="modal-title" id="brandModalLabel">Detail Movement</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                      <p><strong>ID:</strong> <span id="moveout-id"></span></p>
                                      <p><strong>No Movement Out:</strong> <span id="moveout-no"></span></p>
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
                            <h5>Adjustment Stock Data</h5> <!-- Add a heading for the table if needed -->
                            <!-- Search Input Field aligned to the right -->
                            <div class="input-group" style="width: 250px;">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search for assets..." />
                            </div>
                        </div>
                        <table class="table table-striped display" id="coba" style="width: 100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Opname ID</th>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th>Register Code</th>
                                    <th>Qty OnHand</th>
                                    <th>Qty Actual</th>
                                    <th>Qty  Difference</th>
                                    <th>Kondisi</th>
                                    <th>Satuan</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($moveouts as $moveout)
                                    <tr class="text-center">
                                      {{-- <td>
                                        <img src="{{ asset($moveout->relative_qr_code_path) }}" alt="QR Code" style="width: 100px; height: 100px;">
                                    </td> --}}
                                        <td>{{ $moveout->opname_id }}</td>
                                        <td>{{ $moveout->loc_id }}</td>
                                        <td>{{ $moveout->opname_desc }}</td>
                                        <td>{{ $moveout->asset_tag }}</td>
                                        <td>{{ $moveout->qty_onhand }}</td>
                                        <td>{{ $moveout->qty_physical }}</td>
                                        <td>{{ $moveout->qty_difference }}</td>
                                        <td>{{ $moveout->condition_id }}</td>
                                        <td>{{ $moveout->uom }}</td>
                                        <td>{{ $moveout->image }}</td>
                                        <td class="text-center">
                                          @if($moveout->is_verify != 1)
                                            <a href="javascript:void(0);" class="edit-button" 
                                            data-id="{{ $moveout->opname_id }}" 
                                            title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                          @endif
                                            <a href="javascript:void(0);" class="detail-button" 
                                            data-id="{{ $moveout->opname_id }}" 
                                            title="Detail">
                                                <i class="fas fa-book"></i>
                                            </a>
                                        </td>
                                    </tr>
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
    <script>
        $(document).ready(function() {
            // Mengambil data moveout menggunakan Ajax
            $.ajax({
                url: "{{ route('get.moveout') }}", // Route untuk get_moveout
                method: "GET",
                success: function(data) {
                    let rows = '';
                    data.forEach(function(moveout) {
                        rows += `
                            <tr>
                                <td>${moveout.out_id}</td> <!-- Tampilkan ID moveout -->
                                <td>${moveout.out_no}</td> <!-- Tampilkan Nama moveout -->
                                <td>
                                <a href="javascript:void(0);" class="edit-button" data-id="${moveout.out_id}" data-name="${moveout.out_no}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="delete-form" action="{{ url('admin/moveouts/delete') }}/${moveout.out_id}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-button" title="Delete" style="border: none; background: none; cursor: pointer;">
                                        <i class="fas fa-trash-alt" style="color: red;"></i>
                                    </button>
                                </form>
                            </td>
                            </tr>
                        `;
                    });
                    $('#moveoutTableBody').html(rows); // Memasukkan baris ke dalam tbody
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching data:', textStatus, errorThrown);
                }
            });
        });
    </script>

    {{-- Add Data moveout --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
        // Get the CSRF token from the meta tag
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            $('#saveMoveOutButton').click(function (e) {
                e.preventDefault();

                let isValid = true;
    $('input[name^="qty_physical"]').each(function() {
        if ($(this).val() === '') {
            isValid = false;
            alert('Qty Actual field is required for each asset.');
            return false; // Break the loop
        }
    });

    if (!isValid) {
        return; // Exit if validation fails
    }
                // Ambil data form
                var moveoutData = {
        loc_id: $('#loc_id').val(),
        opname_desc: $('#opname_desc').val(),
        so_id: $('#so_id').val(),
        // Gather asset data as arrays
        asset_id: [],
        register_code: [],
        qty: [],
        satuan: [],
        condition_id: [],
        qty_physical: []
    };

    // Loop through each asset field
    $('.asset-select').each(function(index) {
        moveoutData.asset_id.push($(this).val());
    });
    $('input[name^="register_code"]').each(function(index) {
        moveoutData.register_code.push($(this).val());
    });
    $('input[name^="qty"]').each(function(index) {
        moveoutData.qty.push($(this).val());
    });
    $('input[name^="satuan"]').each(function(index) {
        moveoutData.satuan.push($(this).val());
    });
    $('input[name^="qty_physical"]').each(function(index) {
        moveoutData.qty_physical.push($(this).val());
    });
    $('select[name^="condition_id"]').each(function(index) {
        moveoutData.condition_id.push($(this).val());
    });

    // Send the gathered data
    $.ajax({
        url: '/add-stockopname', // Update this to your correct URL
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
      // Event handler for edit button click
      $(document).on('click', '.edit-button', function() {
          const opnameId = $(this).data('id'); // Ambil ID dari button

          $.ajax({
              url: `/admin/adjuststocks/put/${opnameId}`,
              method: 'GET',
              success: function(data) {
                  $('#opname_id').val(data.opname_id);
                  $('#edit-qty_physical').val(data.qty_physical);
                  $('#updateModal').modal('show');
              },
              error: function(xhr) {
                  alert(`Error fetching data: ${xhr.responseJSON.message}`);
              }
          });
      });

// Submit form dengan konfirmasi SweetAlert
$('#updateForm').on('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang sudah diubah tidak akan bisa diperbaiki.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan Perubahan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/admin/adjuststocks/edit/${$('#opname_id').val()}`,
                method: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire(
                            'Tersimpan!',
                            'Data telah berhasil diubah.',
                            'success'
                        ).then(() => {
                            window.location.href = response.redirect_url;
                        });
                    }
                },
                error: function(jqXHR) {
                    const message = jqXHR.responseJSON?.message || 'Gagal mengupdate data.';
                    Swal.fire('Error', message, 'error');
                }
            });
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
      document.querySelectorAll('.asset-select').forEach(select => {
        select.addEventListener('change', function () {
            const assetId = this.value;
            const assetFields = this.closest('.asset-fields');
            
            if (assetId) {
                fetch(`/get-asset-details/${assetId}`)
                    .then(response => response.json())
                    .then(data => {
                        assetFields.querySelector('.qty').value = data.qty || '';
                        assetFields.querySelector('.satuan').value = data.satuan || '';
                        assetFields.querySelector('.register_code').value = data.register_code || '';
                    })
                    .catch(error => console.error('Error fetching asset details:', error));
            } else {
                assetFields.querySelector('.qty').value = '';
                assetFields.querySelector('.satuan').value = '';
                assetFields.querySelector('.register_code').value = '';
            }
        });
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