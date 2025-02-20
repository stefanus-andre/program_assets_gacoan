<!DOCTYPE html>
<html lang="en">
    <title>Asset Disposal & Recondition Form</title>
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
        <div class="asset-center">Asset Disposal & Recondition Form</div>
    </div>

    <!-- Content Section -->
    <div class="content">
    <table>
    <tr>
        <td style="background-color: grey; color:white">Origin Site</td>
        <td style="background-color: #B7B7B7">
        {{ $firstRecord->origin_site }} - {{ $firstRecord->origin_site }}
        </td>
        <td style="background-color: grey; color:white">Purpose</td>
        <td style="background-color: #B7B7B7">Dispose</td>
        <td style="background-color: grey; color:white">Request Date</td>
        <td style="background-color: #B7B7B7">{{ $firstRecord->out_date }}</td>
    </tr>
    <tr>
        <!-- <td style="background-color: grey; color:white">Destination Site</td>
        <td style="background-color: #B7B7B7">
        
        </td> -->
        <td colspan="4"></td>
        <td style="background-color: grey; color:white">Disposal Ref Code</td>
        <td style="background-color: #B7B7B7">{{ $firstRecord->out_id }}</td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: right; font-style: italic;">
             fill by Asset Management
        </td>
    </tr>
</table>


        <br>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Asset ID</th>
                    <th>Asset Description</th>
                    <th>Asset Category</th>
                    <th>Asset Serial Part</th>
                    <th>Movement Type</th>
                    <th>Asset Condition<br>(Good / Bad)</th>
                    <th>Additional Note</th>
                </tr>
            </thead>
            <tbody>

            @php $no=1; @endphp
            @foreach ($data as $index => $record)
            <tr>
            <td>{{$no++}}</td>
                <td>{{ $record->register_code}}</td>
                <td>{{ $record->asset_model}}</td>
                <td>{{ $record->condition_name}}</td>
                <td>{{ $record->serial_number}}</td>
                <td>{{ $record->reason_name}}</td>
                <td>{{ $record->condition_name}}</td>
                <td>{{ $record->out_desc}}</td>
                
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>

    <br>
    <br>
    <br>
    <!-- Footer Section -->
    <div class="footer mt-5">
        <table class="signatures">
            <tr>
                <td>Prepared by (Sender)
                    <br><br><br>
                    @if($firstRecord->appr_1 == 3)
                        Approve
                    @else
                        <!-- Not Yet -->
                    @endif
                    <br><br><br>Approve By System<br>Date<br>Store Manager
                </td>
                <td>Approved by
                    <br><br><br>
                    @if($firstRecord->appr_2 == 3)
                        Approve
                    @else
                        <!-- Not Yet -->
                    @endif
                    <br><br><br>Approve By System<br>Date<br>AM / RM
                </td>
            
                <td>Asset Verificator
                    <br><br><br>
                    @if($firstRecord->appr_1 == 3)
                        Approve
                    @else
                        <!-- Not Yet -->
                    @endif
                    <br><br><br>Name<br><br>Head of Category Division
                </td>
                <td>Verified by
                    <br><br><br>
                    @if($firstRecord->appr_1 == 3)
                        Approve
                    @else
                        <!-- Not Yet -->
                    @endif
                    <br><br>
                    <br>Approve By System
                    <br>Date
                    <br>Asset Management
                </td>
            </tr>
            <tr class="footer-row" style="font-style: italic;">
                <td>Store Level</td>
                <td>AM/RM</td>
                <!-- <td style="font-style: italic;"></td> -->
                <td>Asset Category Division</td>
                <td>Asset Division</td>
            </tr>
        </table>
    </div>
    <br>
</body>
</html>