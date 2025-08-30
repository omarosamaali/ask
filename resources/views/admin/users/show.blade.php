@extends('layouts.admin')

@section('title', 'عرض المستخدم')
@section('page-title', 'عرض المستخدم')

@push('styles')
<style>
    .user-details-section {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .detail-item {
        margin-bottom: 20px;
    }

    .detail-label {
        font-weight: 600;
        color: #555;
        font-size: 1.1rem;
        margin-bottom: 5px;
        display: block;
    }

    .detail-value {
        font-size: 1.05rem;
        color: #333;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        padding: 10px 15px;
        border-radius: 8px;
        word-wrap: break-word;
    }

    .detail-value.badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: .5em .75em;
        font-size: 0.9em;
        font-weight: bold;
    }

    .image-preview {
        max-width: 300px;
        border-radius: 8px;
        margin-top: 10px;
    }

</style>
@endpush

@section('content')
<div class="user-details-section">
    <div class="d-flex align-items-center mb-4">
        <i class="fas fa-user ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
        <h4 class="mb-0">عرض مستخدم: {{ $user->name }}</h4>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الاسم:</span>
                <div class="detail-value">{{ $user->name }}</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">البريد الإلكتروني:</span>
                <div class="detail-value">{{ $user->email }}</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">الحالة:</span>
                <div class="detail-value">
                    {{ $user->status == 'فعال' ? 'فعال' : 'غير فعال' }}
                </div>
            </div>
        </div>
    </div>

    <div class="btn-section mt-4">
        <a href="{{ route('admin.users.index') }}" class="back-btn">
            <i class="fas fa-arrow-right ms-1"></i>
            العودة لقائمة المستخدمين
        </a>
        <a style="background-color: #007BFF; color: white;" href="{{ route('admin.users.edit', $user->id) }}" class="back-btn">
            <i class="fas fa-arrow-right ms-1"></i>
            تعديل المستخدم </a>

    </div>
</div>
@endsection
