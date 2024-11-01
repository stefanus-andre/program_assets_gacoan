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
  
      var table = $('#coba').DataTable({
        scrollX: true,
        "ajax": {
            "url": "/admin/registrasi_asset/get_data_registrasi_asset",
            "type": "GET",
            "dataSrc": ""
        },
        "columns": [
            {
                "data": "null",
                "render": function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                "data": "qr_code_path",
                "render": function(data, type, row) {
                    if (data) {
                        var assetUrl = `/assets/details/${row.register_code}`;
                        return `<a href="${assetUrl}" target="_blank"><img src="${data}" alt="QR Code" style="width: 150px; height: 150px;"></a>`;
                    } else {
                        return 'No QR Code';
                    }
                }
            },
            {"data": "register_code"},
            {"data": "asset_name"},
            {"data": "serial_number"},
            {"data": "type_asset"},
            {"data": "category_asset"},
            {"data": "prioritas"},
            {"data": "merk"},
            {"data": "qty"},
            {"data": "satuan"},
            {"data": "register_location"},
            {"data": "layout"},
            {"data": "register_date"},
            {"data": "supplier"},
            {
                "data": "status",
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
            {"data": "purchase_number"},
            {"data": "purchase_date"},
            {"data": "warranty"},
            {"data": "periodic_maintenance"},
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
                "data" : "approve_status",
            },
            {
                "data": "null",
                "render": function(data, type, row) {
                    // Show the "Submit Approve" button only if approve_status is not "sudah approve"
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
                            <a class="dropdown-item" href="{{ route('generate.pdf', $row->register_code) }}" target="_blank">Cetak QR Code</a>
                            <button class="dropdown-item detail-btn" data-id="${row.id}" data-toggle="modal" data-target="#detailDataAsset">Detail Barang Asset</button>
                            <button class="dropdown-item update-btn" data-id="${row.id}" data-toggle="modal" data-target="#editDataAsset">Update</button>
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
                $('#edit-register_location').val(data.register_location).get();
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
  
          var statusBgColor;
          if (rowData.status === 'PRIORITY') {
              statusBgColor = 'red';
          } else if (rowData.status === 'NOT PRIORITY') {
              statusBgColor = 'yellow';
          } else if (rowData.status === 'BASIC') {
              statusBgColor = 'blue';
          }
  
          $('#assetDetails').html(
              'Asset Code: ' + rowData.register_code + '<br>' +
              'Model: ' + rowData.asset_name + '<br>' +
                'Status: <span style="display: inline-block; padding: 5px 10px; background-color: ' + statusBgColor + '; color: ' + (statusBgColor === 'yellow' ? 'black' : 'white') + '; border-radius: 4px;">' + rowData.status + '</span>'
          );
      
          // Change modal color based on the status
          var modalHeader = $('#detailDataAsset .modal-header');
          modalHeader.removeClass('bg-danger bg-warning bg-success'); // Remove any previous color classes
      
          if (rowData.status === 'PRIORITY') {
              modalHeader.addClass('bg-danger'); // Red for PRIORITY
          } else if (rowData.status === 'NOT PRIORITY') {
              modalHeader.addClass('bg-warning'); // Yellow for NOT PRIORITY
          } else if (rowData.status === 'BASIC') {
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



    $(document).ready(function(){
            // Fetch regions and populate the dropdown
            $.ajax({
                url: '/admin/get-region', // Route to fetch regions
                method: 'GET',
                success: function(data) {
                    var regionSelect = $('#region');
                    $.each(data, function(index, region) {
                        regionSelect.append($('<option>', {
                            value: region.region_name, // Assuming 'id' is the unique identifier for the region
                            text: region.region_name // Assuming 'name' is the display name of the region
                        }));
                    });
                }
            });
        
            // Event listener for dropdown change
            $('#region').change(function() {
                var selectedRegionId = $(this).val();
                
                // Optionally, you can fetch specific data based on the selected region
                if (selectedRegionId) {
                    // For example, if you want to get a specific location based on the region
                    $.ajax({
                        url: '/get-location/' + selectedRegionId, // Adjust this route as needed
                        method: 'GET',
                        success: function(locationData) {
                            $('#register_location').val(locationData.location); // Assuming locationData has a 'location' field
                        }
                    });
                } else {
                    $('#register_location').val(''); // Clear the input if no region is selected
                }
            });
        });


        $(document).ready(function(){
            // Fetch regions and populate the dropdown
            $.ajax({
                url: '/admin/get-brand', // Route to fetch regions
                method: 'GET',
                success: function(data) {
                    var regionSelect = $('#merk');
                    $.each(data, function(index, merk) {
                        regionSelect.append($('<option>', {
                            value: merk.brand_name, // Assuming 'id' is the unique identifier for the region
                            text: merk.brand_name // Assuming 'name' is the display name of the region
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
                    var regionSelect = $('#supplier');
                    $.each(data, function(index, supplier) {
                        regionSelect.append($('<option>', {
                            value: supplier.supplier_name, // Assuming 'id' is the unique identifier for the region
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
                    var regionSelect = $('#warranty');
                    $.each(data, function(index, warranty) {
                        regionSelect.append($('<option>', {
                            value: warranty.warranty_name + ' - ' + warranty.warranty_day, // Assuming 'id' is the unique identifier for the region
                            text: warranty.warranty_name + ' - ' + warranty.warranty_day // Assuming 'name' is the display name of the region
                        }));
                    });
                }
            });
        });


        $(document).ready(function(){
            $.ajax({
                url: '/get-regist',  // Ensure this matches your actual route for getAssets
                method: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        var regionSelect = $('#asset_name');
                        regionSelect.empty(); // Clear existing options
                        
                        // Loop through the assets and append them to the dropdown
                        $.each(response.data, function(index, asset) {
                            regionSelect.append($('<option>', {
                                value: asset.asset_model, // Assuming 'asset_id' is a field in MasterAsset
                                text: asset.asset_model // Assuming 'asset_model' is a field in MasterAsset
                            }));
                        });
                    } else {
                        alert('Failed to fetch assets');
                    }
                },
                error: function() {
                    alert('An error occurred while fetching assets');
                }
            });
        });

        

        $(document).ready(function(){
            // Fetch regions and populate the dropdown
            $.ajax({
                url: '/admin/get-periodic', // Route to fetch regions
                method: 'GET',
                success: function(data) {
                    var regionSelect = $('#periodic_maintenance');
                    $.each(data, function(index, periodic) {
                        regionSelect.append($('<option>', {
                            value: periodic.periodic_mtc_name, // Assuming 'id' is the unique identifier for the region
                            text: periodic.periodic_mtc_name	 // Assuming 'name' is the display name of the region
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
                            text: layout.layout_code + ' - ' + layout.layout_name // Assuming 'name' is the display name of the region
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
                            value: category.cat_code, // Assuming 'id' is the unique identifier for the region
                            text: category.cat_code + ' - ' + category.cat_name // Assuming 'name' is the display name of the region
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
                            value: prioritas.priority_code, // Assuming 'id' is the unique identifier for the region
                            text: prioritas.priority_code + ' - ' + prioritas.priority_name // Assuming 'name' is the display name of the region
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
                            text: type.type_code + ' - ' + type.type_name // Assuming 'name' is the display name of the region
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
                            value: uom.uom_name, // Assuming 'id' is the unique identifier for the region
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
                        return {
                            results: $.map(data, function(resto) {
                                return {
                                    id: resto.kode_resto + ' - ' + resto.resto + ' - ' + resto.kom_resto, // Unique ID combining fields
                                    text: resto.kode_resto + ' - ' + resto.resto + ' - ' + resto.kom_resto // Display text combining fields
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


        $(document).ready(function(){
            $.ajax({
                url: '/get-regist',  // Ensure this matches your actual route for getAssets
                method: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        var regionSelect = $('#edit-asset_name');
                        regionSelect.empty(); // Clear existing options
                        
                        // Loop through the assets and append them to the dropdown
                        $.each(response.data, function(index, asset) {
                            regionSelect.append($('<option>', {
                                value: asset.asset_model, // Assuming 'asset_id' is a field in MasterAsset
                                text: asset.asset_model // Assuming 'asset_model' is a field in MasterAsset
                            }));
                        });
                    } else {
                        alert('Failed to fetch assets');
                    }
                },
                error: function() {
                    alert('An error occurred while fetching assets');
                }
            });
        });



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
                            text: type.type_code + ' - ' + type.type_name // Assuming 'name' is the display name of the region
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
                            text: category.cat_code + ' - ' + category.cat_name // Assuming 'name' is the display name of the region
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
                            text: prioritas.priority_code + ' - ' + prioritas.priority_name // Assuming 'name' is the display name of the region
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
                            value: merk.brand_name, // Assuming 'id' is the unique identifier for the region
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
                            value: uom.uom_name, // Assuming 'id' is the unique identifier for the region
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
                        value: region.region_name, // Assuming 'id' is the unique identifier for the region
                        text: region.region_name // Assuming 'name' is the display name of the region
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
                var regionSelect = $('#edit-layout');
                $.each(data, function(index, layout) {
                    regionSelect.append($('<option>', {
                        value: layout.layout_code, // Assuming 'id' is the unique identifier for the region
                        text: layout.layout_code + ' - ' + layout.layout_name // Assuming 'name' is the display name of the region
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
                        value: supplier.supplier_name, // Assuming 'id' is the unique identifier for the region
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
                        value: warranty.warranty_name + ' - ' + warranty.warranty_day, // Assuming 'id' is the unique identifier for the region
                        text: warranty.warranty_name + ' - ' + warranty.warranty_day // Assuming 'name' is the display name of the region
                    }));
                });
            }
        });
    });


    $(document).ready(function(){
        // Fetch regions and populate the dropdown
        $.ajax({
            url: '/admin/get-periodic', // Route to fetch regions
            method: 'GET',
            success: function(data) {
                var regionSelect = $('#edit-periodic_maintenance');
                $.each(data, function(index, periodic) {
                    regionSelect.append($('<option>', {
                        value: periodic.periodic_mtc_name, // Assuming 'id' is the unique identifier for the region
                        text: periodic.periodic_mtc_name	 // Assuming 'name' is the display name of the region
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
                url: '/admin/get-resto', // Route to fetch regions
                dataType: 'json',
                delay: 250, // Delay to avoid overloading the server
                data: function(params) {
                    return {
                        search: params.term || '', // Send the search term if available, otherwise an empty string
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(resto) {
                            return {
                                id: resto.kode_resto + ' - ' + resto.resto + ' - ' + resto.kom_resto, // Unique ID combining fields
                                text: resto.kode_resto + ' - ' + resto.resto + ' - ' + resto.kom_resto // Display text combining fields
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 0
        });
    
        // Assuming `data` is a JavaScript object that contains `register_location`
        var data = {
            register_location: 'some_value' // Replace with the actual value you want to set
        };
    
        // Set the value of the select2 element and trigger change for visual update
        $('#edit-register_location').val(data.register_location).trigger('change');
    
        // Get the value of the select2 element
        var selectedValue = $('#edit-register_location').val();
        console.log('Selected value:', selectedValue);
    });
    







        





