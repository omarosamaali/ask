@extends('layouts.admin')

@section('title', 'تفاصيل سؤال شائع')
@section('page-title', 'تفاصيل سؤال شائع')

@push('styles')
<style>
    .detail-section {
        background: white;
        color: black;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .detail-item {
        margin-bottom: 15px;
    }

    .detail-item strong {
        display: inline-block;
        width: 150px;
        color: black;
    }

    .detail-item span {
        color: black;
    }

    .image-preview {
        max-width: 200px;
        /* للتحكم في حجم الصور */
        height: auto;
        border-radius: 8px;
        margin: 5px;
        border: 1px solid #ddd;
    }

    /* إضافة ستايل لقسم الصور */
    .images-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .btn-section {
        margin-top: 20px;
        text-align: center;
    }

    .back-btn,
    .edit-btn {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        margin-left: 10px;
    }

    .back-btn {
        background-color: #6c757d;
    }

    .edit-btn {
        background-color: #28a745;
    }

    .back-btn:hover,
    .edit-btn:hover {
        opacity: 0.9;
    }

</style>
@endpush

@section('content')
<div class="detail-section">
    <h5 class="mb-4">
        <i class="fas fa-question-circle ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        تفاصيل سؤال شائع: {{ $faq->question }}
    </h5>

    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <strong class="text-black">المرحلة الدراسية:</strong>
                <span>المرحلة {{ $faq->stage + 1 }}</span>
            </div>
            <div class="detail-item">
                <strong class="text-black">السؤال :</strong>
                <span>{{ $faq->question }}</span>
            </div>
            <div class="detail-item">
                <strong class="text-black">الإجابة :</strong>
                <span>{{ $faq->answer }}</span>
            </div>
            <div class="detail-item">
                <strong class="text-black">تاريخ الإضافة:</strong>
                <span>{{ $faq->created_at ? $faq->created_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
            </div>
            <div class="detail-item">
                <strong class="text-black">تاريخ آخر تحديث:</strong>
                <span>{{ $faq->updated_at ? $faq->updated_at->format('d/m/Y H:i') : 'غير متوفر' }}</span>
            </div>
            <div class="detail-item">
                <strong class="text-black">الحالة:</strong>
                    {{ $faq->status == '1' ? 'فعال' : 'غير فعال' }}
            </div>
        </div>
    </div>

    @if ($faq->images)
    <h6 class="mt-4 mb-3">الصور المرفقة:</h6>
    <div class="images-container">
        @php
        $images = json_decode($faq->images, true);
        @endphp
        @if(is_array($images) && count($images) > 0)
        @foreach($images as $image)
        <img src="{{ asset('storage/' . $image) }}" alt="FAQ Image" class="image-preview">
        @endforeach
        @else
        <p class="text-muted">لا توجد صور مرفقة.</p>
        @endif
    </div>
    @endif



    <div class="btn-section">
        <a href="{{ route('admin.faqs.index') }}" class="back-btn">
            <i class="fas fa-arrow-right ms-1"></i>
            العودة
        </a>
        <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="edit-btn">
            <i class="fas fa-edit ms-1"></i>
            تعديل
        </a>
    </div>
</div>
@endsection
