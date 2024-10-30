<!DOCTYPE html>
<html>
<head>
    <title>Asset Details</title>
</head>
<body>
    <h1>Asset Details</h1>
    <p><strong>Data Registrasi Code:</strong> {{ $asset->register_code }}</p>
    <p><strong>Asset Name:</strong> {{ $asset->asset_name }}</p>
    <p><strong>Status:</strong> {{ $asset->status }}</p>
    <!-- Add other asset details as necessary -->
    <a href="{{ url('/admin/registrasi_asset/lihat_data_registrasi_asset') }}">Back to Asset List</a>
</body>
</html>
