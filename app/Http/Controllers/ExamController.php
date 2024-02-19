<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all(); // Fetch all exams from database
        return view('backend.exams.index', compact('exams'));
    }

    public function create()
    {
        return view('backend.exams.create'); // Create form for creating a new exam
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request); // Validate request data

        // Handle image upload with preview
        $image = $this->handleImageUpload($request);

        $slug = Str::slug($request->title);

        Exam::create([
            'image' => $image,
            'title' => $data['title'],
            'slug' => $slug,
            'description' => $data['description'],
            'exam_type' => $data['exam_type'],
            'total_mark' => $data['total_mark'],
            'pass_mark' => $data['pass_mark'],
            'duration' => $data['duration'],
            'status' => $data['status'],
        ]);

        return redirect()->route('admin.exams.index')->with('success', 'Exam created successfully!');
    }

    public function edit(Exam $exam)
    {
        return view('backend.exams.edit', compact('exam')); // Edit form for an existing exam
    }

    public function update(Request $request, Exam $exam)
    {
        $data = $this->validateRequest($request); // Validate request data

        // Retrieve the stored image path from the database
        $imagePath = $exam->image;

        if ($request->has('image')) {

            // Check if the path exists
            if (file_exists($imagePath)) {
                // Delete the file
                unlink($imagePath);
            }
        }


        // Handle image upload or reuse existing image if not changed
        $image = $this->handleImageUpload($request, $exam);
        $slug = Str::slug($request->title);

        $exam->update([
            'image' => $image,
            'title' => $data['title'],
            'slug' => $slug,
            'description' => $data['description'],
            'exam_type' => $data['exam_type'],
            'total_mark' => $data['total_mark'],
            'pass_mark' => $data['pass_mark'],
            'duration' => $data['duration'],
            'status' => $data['status'],
        ]);

        return redirect()->route('admin.exams.index')->with('success', 'Exam updated successfully!');
    }

    public function destroy(Exam $exam)
    {
        if ($exam->image) {
            // Check if the path exists
            if (file_exists($exam->image)) {
                // Delete the file
                unlink($exam->image);
            }
        }

        $exam->delete(); // Delete exam from database
        return redirect()->route('admin.exams.index')->with('success', 'Exam deleted successfully!');
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'title' => 'required',
            'exam_type' => 'required',
            'total_mark' => 'required',
            'pass_mark' => 'required',
            'status' => 'required',
            'duration' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png', // Image validation rules
        ]);
    }

    private function handleImageUpload(Request $request, Exam $exam = null)
    {
        if ($request->hasFile('image')) {
            // Get the uploaded image file
            $image = $request->file('image');

            // Generate a unique filename with a timestamp to avoid conflicts
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Specify the desired path to store the image (publicly accessible)
            $path = public_path('uploads/exams'); // Consider a more secure location if needed

            // Move the image to the desired path
            $image->move($path, $filename);

            // Store the full path to the image in the database
            return 'uploads/exams/' . $filename;
        } else if ($exam) {
            // Reuse existing image path if not updating the image
            return $exam->image;
        } else {
            // Set a default placeholder or null if creating without an image
            return null;
        }
    }
}
