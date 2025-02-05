@extends('layouts.dashboard')

@section('title', 'Edit Student')

@section('content')
<div class="container px-6 mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Student</h2>
        
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $student->name) }}"
                           class="w-full px-4 py-2 border rounded-lg @error('name') border-red-500 @enderror">
                    @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Semester Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                    <input type="text" name="semester" value="{{ old('semester', $student->semester) }}"
                           class="w-full px-4 py-2 border rounded-lg @error('semester') border-red-500 @enderror">
                    @error('semester')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Course Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Course</label>
                    <input type="text" name="course" value="{{ old('course', $student->course) }}"
                           class="w-full px-4 py-2 border rounded-lg @error('course') border-red-500 @enderror">
                    @error('course')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Scholarship Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Scholarship</label>
                    <input type="text" name="scholarship_name" value="{{ old('scholarship_name', $student->scholarship_name) }}"
                           class="w-full px-4 py-2 border rounded-lg @error('scholarship_name') border-red-500 @enderror">
                    @error('scholarship_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('students.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Update Student
                </button>
            </div>
        </form>
    </div>
</div>
@endsection