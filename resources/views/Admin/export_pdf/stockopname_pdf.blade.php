<!DOCTYPE html>
<html>
<head>
    <title>Stock Opname Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Stock Opname Report</h1>
    <table>
        <thead>
            <tr>
                <th>Opname ID</th>
                <th>Opname Localion</th>
                <th>Description</th>
                <th>Created By</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($opnames as $opname)
                <tr>
                    <td>{{ $opname->opname_id }}</td>
                    <td>{{ $opname->loc_id }}</td>
                    <td>{{ $opname->opname_desc }}</td>
                    <td>{{ $opname->create_by }}</td>
                    <td>{{ $opname->create_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
