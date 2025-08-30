<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::query();

        // البحث في السؤال والإجابة
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('question', 'LIKE', "%{$search}%")
                    ->orWhere('answer', 'LIKE', "%{$search}%");
            });
        }

        // فلتر بناءً على المرحلة
        if ($request->filled('stage') && $request->stage !== '') {
            $query->where('stage', $request->stage);
        }

        // فلتر بناءً على الحالة
        if ($request->filled('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $faqs = $query->latest()->get();

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stage' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string',
            'status' => 'required|boolean',
            'sub_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['question', 'answer', 'status', 'stage']);

        if ($request->hasFile('sub_images')) {
            $images = [];
            foreach ($request->file('sub_images') as $image) {
                try {
                    $path = $image->store('faqs', 'public');
                    $images[] = $path;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'فشل تحميل الصورة: ' . $e->getMessage());
                }
            }
            $data['images'] = json_encode($images);
        } else {
            $data['images'] = json_encode([]); // Initialize empty array if no images
        }

        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'تم إضافة السؤال بنجاح');
    }

    public function update(Request $request, Faq $faq)
    {
        $validator = Validator::make($request->all(), [
            'stage' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string',
            'status' => 'required|boolean',
            'sub_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['question', 'answer', 'status', 'stage']);

        $existingImages = is_array($faq->images) ? $faq->images : [];
        $deletedImages = json_decode($request->input('deleted_images', '[]'), true) ?? [];

        if (!empty($deletedImages)) {
            foreach ($deletedImages as $imagePath) {
                if (Storage::disk('public')->exists($imagePath) && str_starts_with($imagePath, 'faqs/')) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }

        $updatedImages = array_values(array_diff($existingImages, $deletedImages));

        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $image) {
                try {
                    $path = $image->store('faqs', 'public');
                    $updatedImages[] = $path;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'فشل تحميل الصورة: ' . $e->getMessage());
                }
            }
        }

        $data['images'] = json_encode($updatedImages);
        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('success', 'تم تحديث السؤال بنجاح');
    }

    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function destroy(Faq $faq)
    {
        if (is_array($faq->images)) {
            foreach ($faq->images as $image) {
                if (Storage::disk('public')->exists($image) && str_starts_with($image, 'faqs/')) {
                    Storage::disk('public')->delete($image);
                }
            }
        }
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'تم حذف السؤال بنجاح');
    }
}
