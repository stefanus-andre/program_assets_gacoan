<!DOCTYPE html>
<html>
<head>
    <title>Asset Data QR Codes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .label-container {
                width: 360px; /* Adjust to fit within A7 width */
                height: 146px; /* Adjust to fit within A7 height */
                margin: 0 auto;
                border: 1px solid #ccc;
                padding: 0px;
                border-radius: 0px;
                box-shadow: 0 0px 0px rgba(0, 0, 0, 0.1);
                position: relative;
                bottom: 20px;
                right: 50px;
            }

            .qr-section {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0px;
                width: 100%;
            }

            .qr-code {
                width: 60px; /* Adjust as needed */
                height: 60px; /* Adjust as needed */
                border: 1px solid #ddd;
                position: relative;
                top: 13px;
                left: 15px;
            }

            .asset-details {
                text-align: left;
                font-size: 10px; /* Adjust to fit text */
            }

        .asset-code, .asset-name, .dimensions, .custom-text {
            font-size: 8px;
            margin: 0 0 2px 0;
            font-family: monospace;
            position: relative;
            bottom: 40px;
            text-align: right;
            right: 4px;
        }
        .location {
            font-size: 8px;
            font-weight: bold;
            text-align: center;
            position: relative;
            bottom: 15px;
        }
        .company {
            font-size: 6px;
            text-align: center;
            position: relative;
            bottom: 15px;
        }
        .footer-note {
            position: relative;
            font-size: 5px;
            color: #666;
            bottom: -4px;
            left: 2px;
        }

    </style>
</head>
<body>
    @foreach ($data as $item)
    <div class="label-container">
        <div class="qr-section">
            @if (!empty($item->qr_code_path))
                <img src="{{ $item->qr_code_path }}" alt="QR Code for {{ $item->asset_name }}" class="qr-code" />
            @else
                <div class="qr-code">
                    <p style="text-align: center; color: #999;">No QR code available</p>
                </div>
            @endif

            <div class="asset-details">
                <p class="asset-code"><b>Asset Tag: {{ $item->register_code }}</b></p>
                <p class="asset-name"><b>Asset Name: {{ $item->asset_model }}</b></p>
                <p class="dimensions">Dimensions: {{ $item->width }} x {{ $item->height }} x {{ $item->depth }}</p>
            </div>
        </div>

        <div class="location">{{ $item->name_store_street }}</div>
        <div class="company">PT. Pesta Pora Abadi</div>

        <p class="footer-note">
            Label Jangan Sampai Hilang, Rusak, atau Terhapus.<br>
            Segera Hubungi Head Office, Untuk Penerbitan Label Baru.
        </p>
    </div>
    @endforeach
</body>
</html>
