<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Student;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected function applyFilters($query, Request $request)
    {
        // Apply search
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('course', 'like', "%{$searchTerm}%")
                  ->orWhere('scholarship_name', 'like', "%{$searchTerm}%");
            });
        }
    
        // Apply semester filter
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
    
        // Apply course filter
        if ($request->filled('course')) {
            $query->where('course', $request->course);
        }
    
        // Apply sorting
        $sortColumn = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');
        $allowedColumns = ['name', 'semester', 'course', 'scholarship_name'];
    
        if (in_array($sortColumn, $allowedColumns)) {
            $query->orderBy($sortColumn, $sortDirection);
        }
    
        return $query;
    }


    public function index(Request $request)
{
    // Get unique values for filters
    $semesters = Student::distinct('semester')->pluck('semester');
    $courses = Student::distinct('course')->pluck('course');

    // Build query
    $query = Student::query();

    // Apply filters
    $query = $this->applyFilters($query, $request);

    // Get paginated results
    $students = $query->paginate(10);

    return view('students.index', compact('students', 'semesters', 'courses'));
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
    return view('students.edit', compact('student'));
}

public function update(Request $request, Student $student)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'semester' => 'required|string|max:255',
        'course' => 'required|string|max:255',
        'scholarship_name' => 'required|string|max:255'
    ]);

    $student->update($validated);

    return redirect()->route('students.index')->with('success', 'Student updated successfully!');
}

public function destroy(Student $student)
{
    $student->delete();
    return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
}

    public function exportCSV(Request $request)
{
    // Build query
    $query = Student::query();

    // Apply filters
    $query = $this->applyFilters($query, $request);

    // Get all filtered students (without pagination)
    $students = $query->get();

    // Generate filename with current date
    $fileName = 'students_' . date('Y-m-d_His') . '.csv';

    // Set headers for CSV download
    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    // Create CSV content
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

public function exportXLSX(Request $request)
{
    // Build query
    $query = Student::query();

    // Apply filters
    $query = $this->applyFilters($query, $request);

    // Get all filtered students (without pagination)
    $students = $query->get();

    // Create a new spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add headers
    $sheet->setCellValue('A1', 'Name');
    $sheet->setCellValue('B1', 'Semester');
    $sheet->setCellValue('C1', 'Course');
    $sheet->setCellValue('D1', 'Scholarship Name');

    // Style headers
    $sheet->getStyle('A1:D1')->getFont()->setBold(true);

    // Add data rows
    $row = 2;
    foreach ($students as $student) {
        $sheet->setCellValue('A' . $row, $student->name);
        $sheet->setCellValue('B' . $row, $student->semester);
        $sheet->setCellValue('C' . $row, $student->course);
        $sheet->setCellValue('D' . $row, $student->scholarship_name);
        $row++;
    }

    // Auto-size columns
    foreach (range('A', 'D') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Generate filename with current date
    $fileName = 'students_' . date('Y-m-d_His') . '.xlsx';

    // Create writer for XLSM format
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');

    

    // Set headers for XLSM download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');


    // Save the file to output
    $writer->save('php://output');
}



public function exportPDF(Request $request)
{
    // Build query
    $query = Student::query();

    // Apply filters
    $query = $this->applyFilters($query, $request);

    // Get all filtered students (without pagination)
    $students = $query->get();

    // Generate PDF
    $pdf = PDF::loadView('students.pdf', [
        'students' => $students,
        'request' => $request // Pass request to show applied filters
    ]);

    // Set paper size and orientation
    $pdf->setPaper('a4', 'portrait');

    // Add page numbers
    $pdf->setOption(['enable_php' => true]);

    // Generate filename with current date
    $filename = 'scholarship_students_report_' . date('Y-m-d_His') . '.pdf';

    // Download PDF
    return $pdf->download($filename);
}



// IMPORT FUNCTION

public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xlsm|max:2048'
        ]);

        try {
            $file = $request->file('excel_file');
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Remove header row
            array_shift($rows);

            foreach ($rows as $row) {
                if (!empty($row[0])) {  // Check if name exists
                    Student::create([
                        'name' => $row[0],
                        'semester' => $row[1],
                        'course' => $row[2],
                        'scholarship_name' => $row[3]
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Students imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error importing file: ' . $e->getMessage());
        }
        
    }

    public function downloadTemplate()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers
        $sheet->setCellValue('A1', 'Student Name');
        $sheet->setCellValue('B1', 'Semester');
        $sheet->setCellValue('C1', 'Course');
        $sheet->setCellValue('D1', 'Scholarship Name');

        // Style headers
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
        
        // Auto-size columns
        foreach(range('A','D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="student_import_template.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    

}
