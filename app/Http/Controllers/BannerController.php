<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function index()
    {
        $banners = Banner::all(); // Fetch all banners from database
        return view('backend.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('backend.banners.create'); // Create form for creating a new banner
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request); // Validate request data

        // Handle image upload with preview
        $image = $this->handleImageUpload($request);

        Banner::create([
            'image' => $image,
            'link' => $data['link'],
            'text' => $data['text'],
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully!');
    }

    public function edit(Banner $banner)
    {
        return view('backend.banners.edit', compact('banner')); // Edit form for an existing banner
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $this->validateRequest($request); // Validate request data

        // Retrieve the stored image path from the database
        $imagePath = $banner->image;

        // Check if the path exists
        if (file_exists($imagePath)) {
            // Delete the file
            unlink($imagePath);
        }

        // Handle image upload or reuse existing image if not changed
        $image = $this->handleImageUpload($request, $banner);

        $banner->update([
            'image' => $image,
            'link' => $data['link'],
            'text' => $data['text'],
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully!');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            // Check if the path exists
            if (file_exists($banner->image)) {
                // Delete the file
                unlink($banner->image);
            }
        }

        $banner->delete(); // Delete banner from database
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully!');
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'link' => 'required',
            'text' => 'nullable',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png', // Image validation rules
        ]);
    }

    private function handleImageUpload(Request $request, Banner $banner = null)
    {
        if ($request->hasFile('image')) {
            // Get the uploaded image file
            $image = $request->file('image');

            // Generate a unique filename with a timestamp to avoid conflicts
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Specify the desired path to store the image (publicly accessible)
            $path = public_path('uploads/banners'); // Consider a more secure location if needed

            // Move the image to the desired path
            $image->move($path, $filename);

            // Store the full path to the image in the database
            return 'uploads/banners/'.$filename;
        } else if ($banner) {
            // Reuse existing image path if not updating the image
            return $banner->image;
        } else {
            // Set a default placeholder or null if creating without an image
            return null;
        }
    }
}
