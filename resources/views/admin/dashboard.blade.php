@extends('layouts.admin')

@section('title', 'الرئيسية - لوحة التحكم')
@section('page-title', 'الرئيسية')

@push('styles')
<style>
    .stats-card {
        background: #ffffff;
        color: rgb(0, 0, 0);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .stats-card .icon {
        font-size: 3rem;
        opacity: 0.8;
        margin-bottom: 15px;
    }

    .stats-card .number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .stats-card .label {
        font-size: 15px;
        font-weight: 600;
    }

    .welcome-section {
        background: white;
        border-radius: 15px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .welcome-section h2 {
        color: #333;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .welcome-section p {
        color: #666;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .icon i {
        padding: 5px;
        width: 50px;
        font-size: 19px;
        height: 50px;
        text-align: center;
        align-items: center;
        justify-content: center;
        display: flex;
        transition: .5s;
        border-radius: 8px;
    }

    .stats-card:hover i {
        transform: rotateY(180deg);
    }

    /* ألوان مختلفة لكل مرحلة */
    .icon.stage-1 i {
        background: rgb(48 126 243 / 10%);
        color: rgb(48 126 243);
    }

    .icon.stage-2 i {
        background: rgb(83 166 83 / 10%);
        color: rgb(83 166 83);
    }

    .icon.stage-3 i {
        background: rgb(255 165 0 / 10%);
        color: rgb(255 140 0);
    }

    .icon.stage-4 i {
        background: rgb(220 20 60 / 10%);
        color: rgb(220 20 60);
    }

    .icon.stage-5 i {
        background: rgb(138 43 226 / 10%);
        color: rgb(138 43 226);
    }

    .icon.stage-6 i {
        background: rgb(30 144 255 / 10%);
        color: rgb(30 144 255);
    }

    .icon.stage-7 i {
        background: rgb(255 69 0 / 10%);
        color: rgb(255 69 0);
    }

    .icon.stage-8 i {
        background: rgb(50 205 50 / 10%);
        color: rgb(50 205 50);
    }

    .icon.stage-9 i {
        background: rgb(255 20 147 / 10%);
        color: rgb(255 20 147);
    }

    .icon.stage-10 i {
        background: rgb(64 224 208 / 10%);
        color: rgb(64 224 208);
    }

    .icon.stage-11 i {
        background: rgb(255 215 0 / 10%);
        color: rgb(218 165 32);
    }

    .icon.stage-12 i {
        background: rgb(72 61 139 / 10%);
        color: rgb(72 61 139);
    }

    .container-top {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .text-muted {
        color: #6c757d !important;
        font-size: 13px;
    }

</style>
@endpush

@section('content')
<div class="welcome-section">
    <h2>مرحباً بك في لوحة تحكم الإدارة</h2>
    <p>
        مرحباً <strong>{{ Auth::user()->name }}</strong>، يمكنك من خلال هذه اللوحة إدارة جميع
        جوانب النظام بسهولة وفعالية. استخدم القوائم الجانبية للوصول إلى الأقسام المختلفة.
    </p>
</div>

<div class="container">
    <div class="row g-3">
        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-1 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة الأولى</div>
                </div>
                <div class="number">{{ $stageOne }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-2 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة الثانية</div>
                </div>
                <div class="number">{{ $stageTwo }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>

        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-3 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة الثالثة</div>
                </div>
                <div class="number">{{ $stageThree }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>

        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-4 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة الرابعة</div>
                </div>
                <div class="number">{{ $stageFour }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-5 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة الخامسة</div>
                </div>
                <div class="number">{{ $stageFive }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-6 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة السادسة</div>
                </div>
                <div class="number">{{ $stageSix }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>

        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-7 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة السابعة</div>
                </div>
                <div class="number">{{ $stageSeven }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>

        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-8 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة الثامنة</div>
                </div>
                <div class="number">{{ $stageEight }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-9 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة التاسعة</div>
                </div>
                <div class="number">{{ $stageNine }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-10 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة العاشرة</div>
                </div>
                <div class="number">{{ $stageTen }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>

        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-11 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة الحادية عشر</div>
                </div>
                <div class="number">{{ $stageEleven }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>

        <div class="col-12 col-md">
            <div class="stats-card">
                <div class="icon stage-12 container-top">
                    <i class="fa-solid fa-book"></i>
                    <div class="label">المرحلة الثانية عشر</div>
                </div>
                <div class="number">{{ $stageTwelve }}</div>
                <p class="text-muted">عدد الأسئلة</p>
            </div>
        </div>
    </div>
</div>

@endsection
