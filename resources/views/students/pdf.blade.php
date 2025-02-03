<!DOCTYPE html>
<html>
<head>
    <title>Scholarship Students Export</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <h2>Bulacan State University Scholarship Students</h2>
    <p>Generated on: {{ date('Y-m-d H:i:s') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
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
</body>
</html>