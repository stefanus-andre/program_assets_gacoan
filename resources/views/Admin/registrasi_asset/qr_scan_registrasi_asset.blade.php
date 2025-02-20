<!-- resources/views/Admin/registrasi_asset/qr_scan_registrasi_asset.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Asset Details</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .asset-details {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .qr-code {
            text-align: center;
            margin: 20px 0;
        }
        .qr-code img {
            max-width: 180px;
            height: auto;
        }
        .back-button {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px; 
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Asset Details</h1>
        
        <div class="qr-code">
            <img src="{{ asset('/public/qrcodes/' . $asset->register_code . '.png') }}" alt="QR Code for {{ $asset->register_code }}">
        </div>

        <div class="asset-details">
            <p><strong>Data Registrasi Code : </strong> {{ $asset->register_code }}</p>
            <p><strong>Asset Name           : </strong> {{ $asset->asset_model }}</p>
            <p><strong>Priority             : </strong> {{ $asset->priority_name }}</p>
            <p><strong>Location             : </strong> {{ $asset->name_store_street }}</p>
            <p><strong>Dimensions           : </strong> {{ $asset->width }} x {{ $asset->height }} x {{ $asset->depth }}</p>
            <!-- Add other asset details as needed -->
        </div>

        <a href="{{ url('/admin/registrasi_asset/lihat_data_registrasi_asset') }}" class="back-button">
            Back to Asset List
        </a>
    </div>
</body>
</html>