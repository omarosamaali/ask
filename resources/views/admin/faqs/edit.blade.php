@extends('layouts.admin')

@section('title', 'تعديل سؤال شائع')
@section('page-title', 'تعديل سؤال شائع')

@push('styles')
<style>
    .image-preview-container {
        position: relative;
        display: inline-block;
        margin: 5px;
        transition: all 0.3s ease;
    }

    .image-preview {
        max-width: 150px;
        height: auto;
        border-radius: 8px;
        border: 1px solid #ddd;
        transition: transform 0.2s ease;
    }

    .image-preview:hover {
        transform: scale(1.05);
    }

    .delete-image {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(255, 0, 0, 0.8);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s ease;
    }

    .delete-image:hover {
        background-color: rgba(255, 0, 0, 1);
    }

    .fade-out {
        opacity: 0;
        transform: scale(0.8);
    }

    .fade-in {
        animation: fadeIn 0.3s ease forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

</style>
@endpush

@section('content')
<div class="add-section">
    <h5 class="mb-4">
        <i class="fas fa-edit ms-2"></i>
        تعديل سؤال شائع
    </h5>

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input مخفي للصور المحذوفة -->
        <input type="hidden" name="deleted_images" id="deleted_images_input" value="[]">

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="stage" class="form-label">المرحلة الدراسية</label>
                    <select class="form-select" name="stage" id="stage" required>
                        @for ($i = 0; $i <= 11; $i++) <option value="{{ $i }}" {{ old('stage', $faq->stage) == $i ? 'selected' : '' }}>
                            المرحلة {{ $i + 1 }}
                            </option>
                            @endfor
                    </select>
                    @error('stage')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="question" class="form-label">السؤال (بالعربية)</label>
                    <input type="text" class="form-control" id="question" name="question" value="{{ old('question', $faq->question) }}" required>
                    @error('question')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="answer" class="form-label">الإجابة (بالعربية)</label>
                    <textarea class="form-control" id="answer" name="answer" rows="3" required>{{ old('answer', $faq->answer) }}</textarea>
                    @error('answer')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label">الحالة</label>
                    <select class="form-select" name="status" id="status" required>
                        <option value="1" {{ old('status', $faq->status) == '1' ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ old('status', $faq->status) == '0' ? 'selected' : '' }}>غير فعال</option>
                    </select>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label font-bold">
                        <i class="fas fa-images ms-1"></i>
                        الصور الحالية
                    </label>
                    <div id="existing_images_preview" class="d-flex flex-wrap mt-2">
                        @if ($faq->images)
                        @php
                        $images = json_decode($faq->images, true);
                        @endphp
                        @if(is_array($images) && count($images) > 0)
                        @foreach($images as $image)
                        <div class="image-preview-container fade-in" id="existing-image-{{ $loop->index }}" data-image-path="{{ $image }}">
                            <img src="{{ asset('storage/' . $image) }}" class="image-preview" alt="صورة {{ $loop->index + 1 }}">
                            <button type="button" class="delete-image" data-path="{{ $image }}" data-index="{{ $loop->index }}" data-type="existing">
                                &times;
                            </button>
                        </div>
                        @endforeach
                        @else
                        <p class="text-muted">لا توجد صور مرفقة</p>
                        @endif
                        @else
                        <p class="text-muted">لا توجد صور مرفقة</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="sub_images_input" class="form-label font-bold">
                        <i class="fas fa-plus ms-1"></i>
                        إضافة صور جديدة
                    </label>
                    <input type="file" class="form-control" name="sub_images[]" id="sub_images_input" accept="image/*" multiple>
                    <small class="form-text text-muted">يمكنك اختيار عدة صور في نفس الوقت</small>
                    @error('sub_images.*')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div id="new_images_preview" class="d-flex flex-wrap mt-2"></div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save ms-1"></i>
                حفظ التعديلات
            </button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left ms-1"></i>
                إلغاء
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // متغيرات للتحكم في الصور
        let deletedImages = [];
        let newImageIndex = 0;

        // عنصر الـ input المخفي للصور المحذوفة
        const deletedImagesInput = document.getElementById('deleted_images_input');

        // عنصر إدخال الصور الجديدة
        const newImagesInput = document.getElementById('sub_images_input');

        // عنصر معاينة الصور الجديدة
        const newImagesPreview = document.getElementById('new_images_preview');

        // معاينة الصور الجديدة فورياً
        newImagesInput.addEventListener('change', function(event) {
            // مسح المعاينة السابقة
            newImagesPreview.innerHTML = '';

            // معاينة كل صورة جديدة
            Array.from(event.target.files).forEach((file, index) => {
                // التحقق من نوع الملف
                if (!file.type.startsWith('image/')) {
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = document.createElement('div');
                    container.classList.add('image-preview-container', 'fade-in');
                    container.id = `new-image-${newImageIndex}`;

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('image-preview');
                    img.alt = `صورة جديدة ${index + 1}`;

                    const deleteBtn = document.createElement('button');
                    deleteBtn.type = 'button';
                    deleteBtn.classList.add('delete-image');
                    deleteBtn.innerHTML = '&times;';
                    deleteBtn.dataset.type = 'new';
                    deleteBtn.dataset.index = newImageIndex;

                    // إضافة مستمع الحدث لحذف الصورة الجديدة
                    deleteBtn.addEventListener('click', function() {
                        removeNewImage(this);
                    });

                    container.appendChild(img);
                    container.appendChild(deleteBtn);
                    newImagesPreview.appendChild(container);

                    newImageIndex++;
                };
                reader.readAsDataURL(file);
            });
        });

        // حذف صورة جديدة من المعاينة
        function removeNewImage(deleteBtn) {
            const container = deleteBtn.closest('.image-preview-container');
            const imageIndex = parseInt(deleteBtn.dataset.index);

            // إضافة تأثير الاختفاء
            container.classList.add('fade-out');

            // حذف العنصر بعد انتهاء التأثير
            setTimeout(() => {
                container.remove();

                // إعادة تعيين قيمة input الملفات إذا لم تعد هناك صور
                if (newImagesPreview.children.length === 0) {
                    newImagesInput.value = '';
                }
            }, 300);
        }

        // حذف صورة موجودة
        document.querySelectorAll('.delete-image[data-type="existing"]').forEach(button => {
            button.addEventListener('click', function() {
                const imageContainer = this.closest('.image-preview-container');
                const imagePath = this.dataset.path;

                // إضافة الصورة للقائمة المحذوفة
                deletedImages.push(imagePath);
                deletedImagesInput.value = JSON.stringify(deletedImages);

                // تأثير الاختفاء الفوري
                imageContainer.classList.add('fade-out');

                // حذف العنصر بعد انتهاء التأثير
                setTimeout(() => {
                    imageContainer.remove();

                    // التحقق إذا لم تعد هناك صور موجودة
                    const existingImagesContainer = document.getElementById('existing_images_preview');
                    if (existingImagesContainer.children.length === 0) {
                        existingImagesContainer.innerHTML = '<p class="text-muted">لا توجد صور مرفقة</p>';
                    }
                }, 300);
            });
        });

        // منع إرسال النموذج إذا كان هناك أخطاء في الصور
        document.querySelector('form').addEventListener('submit', function(e) {
            const newFiles = newImagesInput.files;
            const maxFileSize = 5 * 1024 * 1024; // 5MB
            let hasError = false;

            Array.from(newFiles).forEach(file => {
                if (file.size > maxFileSize) {
                    alert(`حجم الصورة ${file.name} كبير جداً. الحد الأقصى 5 ميجابايت`);
                    hasError = true;
                }
            });

            if (hasError) {
                e.preventDefault();
            }
        });

        // تحسين تجربة السحب والإفلات (Drag & Drop)
        const fileInput = newImagesInput;
        const dropZone = fileInput.closest('.mb-3');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-primary', 'bg-light');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-primary', 'bg-light');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            fileInput.files = files;

            // تشغيل حدث التغيير للمعاينة
            const changeEvent = new Event('change', {
                bubbles: true
            });
            fileInput.dispatchEvent(changeEvent);
        }
    });

</script>

@endsection
