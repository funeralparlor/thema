@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4">
   

<!--Filtering section-->

<div class="flex justify-end mb-6">

        <form action=" {{ route('dashboard') }}" method="GET" class="flex items-center space-x-4">
                <select name="sort" class="px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="all" {{ request('sort') == 'all' ? 'selected' : ''}}> Choose Filter</option>
                        <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Highest to Lowest</option>
                        <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : ''}}> Lowest to Highest</option>
                        

                        
                </select>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                                                    Apply Filter
                    </button>
                    <a href=" {{ route('students.index') }}"  class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                                                    Show List
</a>

        </form>
     
</div>


    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Students by Semester</h3>
            </div>
            <div class="p-4">
                <canvas id="semesterChart" class="w-full" style="height: 250px;"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Students by Course</h3>
            </div>
            <div class="p-4">
                <canvas id="courseChart" class="w-full" style="height: 250px;"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Latest Students Added</h3>
            </div>
            <div class="divide-y">
                @forelse($latestStudents as $student)
                    <div class="p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold">{{ $student->name }}</p>
                                <p class="text-sm text-gray-600">{{ $student->course }} - {{ $student->semester }}</p>
                            </div>
                            <span class="px-3 py-1 bg-blue-500 text-white rounded-full text-sm">
                                {{ $student->scholarship_name }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-gray-500">No students found.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Scholarship</h3>
            </div>
            <div class="p-4">
                @if($popularScholarship)
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-xl font-semibold text-gray-800">{{ $popularScholarship->name }}</h4>
                                <p class="text-gray-600">{{ $popularScholarship->description }}</p>
                            </div>
                            <div class="text-3xl text-yellow-500">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Total Recipients</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $popularScholarship->recipients_count }}</p>
                                </div>
                                
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center space-x-2">
                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                    <div 
                                        class="bg-yellow-500 h-2 rounded-full" 
                                        style="width: {{ ($popularScholarship->recipients_count / $totalStudents) * 100 }}%">
                                    </div>
                                </div>
                                <span class="text-sm text-gray-600">
                                    {{ round(($popularScholarship->recipients_count / $totalStudents) * 100) }}% of students
                                </span>
                            </div>
                        </div>
                        <a href=" {{ route('students.index') }}" class="block text-center bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg transition-colors mt-4">
                            View Details <i class="fas fa-arrow-circle-right ml-1"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center text-gray-500 py-8">
                        <i class="fas fa-award text-4xl mb-2"></i>
                        <p>No scholarship data available</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
</div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    // Students by Semester Chart
    const semesterChart = new Chart(document.getElementById('semesterChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($studentsBySemester->pluck('semester')) !!},
            datasets: [{
                label: 'Students',
                data: {!! json_encode($studentsBySemester->pluck('count')) !!},
                backgroundColor: '#3B82F6',
                borderColor: '#2563EB',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Students by Course Chart
    const courseChart = new Chart(document.getElementById('courseChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($studentsByCourse->pluck('course')) !!},
            datasets: [{
                data: {!! json_encode($studentsByCourse->pluck('count')) !!},
                backgroundColor: [
                    '#EF4444',
                    '#3B82F6',
                    '#F59E0B',
                    '#10B981',
                    '#6366F1',
                    '#8B5CF6'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection