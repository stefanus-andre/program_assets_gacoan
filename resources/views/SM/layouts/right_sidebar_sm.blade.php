<div class="sidebar-wrapper">
          <div>
            <div class="logo-wrapper"><a href="/sm/dashboard"><img class="img-fluid for-light" src="{{asset('assets/images/header-card.png')}}"></a>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
              <!-- <div class="toggle-sidebar"><i class="fa fa-cog status_toggle middle sidebar-toggle"> </i></div> -->
            </div>
            <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon1.png')}}"></a></div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn"><a href="index.html"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  <!-- <li class="sidebar-main-title">          
                    <h6 class="lan-1">General </h6>
                  </li>
                  <li class="menu-box"> 
                    <ul>             
                      <li class="sidebar-list">           <a class="sidebar-link sidebar-title" href="dashboard-02.html"><i data-feather="home"></i><span class="lan-3">Dashboard              </span></a>
                        <ul class="sidebar-submenu">
                        </ul>
                      </li>
                    </ul>
                  </li> -->
                  <li class="sidebar-main-title">          
                    <!-- <h6>Master Data</h6> -->
                  </li>
                  <li class="menu-box"> 
                    <ul>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/dashboard"><i data-feather="pie-chart"></i><span>Dashboard</span></a></li>
                        {{-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/registrasi_asset/lihat_data_registrasi_asset"><i data-feather="clipboard"></i><span>Registration</span></a></li> --}}
                        {{-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/halaman_asset"><i data-feather="clipboard"></i><span>Registration</span></a></li>
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="#"><i data-feather="arrow-right"></i><span>Assets Movement</span></a></li> --}}
                        <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="list-products.php"><i data-feather="cast"></i><span>Schedule Maintenance</span></a></li> -->
                    </ul>
                  </li>

                  <li class="sidebar-main-title">          
                    <h6>Asset</h6>
                  </li>
                  <li class="menu-box"> 
                    <ul>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="clipboard"></i><span>Registration</span></a>
                        <ul class="sidebar-submenu">
                          {{-- <li><a class="submenu-title" href="javascript:void(0)">Bootstrap Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="bootstrap-basic-table.html">Basic Tables</a></li>
                              <li><a href="table-components.html">Table components</a></li>
                            </ul>
                          </li>
                          <li><a class="submenu-title" href="javascript:void(0)">Data Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="datatable-basic-init.html">Basic Table</a></li>
                              <li><a href="datatable-API.html">Data API</a></li>
                              <li><a href="datatable-data-source.html">Data Sources</a></li>
                            </ul>
                          </li> --}}
                          {{-- <li><a class="sidebar-link sidebar-title link-nav" href="/admin/registrasi_asset/lihat_data_registrasi_asset"><span>Assets Regist</span></a></li></li> --}}
                          <li><a class="sidebar-link sidebar-title link-nav" href="/sm/registrasi_asset"><span>Assets Regist</span></a></li></li>
                          <!-- <li><a class="sidebar-link sidebar-title link-nav" href="/admin/approval-reg"><span>Approval OPS SM</span></a></li> -->
                          <!-- <li><a class="sidebar-link sidebar-title link-nav" href="/admin/review-reg"><span>Review TAF</span></a></li> -->
                        </ul>
                      
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="server"></i><span>Asset Transfer</span></a>
                          <ul class="sidebar-submenu">
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/sm/movement/lihat_data_movement"><span>Request Movement Out SM</span></a></li>
                            <!-- @if(Auth::user() && Auth::user()->role === 'am')
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/apprmoveout-am"><span>Approval OPS AM</span></a></li>
                            @endif -->
                            <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/apprmoveout-am"><span>Approval OPS AM</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/apprmoveout-rm"><span>Approval OPS RM</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/apprmoveout-sdgasset"><span>Approval SDG Assets</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/movein"><span>Request Movement In</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/delivery"><span>Delivery Order</span></a></li> -->
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/sm/movement/data_confirm"><span>Confirm Asset SM</span></a></li>
                            <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/data-movement"><span>Data Movement</span></a></li> -->
                            <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/rev-head"><span>Review Ops Head</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/rev-mnr"><span>Review MnR Area</span></a></li> 
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/rev-taf"><span>Review TAF Accounting</span></a></li> -->
                          </ul> 
                        </li> 
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="book"></i><span>Disposal</span></a>
                          <ul class="sidebar-submenu">
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/sm/disposal"><span>Request Disposal SM</span></a></li>
                            <!-- @if(Auth::user() && Auth::user()->role === 'am')
                                        <li class="sidebar-list">
                                            <a class="sidebar-link sidebar-title link-nav" href="/admin/apprdis-am">
                                                <span>Approval OPS AM</span>
                                            </a>
                                        </li>
                            @endif -->
                            <!-- <li class="sidebar-list"> 
                                            <a class="sidebar-link sidebar-title link-nav" href="/admin/apprdis-am">
                                                <span>Approval OPS AM</span>
                                            </a>
                                        </li> -->
                            <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/apprdis-rm"><span>Approval OPS RM</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/apprdis-sdgasset"><span>Approval SDG Assets</span></a></li> -->
                            <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/disin"><span>Request Disposal In</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/deliverydis"><span>Delivery Order</span></a></li> -->
                            <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/confirmdis"><span>Confirm Disposal</span></a></li> -->
                            <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/data-disposal"><span>Data Disposal</span></a></li> -->
                            <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/revdis-head"><span>Review Ops Head</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/revdis-mnr"><span>Review MnR Area</span></a></li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/revdis-taf"><span>Review TAF Accounting</span></a></li> -->
                          </ul>
                        </li>

                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="archive"></i><span>Stock Opname</span></a>
                        <ul class="sidebar-submenu">
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/stockopname"><span>Data Stock Opname</span></a></li>
                          <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/adjustmentstock"><span>Adjustment Stock</span></a></li> -->
                        </ul>
                      </li>
                    </ul>
                  </li>


                  
                  <li class="sidebar-main-title">          
                    <h6>Maintenance</h6>
                  </li>
                  <li class="menu-box"> 
                    <ul>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="clock"></i><span>Schedule</span></a>
                        <ul class="sidebar-submenu">
                          <li><a class="sidebar-link sidebar-title link-nav" href="/schedule/lihat_data_schedule"><span> Data Schedule</span></a></li></li>
                        </ul>
                        
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="trello"></i><span>Preventive Maintenance</span></a>
                        <ul class="sidebar-submenu">
                          <li><a class="sidebar-link sidebar-title link-nav" href="/preventive_maintenance/lihat_data_preventive_maintenance"><span> Data Preventive Schedule</span></a></li></li>
                        </ul>

                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="edit"></i><span>Corrective Maintenance</span></a>
                        <ul class="sidebar-submenu">
                          <li><a class="sidebar-link sidebar-title link-nav" href="/corrective_maintenance/lihat_data_corrective_maintenance"><span> Data Corrective Schedule</span></a></li></li>
                        </ul>

                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="check-circle"></i><span>Checklist</span></a>
                        <ul class="sidebar-submenu">
                          <li><a class="sidebar-link sidebar-title link-nav" href="/checklist/lihat_data_checklist"><span> Data Checklist Schedule</span></a></li></li>
                        </ul>
                    </ul>
                  </li>


                  <!-- <li class="sidebar-main-title">          
                    <h6>Master Data</h6>
                  </li>
                  
                  <li class="menu-box"> 
                    <ul>
                      <li class="sidebar-list">
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="database"></i><span>Master Data</span></a>
                        <ul class="sidebar-submenu">
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/regist"><span>Asset</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/registeqp"><span>Asset Equipment</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="#"><span>Merk</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/brand"><span>Brand</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/category"><span>Kategori</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/subcategory"><span>Sub Kategori</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/checklist"><span>Checklist</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/condition"><span>Kondisi</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/control"><span>Kontrol Checklist</span></a></li>

                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/dept"><span>Departement</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/division"><span>Division</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/groupuser"><span>Group User</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/joblevel"><span>Job Level</span></a></li>

                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/layout"><span>Tata Letak</span></a></li>

                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/location"><span>Lokasi</span></a></li>

                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/mtc"><span>Maintenance</span></a></li>
                          
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/people"><span>People</span></a></li>

                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/type"><span>Tipe Asset</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/tipe_maintenance"><span>Tipe Maintenance Asset</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/periodic"><span>Periodic Maintenance</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/priority"><span>Prioritas</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/reason"><span>Alasan Mutasi</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/reasonso"><span>Alasan Stock Opname</span></a></li>
                          
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/region"><span>Regional</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/repair"><span>Perbaikan</span></a></li>
                          
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/supplier"><span>Pemasok</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/uom"><span>Satuan</span></a></li>
                          
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/warranty"><span>Garansi</span></a></li>
                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/city"><span>Kota</span></a></li>

                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/resto"><span>Resto</span></a></li>

                          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/approval_maintenance"><span>Approval Maintenance</span></a></li>
                            
                          

                        </ul>
                      </li>
                    </ul>
                  </li> -->

                  
<!-- 
                  <li class="sidebar-main-title">          
                    <h6>User Management</h6>
                  </li>
                  <li class="menu-box"> 
                    <ul>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="clipboard"></i><span>User</span></a>
                        <ul class="sidebar-submenu">
                          {{-- <li><a class="submenu-title" href="javascript:void(0)">Bootstrap Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="bootstrap-basic-table.html">Basic Tables</a></li>
                              <li><a href="table-components.html">Table components</a></li>
                            </ul>
                          </li>
                          <li><a class="submenu-title" href="javascript:void(0)">Data Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="datatable-basic-init.html">Basic Table</a></li>
                              <li><a href="datatable-API.html">Data API</a></li>
                              <li><a href="datatable-data-source.html">Data Sources</a></li>
                            </ul>
                          </li> --}}
                          <li><a class="sidebar-link sidebar-title link-nav" href="/admin/user"><span>User</span></a></li></li>
                          <li><a class="sidebar-link sidebar-title link-nav" href="/admin/permission"><span>Permission</span></a></li></li>
                        </ul>
                    </ul>
                  </li> -->



                  <li class="sidebar-main-title">          
                    <h6>Report</h6>
                  </li>
                  <li class="menu-box"> 
                    <ul>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="clipboard"></i><span>Report</span></a>
                        <ul class="sidebar-submenu">
                          {{-- <li><a class="submenu-title" href="javascript:void(0)">Bootstrap Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="bootstrap-basic-table.html">Basic Tables</a></li>
                              <li><a href="table-components.html">Table components</a></li>
                            </ul>
                          </li>
                          <li><a class="submenu-title" href="javascript:void(0)">Data Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="datatable-basic-init.html">Basic Table</a></li>
                              <li><a href="datatable-API.html">Data API</a></li>
                              <li><a href="datatable-data-source.html">Data Sources</a></li>
                            </ul>
                          </li> --}}
                          <li><a class="sidebar-link sidebar-title link-nav" href="/reports/registrasi_asset_report"><span>Registrasi Asset</span></a></li></li>
                          <li><a class="sidebar-link sidebar-title link-nav" href="/reports/mutasi_stock_asset"><span>Mutasi Stock Asset</span></a></li></li>
                          <li><a class="sidebar-link sidebar-title link-nav" href="/reports/kartu_stock_asset"><span>Kartu Stock Asset</span></a></li></li>
                          <li><a class="sidebar-link sidebar-title link-nav" href="/reports/stock_opname"><span>Stock Opname</span></a></li></li>
                          <!-- <li><a class="sidebar-link sidebar-title link-nav" href="/reports/checklist_asset"><span>Checklist Asset</span></a></li></li> -->
                          <!-- <li><a class="sidebar-link sidebar-title link-nav" href="/reports/maintenance_asset"><span>Maintenance Asset</span></a></li></li> -->
                          <!-- <li><a class="sidebar-link sidebar-title link-nav" href="/reports/history_maintenance_asset"><span>History Maintenance Asset</span></a></li></li> -->
                          <li><a class="sidebar-link sidebar-title link-nav" href="/reports/stock_asset_per_location"><span>Stock Asset Per Location</span></a></li></li>
                          <!-- <li><a class="sidebar-link sidebar-title link-nav" href="/reports/garansi_asset"><span>Garansi Asset</span></a></li></li> -->
                          <li><a class="sidebar-link sidebar-title link-nav" href="/reports/disposal_asset"><span>Disposal Asset</span></a></li></li>
                          <!-- <li><a class="sidebar-link sidebar-title link-nav" href="/reports/stock_opname"><span>Stock Opname</span></a></li></li> -->
                          <!-- <li><a class="sidebar-link sidebar-title link-nav" href="/reports/trend_issue_maintenace"><span>Trend Issue Maintenance</span></a></li></li> -->
                        </ul>
                    </ul>
                  </li> 


				        {{-- <li class="sidebar-main-title">          
                    <h6>Registrasi Asset    </h6>
                  </li>
                  <li class="menu-box"> 
                    <ul>        
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="list-products.php"><i data-feather="cast"> </i><span>Asset list</span></a></li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="list-products.php"><i data-feather="file-text"> </i><span>Component list</span></a></li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="list-products.php"><i data-feather="globe"> </i><span>Priority list</span></a></li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="list-products.php" target="_blank"><i data-feather="anchor"></i><span>Schedule Mainten</span></a></li>
                    </ul>
                  </li> --}}
                  {{-- <li class="sidebar-main-title">          
                    <h6>Checklist Asset             </h6>
                  </li>
                  <li class="menu-box"> 
                    <ul>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="file-text"></i><span>dash</span></a>
                        <ul class="sidebar-submenu">
                          <li><a class="submenu-title" href="javascript:void(0)">Form Controls<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="form-validation.html">Form Validation</a></li>
                              <li><a href="base-input.html">Base Inputs</a></li>
                              <li><a href="radio-checkbox-control.html">Checkbox & Radio</a></li>
                              <li><a href="input-group.html">Input Groups</a></li>
                              <li><a href="megaoptions.html">Mega Options</a></li>
                            </ul>
                          </li>
                          <li><a class="submenu-title" href="javascript:void(0)">Form Widgets<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="datepicker.html">Datepicker</a></li>
                              <li><a href="time-picker.html">Timepicker</a></li>
                              <li><a href="datetimepicker.html">Datetimepicker</a></li>
                              <li><a href="daterangepicker.html">Daterangepicker</a></li>
                              <li><a href="touchspin.html">Touchspin</a></li>
                              <li><a href="select2.html">Select2</a></li>
                              <li><a href="switch.html">Switch</a></li>
                              <li><a href="typeahead.html">Typeahead</a></li>
                              <li><a href="clipboard.html">Clipboard</a></li>
                            </ul>
                          </li>
                          <li><a class="submenu-title" href="javascript:void(0)">Form layout<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="default-form.html">Default Forms</a></li>
                              <li><a href="form-wizard.html">Form Wizard 1</a></li>
                              <li><a href="form-wizard-two.html">Form Wizard 2</a></li>
                              <li><a href="form-wizard-three.html">Form Wizard 3</a></li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="server"></i><span>Tables</span></a>
                        <ul class="sidebar-submenu">
                          <li><a class="submenu-title" href="javascript:void(0)">Bootstrap Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="bootstrap-basic-table.html">Basic Tables</a></li>
                              <li><a href="table-components.html">Table components</a></li>
                            </ul>
                          </li>
                          <li><a class="submenu-title" href="javascript:void(0)">Data Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="datatable-basic-init.html">Basic Table</a></li>
                              <li><a href="datatable-API.html">Data API</a></li>
                              <li><a href="datatable-data-source.html">Data Sources</a></li>
                            </ul>
                          </li>
                          <li><a href="datatable-ext-autofill.html">Ex. Data Tables</a></li>
                          <li><a href="jsgrid-table.html">Js Grid Table        </a></li>
                        </ul>
                      </li>
                    </ul>
                  </li> --}}
                  <!-- <li class="sidebar-main-title">          
                    <h6>Components</h6>
                  </li>
                  <li class="menu-box"> 
                    <ul>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="box"></i><span>Ui Kits</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="typography.html">Typography</a></li>
                          <li><a href="avatars.html">Avatars</a></li>
                          <li><a href="helper-classes.html">Helper classes</a></li>
                          <li><a href="grid.html">Grid</a></li>
                          <li><a href="tag-pills.html">Tag & pills</a></li>
                          <li><a href="progress-bar.html">Progress</a></li>
                          <li><a href="modal.html">Modal</a></li>
                          <li><a href="alert.html">Alert</a></li>
                          <li><a href="popover.html">Popover</a></li>
                          <li><a href="tooltip.html">Tooltip</a></li>
                          <li><a href="loader.html">Spinners</a></li>
                          <li><a href="dropdown.html">Dropdown</a></li>
                          <li><a href="according.html">Accordion</a></li>
                          <li><a class="submenu-title" href="javascript:void(0)">Tabs<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="tab-bootstrap.html">Bootstrap Tabs</a></li>
                              <li><a href="tab-material.html">Line Tabs</a></li>
                            </ul>
                          </li>
                          <li><a href="box-shadow.html">Shadow</a></li>
                          <li><a href="list.html">Lists</a></li>
                        </ul>
                      </li> -->
                      <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="folder-plus"></i><span>Bonus Ui</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="scrollable.html">Scrollable</a></li>
                          <li><a href="tree.html">Tree view</a></li>
                          <li><a href="bootstrap-notify.html">Bootstrap Notify</a></li>
                          <li><a href="rating.html">Rating</a></li>
                          <li><a href="dropzone.html">dropzone</a></li>
                          <li><a href="tour.html">Tour</a></li>
                          <li><a href="sweet-alert2.html">SweetAlert2</a></li>
                          <li><a href="modal-animated.html">Animated Modal</a></li>
                          <li><a href="owl-carousel.html">Owl Carousel</a></li>
                          <li><a href="ribbons.html">Ribbons</a></li>
                          <li><a href="pagination.html">Pagination</a></li>
                          <li><a href="breadcrumb.html">Breadcrumb</a></li>
                          <li><a href="range-slider.html">Range Slider</a></li>
                          <li><a href="image-cropper.html">Image cropper</a></li>
                          <li><a href="sticky.html">Sticky</a></li>
                          <li><a href="basic-card.html">Basic Card</a></li>
                          <li><a href="creative-card.html">Creative Card</a></li>
                          <li><a href="tabbed-card.html">Tabbed Card</a></li>
                          <li><a href="dragable-card.html">Draggable Card</a></li>
                          <li><a class="submenu-title" href="javascript:void(0)">Timeline<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                              <li><a href="timeline-v-1.html">Timeline 1</a></li>
                              <li><a href="timeline-v-2.html">Timeline 2</a></li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="cloud-drizzle"></i><span>Animation</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="animate.html">Animate</a></li>
                          <li><a href="scroll-reval.html">Scroll Reveal</a></li>
                          <li><a href="AOS.html">AOS animation</a></li>
                          <li><a href="tilt.html">Tilt Animation</a></li>
                          <li><a href="wow.html">Wow Animation</a></li>
                        </ul>
                      </li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="command"></i><span>Icons</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="flag-icon.html">Flag icon</a></li>
                          <li><a href="font-awesome.html">Fontawesome Icon</a></li>
                          <li><a href="ico-icon.html">Ico Icon</a></li>
                          <li><a href="themify-icon.html">Themify Icon</a></li>
                          <li><a href="feather-icon.html">Feather icon</a></li>
                          <li><a href="whether-icon.html">Whether Icon</a></li>
                        </ul>
                      </li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="cloud"></i><span>Buttons</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="buttons.html">Default Style</a></li>
                          <li><a href="button-group.html">Button Group</a></li>
                        </ul>
                      </li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="bar-chart"></i><span>Charts</span></a>
                        <ul class="sidebar-submenu">                
                          <li><a href="chart-apex.html">Apex Chart</a></li>
                          <li><a href="chart-google.html">Google Chart</a></li>
                          <li><a href="chart-sparkline.html">Sparkline chart</a></li>
                          <li><a href="chart-flot.html">Flot Chart</a></li>
                          <li><a href="chart-knob.html">Knob Chart</a></li>
                          <li><a href="chart-morris.html">Morris Chart</a></li>
                          <li><a href="chartjs.html">Chatjs Chart</a></li>
                          <li><a href="chartist.html">Chartist Chart</a></li>
                          <li><a href="chart-peity.html">Peity Chart</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="sidebar-main-title">          
                    <h6>Pages    </h6>
                  </li>
                  <li class="menu-box"> 
                    <ul>        
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="landing-page.html"><i data-feather="cast"> </i><span>Landing page</span></a></li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="sample-page.html"><i data-feather="file-text"> </i><span>Sample page</span></a></li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="internationalization.html"><i data-feather="globe"> </i><span>Internationalization</span></a></li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="../starter-kit/index.html" target="_blank"><i data-feather="anchor"></i><span>Starter kit</span></a></li>
                      <li class="mega-menu"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="layers"></i><span>Others</span></a>
                        <div class="mega-menu-container menu-content">
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col mega-box">
                                <div class="link-section">
                                  <div class="submenu-title">
                                    <h5>Error Page</h5>
                                  </div>
                                  <ul class="submenu-content opensubmegamenu">
                                    <li><a href="error-page1.html">Error Page 1</a></li>
                                    <li><a href="error-page2.html">Error Page 2</a></li>
                                    <li><a href="error-page3.html">Error Page 3</a></li>
                                    <li><a href="error-page4.html">Error Page 4</a></li>
                                    <li><a href="error-page5.html">Error Page 5                            </a></li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col mega-box">
                                <div class="link-section">
                                  <div class="submenu-title">
                                    <h5> Authentication</h5>
                                  </div>
                                  <ul class="submenu-content opensubmegamenu">
                                    <li><a href="login.html" target="_blank">Login Simple</a></li>
                                    <li><a href="login_one.html" target="_blank">Login with bg image</a></li>
                                    <li><a href="login_two.html" target="_blank">Login with image two                      </a></li>
                                    <li><a href="login-bs-validation.html" target="_blank">Login With validation</a></li>
                                    <li><a href="login-bs-tt-validation.html" target="_blank">Login with tooltip</a></li>
                                    <li><a href="login-sa-validation.html" target="_blank">Login with sweetalert</a></li>
                                    <li><a href="sign-up.html" target="_blank">Register Simple</a></li>
                                    <li><a href="sign-up-one.html" target="_blank">Register with Bg Image                              </a></li>
                                    <li><a href="sign-up-two.html" target="_blank">Register with Bg video</a></li>
                                    <li><a href="unlock.html">Unlock User</a></li>
                                    <li><a href="forget-password.html">Forget Password</a></li>
                                    <li><a href="reset-password.html">Reset Password</a></li>
                                    <li><a href="maintenance.html">Maintenance</a></li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col mega-box">
                                <div class="link-section">
                                  <div class="submenu-title">
                                    <h5>Coming Soon</h5>
                                  </div>
                                  <ul class="submenu-content opensubmegamenu">
                                    <li><a href="comingsoon.html">Coming Simple</a></li>
                                    <li><a href="comingsoon-bg-video.html">Coming with Bg video</a></li>
                                    <li><a href="comingsoon-bg-img.html">Coming with Bg Image</a></li>
                                  </ul>
                                </div>
                              </div>
                              <div class="col mega-box">
                                <div class="link-section">
                                  <div class="submenu-title">
                                    <h5>Email templates</h5>
                                  </div>
                                  <ul class="submenu-content opensubmegamenu">
                                    <li><a href="basic-template.html">Basic Email</a></li>
                                    <li><a href="email-header.html">Basic With Header</a></li>
                                    <li><a href="template-email.html">Ecomerce Template</a></li>
                                    <li><a href="template-email-2.html">Email Template 2</a></li>
                                    <li><a href="ecommerce-templates.html">Ecommerce Email</a></li>
                                    <li><a href="email-order-success.html">Order Success</a></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li> -->
                  <!-- <li class="sidebar-main-title">          
                    <h6>Miscellaneous             </h6>
                  </li>
                  <li class="menu-box"> 
                    <ul>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="image"></i><span>Gallery</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="gallery.html">Gallery Grid</a></li>
                          <li><a href="gallery-with-description.html">Gallery Grid Desc</a></li>
                          <li><a href="gallery-masonry.html">Masonry Gallery</a></li>
                          <li><a href="masonry-gallery-with-disc.html">Masonry with Desc</a></li>
                          <li><a href="gallery-hover.html">Hover Effects</a></li>
                        </ul>
                      </li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="film"></i><span>Blog</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="blog.html">Blog Details</a></li>
                          <li><a href="blog-single.html">Blog Single</a></li>
                          <li><a href="add-post.html">Add Post</a></li>
                        </ul>
                      </li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="faq.html"><i data-feather="help-circle"> </i><span>FAQ</span></a></li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="package"></i><span>Job Search</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="job-cards-view.html">Cards view</a></li>
                          <li><a href="job-list-view.html">List View</a></li>
                          <li><a href="job-details.html">Job Details</a></li>
                          <li><a href="job-apply.html">Apply</a></li>
                        </ul>
                      </li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="radio"></i><span>Learning</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="learning-list-view.html">Learning List</a></li>
                          <li><a href="learning-detailed.html">Detailed Course</a></li>
                        </ul>
                      </li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="map"></i><span>Maps</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="map-js.html">Maps JS</a></li>
                          <li><a href="vector-map.html">Vector Maps</a></li>
                        </ul>
                      </li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="edit"></i><span>Editors</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="summernote.html">Summer Note</a></li>
                          <li><a href="ckeditor.html">CK editor</a></li>
                          <li><a href="simple-MDE.html">MDE editor</a></li>
                          <li><a href="ace-code-editor.html">ACE code editor</a></li>
                        </ul>
                      </li>
                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="sunrise"> </i><span>Knowledgebase</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="knowledgebase.html">Knowledgebase</a></li>
                          <li><a href="knowledge-category.html">Knowledge category</a></li>
                          <li><a href="knowledge-detail.html">Knowledge detail              </a></li>
                        </ul>
                      </li> -->
                      <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="support-ticket.html"><i data-feather="users"> </i><span>Support Ticket</span></a></li> -->
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>