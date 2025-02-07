<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Total Students
        $totalStudents = Student::count();

        // Total Scholarships (distinct count)
        $totalScholarships = Student::distinct('scholarship_name')->count();

        // Students by Semester with proper ordering
        $studentsBySemester = Student::selectRaw('semester, count(*) as count')
            ->groupBy('semester')
            ->take(5);
            

        // Students by Course
        $studentsByCourse = Student::selectRaw('course, count(*) as count')
            ->groupBy('course')
            ->take(5);
        


                    // Sorting for the filter
        $sort = $request->get('sort', ' highest');
            if ($sort === 'highest') {
                $studentsBySemester->orderBy('count', 'desc');
                $studentsByCourse->orderBy('count', 'desc');
            } elseif ($sort === 'lowest') {
                $studentsBySemester->orderBy('count', 'asc');
                $studentsByCourse->orderBy('count', 'asc');
            }

            $studentsBySemester = $studentsBySemester->get();
            $studentsByCourse = $studentsByCourse->get();

        // Selected Semester and Course (for widgets)
        $selectedSemester = $studentsBySemester->first()->semester ?? 'N/A';
        $selectedCourse = $studentsByCourse->first()->course ?? 'N/A';

        // Latest Students Added - Removed the with() call since relationships aren't defined
        $latestStudents = Student::latest()
            ->take(5)
            ->get();

        // Enhanced Most Popular Scholarship data
        $popularScholarship = Student::select('scholarship_name')
            ->selectRaw('COUNT(*) as recipients_count')
            ->groupBy('scholarship_name')
            ->orderByDesc('recipients_count')
            ->first();

        if ($popularScholarship) {
            // Transform the popular scholarship data to match the view expectations
            $popularScholarship = (object) [
                'name' => $popularScholarship->scholarship_name,
                'description' => $this->getScholarshipDescription($popularScholarship->scholarship_name),
                'recipients_count' => $popularScholarship->recipients_count,
                'amount' => $this->getScholarshipAmount($popularScholarship->scholarship_name),
            ];
        }

        return view('dashboard.index', compact(
            'totalStudents',
            'totalScholarships',
            'studentsBySemester',
            'studentsByCourse',
            'selectedSemester',
            'selectedCourse',
            'latestStudents',
            'popularScholarship'
        ));
    }

    /**
     * Get the description for a scholarship
     * You might want to replace this with actual data from your database
     */
    private function getScholarshipDescription($scholarshipName)
    {
        // This is a placeholder - you should implement this based on your data structure
        return "Total Students that have " . $scholarshipName;
    }

    /**
     * Get the amount for a scholarship
     * You might want to replace this with actual data from your database
     */
    private function getScholarshipAmount($scholarshipName)
    {
        // This is a placeholder - you should implement this based on your data structure
        return rand(5000, 15000); // Replace with actual scholarship amount from your database
    }
}