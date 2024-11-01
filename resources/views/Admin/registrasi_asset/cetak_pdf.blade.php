<!DOCTYPE html>
<html>
<head>
    <title>QR Code PDF</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <h1>Asset Information</h1>
    <p>Register Code: {{ $data->register_code }}</p>
    <p>Asset Name: {{ $data->asset_name }}</p>
    
    {{-- Include QR Code --}}
    <img src="{{ asset($data->qr_code_path) }}" alt="QR Code" />

    {{-- Add any additional information you want to display --}}
</body>
</html>