@extends('layouts.admin')

@section('title', 'تعديل المستخدم')
@section('page-title', 'تعديل المستخدم')

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

        .detail-value,
        .form-control {
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

        .chef-fields {
            display: none;
        }
    </style>
@endpush


@section('content')
    <div class="user-details-section">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-edit ms-2 text-primary" style="margin-left: 10px; font-size: 1rem;"></i>
            <h4 class="mb-0">تعديل مستخدم: {{ $user->name }}</h4>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">الاسم:</span>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}"
                            required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">البريد الإلكتروني:</span>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}"
                            required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">كلمة السر (اتركها فارغة إذا لم تكن تريد التغيير):</span>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">الحالة:</span>
                        <select class="form-select" name="status" id="status" required>
                            <option value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>فعال
                            </option>
                            <option value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>غير
                                فعال</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            </div>

            <div class="btn-section mt-4">
                <a href="{{ route('admin.users.index') }}" class="back-btn">
                    <i class="fas fa-arrow-right ms-1"></i>
                    العودة لقائمة المستخدمين
                </a>
                <button type="submit" class="edit-btn">
                    <i class="fas fa-save ms-1"></i>
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
@endsection