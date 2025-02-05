<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Scholarship Students Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        .subtitle {
            font-size: 18px;
            margin: 10px 0;
        }
        .date {
            font-size: 14px;
            margin: 20px 0;
            color: #666;
        }
        .filter-info {
            margin: 20px 0;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .page-number {
            text-align: right;
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/bulsu.png') }}" alt="BulSU Logo" class="logo">
        <div class="title">Bulacan State University</div>
        <div class="subtitle">Scholarship Students Report</div>
        <div class="date">Generated on: {{ date('F d, Y h:i A') }}</div>
    </div>

    <!-- Filter Information -->
    <div class="filter-info">
    
    @if($request->semester)
        Semester: {{ $request->semester }}<br>
    @endif
    @if($request->course)
        Course: {{ $request->course }}<br>
    @endif
    @if(!$request->search && !$request->semester && !$request->course)
        No filters applied - Showing all students
    @endif
</div>

    <!-- Students Table -->
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Semester</th>
                <th>Course</th>
                <th>Scholarship Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->semester }}</td>
                <td>{{ $student->course }}</td>
                <td>{{ $student->scholarship_name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Summary Section -->
    <div class="summary">
        <p><strong>Total Students:</strong> {{ $students->count() }}</p>
        @if(request('semester'))
        <p><strong>Students in {{ request('semester') }}:</strong> {{ $students->where('semester', request('semester'))->count() }}</p>
        @endif
        @if(request('course'))
        <p><strong>Students in {{ request('course') }}:</strong> {{ $students->where('course', request('course'))->count() }}</p>
        @endif
    </div>

    <div class="footer">
        <p>This is an official document of Bulacan State University</p>
        <p>City of Malolos, Bulacan</p>
    </div>

    <div class="page-number">
        Page <span class="pagenum"></span>
    </div>
</body>
</html>