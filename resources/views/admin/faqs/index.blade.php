@extends('layouts.admin')

@section('title', 'إدارة الأسئلة ')
@section('page-title', 'إدارة الأسئلة ')

@push('styles')
<style>
    .add-section {
        background: white;
        color: black;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 15px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0e6939;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .about-preview {
        max-width: 200px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
    }

    .translated-name-field {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
        color: black;
    }

    .translated-name-field:focus {
        background-color: rgba(255, 255, 255, 0.15);
        border-color: white;
    }

    .btn-section {
        margin-top: 20px;
    }

    .back-btn {
        background: #6c757d;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        margin-right: 10px;
        display: inline-block;
    }

    .back-btn:hover {
        background: #545b62;
        color: white;
    }

    .update-btn {
        background: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .update-btn:hover {
        background: #218838;
    }

    .add-section {
        background: #212529;
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 15px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0e6939;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
    }

    .action-buttons .btn {
        padding: 5px 10px;
        font-size: 12px;
        margin: 0 2px;
    }

</style>
@endpush

@section('content')
<div class="add-section">
    <h5 class="mb-4">
        <i class="fas fa-question-circle ms-2"></i>
        إضافة سؤال جديد
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

    <form action="{{ route('admin.faqs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="stage" class="form-label">المرحلة الدراسية</label>
                    <select class="form-select" name="stage" id="stage" required>
                        <option value="0" {{ old('stage', 0) == '0' ? 'selected' : '' }}>المرحلة الأولي</option>
                        <option value="1" {{ old('stage', 1) == '1' ? 'selected' : '' }}>المرحلة الثانية</option>
                        <option value="2" {{ old('stage', 2) == '2' ? 'selected' : '' }}>المرحلة الثالثة</option>
                        <option value="3" {{ old('stage', 3) == '3' ? 'selected' : '' }}>المرحلة الرابعة</option>
                        <option value="4" {{ old('stage', 4) == '4' ? 'selected' : '' }}>المرحلة الخامسة</option>
                        <option value="5" {{ old('stage', 5) == '5' ? 'selected' : '' }}>المرحلة السادسة</option>
                        <option value="6" {{ old('stage', 6) == '6' ? 'selected' : '' }}>المرحلة السابعة</option>
                        <option value="7" {{ old('stage', 7) == '7' ? 'selected' : '' }}>المرحلة الثامنة</option>
                        <option value="8" {{ old('stage', 8) == '8' ? 'selected' : '' }}>المرحلة التاسعة</option>
                        <option value="9" {{ old('stage', 9) == '9' ? 'selected' : '' }}>المرحلة العاشرة</option>
                        <option value="10" {{ old('stage', 10) == '10' ? 'selected' : '' }}>المرحلة الحادية عشر</option>
                        <option value="11" {{ old('stage', 11) == '11' ? 'selected' : '' }}>المرحلة الثانية عشر</option>
                    </select>
                    @error('stage')
                    <div class="text-white">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="question" class="form-label">السؤال (بالعربية)</label>
                    <input type="text" class="form-control" id="question" name="question" value="{{ old('question') }}" required>
                    @error('question')
                    <div class="text-white">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="answer" class="form-label">الإجابة (بالعربية)</label>
                    <input type="text" class="form-control" id="answer" name="answer" value="{{ old('answer') }}" required>
                    @error('answer')
                    <div class="text-white">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label">الحالة</label>
                    <select class="form-select" name="status" id="status" required>
                        <option value="1" {{ old('status', 1) == '1' ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ old('status', 0) == '0' ? 'selected' : '' }}>غير فعال</option>
                    </select>
                    @error('status')
                    <div class="text-white">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="sub_images_input" class="form-label font-bold">الصور</label>
                    <input type="file" class="form-control" name="sub_images[]" id="sub_images_input" accept="image/*" multiple>
                    @error('sub_images')
                    <div class="text-black">{{ $message }}</div>
                    @enderror

                    <div id="sub_images_preview" class="d-flex flex-wrap mt-2"></div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-light mt-3">
            <i class="fas fa-plus ms-1"></i>
            إضافة سؤال
        </button>
    </form>
</div>

<!-- Search and Filter Section -->
<div class="search-filter-section">
    <h6 class="mb-3">
        <i class="fas fa-search ms-2"></i>
        البحث والفلتر
    </h6>

    <form method="GET" action="{{ route('admin.faqs.index') }}">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="search" class="form-label">البحث في السؤال أو الإجابة</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="ابحث في الأسئلة والإجابات...">
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="filter_stage" class="form-label">فلتر بالمرحلة</label>
                    <select class="form-select" name="stage" id="filter_stage">
                        <option value="">جميع المراحل</option>
                        <option value="0" {{ request('stage') == '0' ? 'selected' : '' }}>المرحلة الأولي</option>
                        <option value="1" {{ request('stage') == '1' ? 'selected' : '' }}>المرحلة الثانية</option>
                        <option value="2" {{ request('stage') == '2' ? 'selected' : '' }}>المرحلة الثالثة</option>
                        <option value="3" {{ request('stage') == '3' ? 'selected' : '' }}>المرحلة الرابعة</option>
                        <option value="4" {{ request('stage') == '4' ? 'selected' : '' }}>المرحلة الخامسة</option>
                        <option value="5" {{ request('stage') == '5' ? 'selected' : '' }}>المرحلة السادسة</option>
                        <option value="6" {{ request('stage') == '6' ? 'selected' : '' }}>المرحلة السابعة</option>
                        <option value="7" {{ request('stage') == '7' ? 'selected' : '' }}>المرحلة الثامنة</option>
                        <option value="8" {{ request('stage') == '8' ? 'selected' : '' }}>المرحلة التاسعة</option>
                        <option value="9" {{ request('stage') == '9' ? 'selected' : '' }}>المرحلة العاشرة</option>
                        <option value="10" {{ request('stage') == '10' ? 'selected' : '' }}>المرحلة الحادية عشر</option>
                        <option value="11" {{ request('stage') == '11' ? 'selected' : '' }}>المرحلة الثانية عشر</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="filter_status" class="form-label">فلتر بالحالة</label>
                    <select class="form-select" name="status" id="filter_status">
                        <option value="">جميع الحالات</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>غير فعال</option>
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="mb-3 d-flex align-items-end" style="height: 73px;">
                    <div>
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                            بحث
                        </button>
                        <a href="{{ route('admin.faqs.index') }}" class="clear-btn">
                            <i class="fas fa-times"></i>
                            مسح
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- عرض نتائج البحث -->
    @if(request()->hasAny(['search', 'stage', 'status']))
    <div class="alert alert-info mb-0">
        <i class="fas fa-info-circle"></i>
        عدد النتائج الموجودة: {{ $faqs->count() }}
        @if(request('search'))
        | البحث عن: "{{ request('search') }}"
        @endif
        @if(request('stage') !== null && request('stage') !== '')
        | المرحلة: {{
                collect([
                    '0' => 'المرحلة الأولي',
                    '1' => 'المرحلة الثانية', 
                    '2' => 'المرحلة الثالثة',
                    '3' => 'المرحلة الرابعة',
                    '4' => 'المرحلة الخامسة',
                    '5' => 'المرحلة السادسة',
                    '6' => 'المرحلة السابعة',
                    '7' => 'المرحلة الثامنة',
                    '8' => 'المرحلة التاسعة',
                    '9' => 'المرحلة العاشرة',
                    '10' => 'المرحلة الحادية عشر',
                    '11' => 'المرحلة الثانية عشر'
                ])[request('stage')] 
            }}
        @endif
        @if(request('status') !== null && request('status') !== '')
        | الحالة: {{ request('status') == '1' ? 'فعال' : 'غير فعال' }}
        @endif
    </div>
    @endif
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if ($faqs->count())
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>تاريخ الإضافة</th>
                <th>المرحلة</th>
                <th>السؤال</th>
                <th>الإجابة</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faqs as $index => $faq)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $faq->created_at->format('d/m/Y') }}</td>
                <td>
                    {{
                        collect([
                            '0' => 'المرحلة الأولي',
                            '1' => 'المرحلة الثانية', 
                            '2' => 'المرحلة الثالثة',
                            '3' => 'المرحلة الرابعة',
                            '4' => 'المرحلة الخامسة',
                            '5' => 'المرحلة السادسة',
                            '6' => 'المرحلة السابعة',
                            '7' => 'المرحلة الثامنة',
                            '8' => 'المرحلة التاسعة',
                            '9' => 'المرحلة العاشرة',
                            '10' => 'المرحلة الحادية عشر',
                            '11' => 'المرحلة الثانية عشر'
                        ])[$faq->stage] ?? 'غير محدد'
                    }}
                </td>
                <td>{{ Str::limit($faq->question, 50) }}</td>
                <td>{{ Str::limit($faq->answer, 50) }}</td>
                <td>
                    <span class="badge {{ $faq->status == '1' ? 'bg-success' : 'bg-danger' }}">
                        {{ $faq->status == '1' ? 'فعال' : 'غير فعال' }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.faqs.show', $faq->id) }}" class="btn btn-info btn-sm" title="عرض">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-warning btn-sm" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" title="حذف" onclick="confirmDelete({{ $faq->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="text-center py-4">
    <i class="fas fa-info-circle text-muted" style="font-size: 3rem;"></i>
    @if(request()->hasAny(['search', 'stage', 'status']))
    <p class="text-muted mt-2">لا توجد نتائج مطابقة لمعايير البحث</p>
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        عرض جميع الأسئلة
    </a>
    @else
    <p class="text-muted mt-2">لا توجد أسئلة شائعة</p>
    @endif
</div>
@endif

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                هل أنت متأكد من حذف هذا السؤال؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('sub_images_input').addEventListener('change', function(event) {
        let preview = document.getElementById('sub_images_preview');
        preview.innerHTML = "";
        Array.from(event.target.files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('about-preview', 'm-1');
                img.style.maxWidth = '150px';
                img.style.borderRadius = '8px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });

    function confirmDelete(id) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `{{ url('admin/faqs') }}/${id}`;

        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

</script>
@endpush

