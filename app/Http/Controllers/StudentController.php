<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->paginate(10);
        return view('students.index', compact ('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

        
        'name' => 'required|string|max:255',
        'semester' => 'required|string|max:255',
        'course' => 'required|string|max:255',
        'scholarship_name' => 'required|string|max:255' 
        ]);
    


    /**
     * 
     * Display the specified resource.
     */

     Student::create($validated);

     return redirect()->route('dashboard')->with('success', 'Student added successfully!');
}


    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    public function exportCSV()
{
    $students = Student::all();
    $fileName = 'students_' . date('Y-m-d') . '.csv';

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    $callback = function() use ($students) {
        $file = fopen('php://output', 'w');
        
        // Add CSV header
        fputcsv($file, [
            'Name', 
            'Semester', 
            'Course', 
            'Scholarship Name',
        ]);

        // Add data rows
        foreach ($students as $student) {
            fputcsv($file, [
                $student->name,
                $student->semester,
                $student->course,
                $student->scholarship_name,
               
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

public function exportPDF()
{
    $students = Student::all();
    $pdf = Pdf::loadView('students.pdf', compact('students'));
    return $pdf->download('students_' . date('Y-m-d') . '.pdf');
}

}
