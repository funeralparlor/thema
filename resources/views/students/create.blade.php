@extends('layouts.dashboard')

@section('title', 'Add New Student')

@section('content')
<class="container">
    <h1>Add Student</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="text" class="form-control" id="semester" name="semester" required>
                    </div>

                    <div class="mb-3">
                        <label for="course" class="form-label">Course</label>
                        <input type="text" class="form-control" id="course" name="course" required>
                    </div>

                    <div class="mb-3">
                        <label for="scholarship_name" class="form-label">Scholarship Name</label>
                        <input type="text" class="form-control" id="scholarship_name" name="scholarship_name" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Student</button>
                    
            </form>

</div>
@endsection
