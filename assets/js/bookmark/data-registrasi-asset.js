$(document).ready(function() {


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
    
          const assetCode = `AST-${day}-${month}-${year}-${randomCode}`;
          return assetCode;
        }
    
        function newSetAssetCode() {
          document.getElementById('asset_code').value =generateAssetCode();
        }
    
        newSetAssetCode();
  
  
        var table = $('#coba').DataTable({
          scrollX: true,
          "ajax": {
              "url": "/admin/registrasi_asset/get_data_registrasi_asset_ajax",
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
                  "data": "register_code",
              },
              {
                "data": "asset_name",
              },
              {
                "data": "serial_number"
              },
              {
                  "data": "type_asset",
              },
              {"data": "category_asset"},
              {"data": "prioritas"},
              {"data": "merk"},
              {"data": "qty"},
              {"data": "satuan"},
              {"data": "register_location"},
              {"data": "layout"},
              {"data": "register_date"},
              {"data": "supplier"},
              {"data": "purchase_number"},
              {"data": "purchase_date"},
              {"data": "warranty"},
              {"data": "periodic_maintenance"},
              {
                  "data": "null",
                  "render": function(data, type, row) {
                      return `
                          <div class="dropdown">
                              <button class="btn btn-large btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton${row.asset_id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Actions
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row.asset_id}">
                                  <a class="dropdown-item" href="${row.qr_code_path}" download="QRCode_${row.asset_code}.png">Download QR Code</a>
                                  <button class="dropdown-item detail-btn" data-id="${row.asset_id}" data-toggle="modal" data-target="#detailDataAsset">Detail Barang Asset</button>
                                  <button class="dropdown-item update-btn" data-id="${row.asset_id}" data-toggle="modal" data-target="#editDataAsset">Update</button>
                                  <button class="dropdown-item delete-btn" data-id="${row.asset_id}">Delete</button>
                              </div>
                          </div>
                          <br>
                            <div>
                              <button class="btn btn-large btn-primary btn-sm" data-id="${row.asset_id}" data-toggle="modal" data-target="#pindahAssetDetail" type="button">Pindah Barang</button>
                            </div>
                      `;
                  }
              }
          ]
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
                    newSetAssetCode();
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
      
  
      //get detail data
      $('#coba').on('click', '.update-btn', function() {
        var assetId = $(this).data('id');
  
        $.ajax({
            url: `/admin/get_detail_data_asset/${assetId}`,
            type: "GET",
            success: function(data) {
              $('#updateForm [name="asset_id"]').val(data.asset_id);
              $('#updateForm [name="asset_code"]').val(data.asset_code);
              $('#updateForm [name="asset_model"]').val(data.asset_model);
              $('#updateForm [name="asset_quantity"]').val(data.asset_quantity);
              $('#updateForm [name="asset_status"]').val(data.asset_status).change();
  
              $('#updateModal').modal('show');
            }
        });
      });
  
      //update data
      $('#updateForm').on('submit', function(e){
        e.preventDefault();
  
        $.ajax({
            url: '/admin/update_data_asset',
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
              Swal.fire(
                'Updated!',
                'Data Berhasil Terupdate',
                'success'
              );
              table.ajax.reload();
              $('#updateModal').modal('hide');
            },
            error: function(xhr, status, error) {
              Swal.fire(
                'Error',
                'Ada kesalahan ketika update data asset',
                'error'
              )
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
                      url: `/admin/delete_data_asset/${assetId}`,
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
          if (rowData.asset_status === 'PRIORITY') {
              statusBgColor = 'red';
          } else if (rowData.asset_status === 'NOT PRIORITY') {
              statusBgColor = 'yellow';
          } else if (rowData.asset_status === 'BASIC') {
              statusBgColor = 'blue';
          }
  
          $('#assetDetails').html(
              'Asset Code: ' + rowData.asset_code + '<br>' +
              'Model: ' + rowData.asset_model + '<br>' +
                'Status: <span style="display: inline-block; padding: 5px 10px; background-color: ' + statusBgColor + '; color: ' + (statusBgColor === 'yellow' ? 'black' : 'white') + '; border-radius: 4px;">' + rowData.asset_status + '</span>'
          );
      
          // Change modal color based on the status
          var modalHeader = $('#detailDataAsset .modal-header');
          modalHeader.removeClass('bg-danger bg-warning bg-success'); // Remove any previous color classes
      
          if (rowData.asset_status === 'PRIORITY') {
              modalHeader.addClass('bg-danger'); // Red for PRIORITY
          } else if (rowData.asset_status === 'NOT PRIORITY') {
              modalHeader.addClass('bg-warning'); // Yellow for NOT PRIORITY
          } else if (rowData.asset_status === 'BASIC') {
              modalHeader.addClass('bg-primary'); // Blue for BASIC
          }
      
          // Show the modal
          $('#detailDataAsset').modal('show');
      });    
  });