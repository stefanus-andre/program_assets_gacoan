<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }
        .header, .content, .footer {
            width: 100%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header .title {
            font-weight: bold;
            font-size: 12px;
        }
        .header table {
            width: 100%;
            margin-bottom: 10px;
        }
        .header table td {
            padding: 2px;
        }
        .content table, .footer table {
            width: 100%;
            border-collapse: collapse;
        }
        .content table th, .content table td, .footer table td {
            border: 1px solid #000;
            padding: 3px;
            text-align: center;
        }
        .footer .signatures td {
            padding-top: 20px;
        }
        .signatures {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Agar kolom memiliki lebar tetap */
        }
        .signatures td {
            padding: 10px;
            vertical-align: top;
            text-align: center;
            font-size: 12px;
            border: 1px solid #ddd;
        }
        /* Baris footer tetap di dalam tabel yang sama, tanpa border */
        .footer-row td {
            padding: 5px;
            font-size: 12px;
            border: none; /* Menghilangkan border */
        }
        .header {
            margin: 20px;
        }

        .pt-left {
            text-align: left;
        }

        .doc-info {
            text-align: right;
        }

        .doc-info td {
            padding: 5px 0;
        }

        .asset-center {
            text-align: center;
            font-weight: bold;
            margin-top: 30px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <!-- PT. Pesta Pora Abadi (Left Aligned) -->
        <div class="pt-left">
        <img src="{{asset('assets/images/image-removebg-preview.png')}}" alt="logo_image" style="width:150px; height:80px; position:relative; right:3rem;">
        </div>
        <div class="pt-left">JL. S. Supriyadi No. 74, Kec. Sukun, Kota Malang</div>
        <div class="pt-left">Telp : (0341) 3018555</div>
    
        <!-- Document Info (Right Aligned) -->
        <div class="doc-info">Doc. Version - Ver. 01</div>
        <div class="doc-info">Doc. Date - 2024.09</div>
    
        <!-- Asset Movement Form (Centered) -->
        <div class="asset-center">Stock Opname Form</div>
    </div>

    <!-- Content Section -->
    <div class="content">
    <table>
    <tr>
        <td style="background-color: grey; color:white">Origin Site</td>
        <td style="background-color: #B7B7B7">
            {{ $firstRecord->origin_site }} - {{ $firstRecord->origin_site }}
        </td>
        <td style="background-color: grey; color:white">Stock Opname</td>
        <td style="background-color: #B7B7B7">{{$firstRecord->reason_name}}</td>
        <td style="background-color: grey; color:white">Stock Opname Date</td>
        <td style="background-color: #B7B7B7">{{ $firstRecord->opname_date }}</td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center; font-style: italic;">
            Leave Blanks if Disposal Asset, fill by Asset Management
        </td>
    </tr>
</table>


        <br>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Asset ID</th>
                    <th>Asset Description</th>
                    <th>Asset Category</th>
                    <th>Asset Serial Part</th>
                    <th>Movement Type</th>
                    <th>Asset Condition<br>(Good / Bad)</th>
                    <th>Qty On Hands</th>
                    <th>Qty Physical</th>
                    <th>Additional Note</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($opnames as $index => $record)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $record->register_code }}</td>
                <td>{{ $record->asset_model }}</td>
                <td>{{ $record->cat_name }}</td>
                <td>{{ $record->serial_number }}</td>
                <td>{{ $record->reason_name }}</td>
                <td>{{ $record->condition_name }}</td>
                <td>{{ $record->qty_onhand }}</td>
                <td>{{ $record->qty_physical }}</td>
                <td>{{ $record->opname_desc }}</td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>

    <br>
    <br>
    <br>
    <!-- Footer Section -->
 
    <br>
</body>
</html>