var table = $('#coba').DataTable({
    scrollX: true,
    "ajax": {
        "url": "/admin/get-stock-opname",
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
        {"data": "nama_barang"},
        {"data": "barang_in"},
        {"data": "barang_out"},
        {"data": "barang_stock_opname"},
        {"data": "total_barang_in"},
        {"data": "total_barang_out"},
        {"data": "total_stock_opname"}
    ]
});