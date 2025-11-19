<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index()
    {
        $data['header_title'] = 'Banners';
        $data['banners'] = Banner::orderBy('sort_order')->get();
        return view('admin.banner.index', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'alts.*' => 'nullable|string|max:255',
        ]);

        $images = $request->file('images', []);
        $alts = $request->input('alts', []);

        // target Directory path to save banner images
        $destinationPath = 'images/banners';
        // create directory if not exist
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath,0777,true,true);
        }

        foreach ($images as $index => $file) {
            // Generate a unique file name
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Move the file directly to the public/images/banners folder
            $file->move($destinationPath, $fileName);

            // Store the path relative to the public folder in the database
            // This will save as: 'images/banners/filename.ext'
            $path = 'images/banners/' . $fileName;

            $altText = $alts[$index] ?? null;

            Banner::create([
                'image_path' => $path,
                'alt_text' => $altText,
            ]);
        }

        return back()->with('success', 'Banners uploaded successfully.');
    }


    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        // Use public_path() to get the full path to the image
        $filePath = public_path($banner->image_path);

        // Check if the file exists before attempting to delete it
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $banner->delete();
        return back()->with('success', 'Banner deleted!');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Banner::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 'ok']);
    }
}
