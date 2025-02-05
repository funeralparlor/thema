@extends('layouts.dashboard')

@section('title', 'Add New Student')

@section('content')
<div class="container px-6 mx-auto">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Add Student</h1>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    <span class="text-red-800 font-medium">Please correct the following errors:</span>
                </div>
                <ul class="list-disc list-inside text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Import Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="border-b pb-4 mb-4">
                <h2 class="text-lg font-medium text-gray-800">Import Students</h2>
                <p class="text-sm text-gray-600 mt-1">Upload an Excel file to import multiple students at once.</p>
            </div>

            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="flex items-center space-x-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Excel File</label>
                        <div class="flex items-center">
                            <input type="file" 
                                   name="excel_file" 
                                   accept=".xlsx,.xlsm"
                                   required
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200 flex items-center">
                        <i class="fas fa-file-import mr-2"></i>
                        Import
                    </button>
                </div>
                <div class="text-sm text-gray-500">
                    <p>File must contain columns: Student Name, Semester, Course, Scholarship Name</p>
                    <a href="{{ route('students.template') }}" class="text-blue-600 hover:text-blue-700 inline-flex items-center mt-1">
                        <i class="fas fa-download mr-1"></i>
                        Download template
                    </a>
                </div>
            </form>
        </div>

        <!-- Manual Entry Form -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="border-b pb-4 mb-6">
                <h2 class="text-lg font-medium text-gray-800">Manual Entry</h2>
                <p class="text-sm text-gray-600 mt-1">Add a single student manually using the form below.</p>
            </div>

            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Student Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Student Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           required 
                           class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                           placeholder="Enter student name">
                </div>

                <!-- Semester -->
                <div class="space-y-2">
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                    <input type="text" 
                           id="semester" 
                           name="semester" 
                           required 
                           class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                           placeholder="Enter semester">
                </div>

                <!-- Course -->
                <div class="space-y-2">
                    <label for="course" class="block text-sm font-medium text-gray-700">Course</label>
                    <input type="text" 
                           id="course" 
                           name="course" 
                           required 
                           class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                           placeholder="Enter course name">
                </div>

                <!-- Scholarship Name -->
                <div class="space-y-2">
                    <label for="scholarship_name" class="block text-sm font-medium text-gray-700">Scholarship Name</label>
                    <input type="text" 
                           id="scholarship_name" 
                           name="scholarship_name" 
                           required 
                           class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                           placeholder="Enter scholarship name">
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end pt-4">
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        Add Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection