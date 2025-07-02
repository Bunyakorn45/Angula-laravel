<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Preview XML Data</title>
</head>
<body>
    <h1>Preview XML Data</h1>
    @if(session('error'))
        <div style="color:red">{{ session('error') }}</div>
    @endif

    @if(count($rows))
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    @foreach(array_keys($rows[0]) as $col)
                        <th>{{ $col }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{{ is_array($cell) ? json_encode($cell) : $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ url('/xml') }}" method="POST" enctype="multipart/form-data" style="margin-top:20px;">
            @csrf
            <input type="hidden" name="xml_file" value="{{ request()->file('xml_file')->getRealPath() }}">
            <button type="submit">Download as Excel</button>
        </form>
    @else
        <p>ไม่พบข้อมูล</p>
    @endif
    <br>
    <a href="{{ url('/xml-form') }}">Back</a>
</body>
</html>