<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>الأسئلة </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset(path: 'assets/css/custom.css') }}">
    <link rel="icon" href="http://127.0.0.1:8000/assets/img/Group.png" type="image/x-icon">
<style>
    .faq-navigation {
    display: flex; /* لعرض الأزرار جنب بعض */
    justify-content: center; /* لتوسيط الأزرار */
    gap: 15px; /* مسافة بين الأزرار */
    margin-top: 30px; /* مسافة من أعلى */
    }

    .faq-navigation .btn-primary {
    padding: 12px 25px; /* حجم داخلي مريح */
    border-radius: 8px; /* حواف دائرية ناعمة */
    font-size: 16px; /* حجم خط مناسب */
    font-weight: bold; /* خط عريض */
    text-decoration: none; /* إزالة خط الرابط */
    color: #fff; /* لون الخط أبيض */
    background-color: #007bff; /* لون أزرق جذاب */
    border: none; /* إزالة الحدود */
    transition: background-color 0.3s ease, transform 0.2s ease; /* تأثيرات عند التفاعل */
    cursor: pointer; /* شكل المؤشر على شكل يد */
    }

    /* تأثير التفاعل (Hover) */
    .faq-navigation .btn-primary:hover {
    background-color: #0056b3; /* لون أزرق أغمق عند المرور بالماوس */
    transform: translateY(-2px); /* حركة بسيطة للأعلى */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* ظل خفيف */
    }

    /* حالة الزر المعطل (Disabled) */
    .faq-navigation button[disabled] {
    background-color: #ccc; /* لون رمادي باهت */
    cursor: not-allowed; /* تغيير شكل المؤشر */
    opacity: 0.7; /* شفافية خفيفة */
    transform: none; /* إلغاء أي تأثير حركي */
    box-shadow: none; /* إلغاء الظل */
    }

</style>
</head>

<body ng-app="myApp">
    <x-guest-header></x-guest-header>

    <section style="background: unset !important;" class="faq-section py-5">
        <div class="container">
            <div class="faq-container">
                <div id="faq-list">
                {{-- Check if the $faq variable exists before trying to display it --}}
                @isset($faq)
                <div class="faq-slider-container">
                    <div id="faq-slides">
                        <div class="faq-slide active">
                            <div class="faq-question-text">{{ $faq->question }}</div>
                            <div class="faq-answer-text">{{ $faq->answer }}</div>
                            {{-- Check for images --}}
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


                        </div>
                    </div>
                </div>
                @else
                <div class="no-faqs">
                    <i class="fas fa-question-circle"></i>
                    لا توجد أسئلة شائعة حاليًا.
                </div>
                @endisset
<div class="faq-navigation">
    {{-- الزر السابق --}}
    @if ($prevFaqId)
    <a href="{{ route('faq.show', ['id' => $prevFaqId]) }}" class="btn btn-primary">السابق</a>
    @else
    <button class="btn btn-primary" disabled>السابق</button>
    @endif

    {{-- الزر التالي --}}
    @if ($nextFaqId)
    <a href="{{ route('faq.show', ['id' => $nextFaqId]) }}" class="btn btn-primary">التالي</a>
    @else
    <button class="btn btn-primary" disabled>التالي</button>
    @endif
</div>

                </div>
            </div>
        </div>
    </section>

    <x-footer-section></x-footer-section>

    <script>
        // متغيرات عامة
        let currentIndex = 0;
        let totalFaqs = 0;

        // دالة تحديث عرض السلايد
        function updateSlideDisplay() {
            const slides = document.querySelectorAll('.faq-slide');

            slides.forEach((slide, index) => {
                slide.classList.remove('active');
                if (index === currentIndex) {
                    slide.classList.add('active');
                }
            });

            // تحديث العداد
            const currentSlideEl = document.getElementById('currentSlide');
            if (currentSlideEl) {
                currentSlideEl.textContent = currentIndex + 1;
            }

            // تحديث حالة الأزرار
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            if (prevBtn) {
                prevBtn.disabled = currentIndex === 0;
                prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
            }
            if (nextBtn) {
                nextBtn.disabled = currentIndex === totalFaqs - 1;
                nextBtn.style.opacity = currentIndex === totalFaqs - 1 ? '0.5' : '1';
            }
        }

        // دالة تغيير السلايد
        function changeSlide(direction) {
            const newIndex = currentIndex + direction;

            if (newIndex >= 0 && newIndex < totalFaqs) {
                currentIndex = newIndex;
                updateSlideDisplay();
            }
        }

        // تهيئة الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            // حساب عدد الأسئلة
            const slides = document.querySelectorAll('.faq-slide');
            totalFaqs = slides.length;

            // تحديث العداد الإجمالي
            const totalSlidesEl = document.getElementById('totalSlides');
            if (totalSlidesEl) {
                totalSlidesEl.textContent = totalFaqs;
            }

            // إضافة event listeners للأزرار
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            if (prevBtn) {
                prevBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    changeSlide(-1);
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    changeSlide(1);
                });
            }

            // تهيئة العرض الأولي
            if (totalFaqs > 0) {
                updateSlideDisplay();
            }
        });

        // إضافة دعم لوحة المفاتيح
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                changeSlide(1); // التالي
            } else if (e.key === 'ArrowRight') {
                changeSlide(-1); // السابق
            }
        });

    </script>

</body>

</html>
