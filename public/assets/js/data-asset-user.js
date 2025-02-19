$(document).ready(function() {

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
        "ajax": {
            "url": "/admin/ajax_data_asset",
            "type": "GET",
            "dataSrc": ""
        },
        "columns": [
            {
              "data": "null",
              "render" : function(data, type, row, meta) {
                return meta.row + 1;
              }
            },
            {
                "data": "qr_code_path",
                "render": function(data, type, row) {
                    if (data) {
                        return `<img src="${data}" alt="QR Code" style="width: 150px; height: 150px;">`;
                    } else {
                        return 'No QR Code';
                    }
                }
            },
            {"data": "asset_code"},
            {
              "data" : "asset_status",
              "render" : function (data, type, row) {
                let color, bgColor;
                if (data === "PRIORITY") {
                  bgColor = 'red';
                  color = 'white'
              
                } else if (data === "NOT PRIORITY") {
                  bgColor = 'yellow';
                  color = 'black';

                } else if (data === "BASIC") {
                  bgColor = 'green';
                  color = 'white';
              
                }
                return `<span style="display: inline-block; padding: 5px 10px; background-color: ${bgColor}; border-radius: 4px; color: ${color};">${data}</span>`;
              }
            
            },
            {"data": "asset_model"},
            {
              "data" : "null",
                "render": function(data, type, row) {
                    return `
                        <button class="btn btn-warning btn-sm update-btn" data-id="${row.asset_id}" data-toggle="modal" data-target="#editDataAsset">Update</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${row.asset_id}">Delete</button>
                        <button class="btn btn-primary btn-sm detail-btn" data-id="${row.asset_id}" data-toggle="modal" data-target="#detailDataAsset">Detail Barang Asset</button>
                        <a href="${row.qr_code_path}" download="QRCode_${row.asset_code}.png" class="btn btn-success btn-sm">Download QR Code</a>
                    `;
                }
            },
        ]
    });



//     //add data asset
// $(document).ready(function() {
//   $('#saveAssetButton').click(function(e) {
//     e.preventDefault(); // Prevent the form from submitting the traditional way

//     // SweetAlert confirmation
//     Swal.fire({
//       title: 'Are you sure?',
//       text: "Do you want to save this asset?",
//       icon: 'warning',
//       showCancelButton: true,
//       confirmButtonText: 'Yes, save it!',
//       cancelButtonText: 'No, cancel!',
//       reverseButtons: true
//     }).then((result) => {
//       if (result.isConfirmed) {
//         // If confirmed, submit the form via AJAX
//         $.ajax({
//           url: '/admin/add_data_asset',
//           type: 'POST',
//           data: $('#addAssetForm').serialize(), // Serialize form data
//           success: function(response) {
//             // Show success message
//             Swal.fire(
//               'Saved!',
//               'The asset has been added.',
//               'success'
//             ).then(() => {
//               // Hide the modal after SweetAlert success confirmation
//               $('#addDataAsset').modal('hide');
//             });
//             $('#addAssetForm')[0].reset(); // Clear the form
//             newSetAssetCode();
//             $('#coba').DataTable().ajax.reload(); // Reload the DataTable
//           },
//           error: function(xhr, status, error) {
//             // Show error message
//             Swal.fire(
//               'Error!',
//               'Failed to add the asset: ' + error,
//               'error'
//             );
//           }
//         });
//       } else if (result.dismiss === Swal.DismissReason.cancel) {
//         Swal.fire(
//           'Cancelled',
//           'The asset was not saved',
//           'error'
//         );
//       }
//     });
//   });
// });


//     //get detail data
//     $('#coba').on('click', '.update-btn', function() {
//       var assetId = $(this).data('id');

//       $.ajax({
//           url: `/admin/get_detail_data_asset/${assetId}`,
//           type: "GET",
//           success: function(data) {
//             $('#updateForm [name="asset_id"]').val(data.asset_id);
//             $('#updateForm [name="asset_code"]').val(data.asset_code);
//             $('#updateForm [name="asset_model"]').val(data.asset_model);
//             $('#updateForm [name="asset_status"]').val(data.asset_status).change();

//             $('#updateModal').modal('show');
//           }
//       });
//     });

//     //update data
//     $('#updateForm').on('submit', function(e){
//       e.preventDefault();

//       $.ajax({
//           url: '/admin/update_data_asset',
//           type: "POST",
//           data: $(this).serialize(),
//           success: function(response) {
//             Swal.fire(
//               'Updated!',
//               'Data Berhasil Terupdate',
//               'success'
//             );
//             table.ajax.reload();
//             $('#updateModal').modal('hide');
//           },
//           error: function(xhr, status, error) {
//             Swal.fire(
//               'Error',
//               'Ada kesalahan ketika update data asset',
//               'error'
//             )
//           }
//       });
//     });


//     // delete data
//     $('#coba').on('click', '.delete-btn', function(){
//         var assetId = $(this).data('id');
//         console.log("Asset ID:", assetId);

//         if (!assetId) {
//             Swal.fire(
//                 'Error!',
//                 'Asset ID is not defined.',
//                 'error'
//             );
//             return;
//         }

//         Swal.fire({
//             title: 'Are you sure?',
//             text: "You won't be able to revert this!",
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'Yes, delete it!'
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: `/admin/delete_data_asset/${assetId}`,
//                     type: 'DELETE',
//                     success: function(response) {
//                         Swal.fire(
//                             'Deleted!',
//                             'Your asset has been deleted.',
//                             'success'
//                         );
                    
//                         table.ajax.reload(); 
//                     },
//                     error: function(xhr, status, error) {
//                         Swal.fire(
//                             'Error!',
//                             'There was an error deleting the asset.',
//                             'error'
//                         );
//                     }
//                 });
//             }
//         });
//     });


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
            statusBgColor = 'green';
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
            modalHeader.addClass('bg-success'); // Green for BASIC
        }
    
        // Show the modal
        $('#detailDataAsset').modal('show');
    });    
});