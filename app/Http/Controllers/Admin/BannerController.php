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
        $rules = [
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'alts.*'   => 'required|string|max:255',
            'links.*'  => 'nullable|url|max:500',
        ];

        $messages = [
            'images.*.required' => 'انتخاب تصویر برای تمامی بنرها الزامی است.',
            'images.*.image'    => 'فایل انتخاب شده باید از نوع تصویر باشد.',
            'images.*.mimes'    => 'فرمت‌های مجاز تصویر: jpeg, png, jpg, gif',
            'images.*.max'      => 'حداکثر حجم مجاز برای هر تصویر ۵ مگابایت است.',

            'alts.*.required'   => 'وارد کردن متن جایگزین (Alt) الزامی است.',
            'alts.*.string'     => 'متن جایگزین باید به صورت رشته متنی باشد.',
            'alts.*.max'        => 'متن جایگزین نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'links.*.url'       => 'فرمت لینک وارد شده معتبر نیست (باید با http یا https شروع شود).',
            'links.*.max'       => 'لینک نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',
        ];

        $attributes = [
            'images.*' => 'تصویر بنر',
            'alts.*'   => 'متن جایگزین',
            'links.*'  => 'لینک بنر',
        ];

        $validated = $request->validate($rules, $messages, $attributes);

        $images = $request->file('images', []);
        $alts = $request->input('alts', []);
        $links = $request->input('links', []);

        $destinationPath = 'images/banners';
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        foreach ($images as $index => $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $path = 'images/banners/' . $fileName;

            Banner::create([
                'image_path' => $path,
                'alt_text' => $alts[$index] ?? null,
                'link' => $links[$index] ?? null, // ذخیره لینک
            ]);
        }

        return back()->with('success', 'بنرها با موفقیت آپلود شدند.');
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
