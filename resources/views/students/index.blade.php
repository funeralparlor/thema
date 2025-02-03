@extends('layouts.dashboard')

@section('title', 'Scholarship Students')

@section('content')

<div class="container">
    <div class=" justify-content-between align-items-center mb-4">
        <h1>Scholarship Students</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Student
        </a>
        <a href="{{ route('students.export.csv') }}" class="btn btn-primary">
            <i class="fas fa-download me-2"></i> CSV
        </a>
        <a href="{{ route('students.export.pdf') }}" class="btn btn-primary">
            <i class="fas fa-download me-2"></i> PDF
        </a>
    </div>
  
    

    @if($students->isEmpty())
    <div class="alert alert-info">No Students Found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <theahd class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Semester</th>
                        <th>Course</th>
                        <th>Scholarship</th>
                        <th>Actions</th>
                    </tr>

                </theahd>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->semester }}</td>
                        <td>{{ $student->course }}</td>
                        <td>{{ $student->scholarship_name }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--Pagination-->
<div class="d-flex justify-content-center">
    {{ $students->links() }}
</div>
@endif
</div>

@endsection