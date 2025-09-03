<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>الأسئلة</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset(path: 'assets/css/custom.css') }}">
    <link rel="icon" href="http://127.0.0.1:8000/assets/img/Group.png" type="image/x-icon">
</head>
<body ng-app="myApp">
    <x-guest-header></x-guest-header>
    <section style="background: unset !important;" class="faq-section py-5">
        <div class="container">
            <div class="faq-container">
                <div id="faq-list">
                    @isset($faq)
                    <div class="faq-slider-container">
                        <div id="faq-slides">
                            <div class="faq-slide active">
                                <div class="faq-question-text">{{ $faq->question }}</div>
                                <div class="faq-answer-text">{{ $faq->answer }}</div>
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
                        @if ($prevFaqId)
                        <a href="{{ route('faq.show', ['id' => $prevFaqId]) }}" class="btn btn-primary">السابق</a>
                        @else
                        <button class="btn btn-primary" disabled>السابق</button>
                        @endif
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
        let currentIndex = 0;
        let totalFaqs = 0;

        function updateSlideDisplay() {
            const slides = document.querySelectorAll('.faq-slide');
            slides.forEach((slide, index) => {
                slide.classList.remove('active');
                if (index === currentIndex) {
                    slide.classList.add('active');
                }
            });
            const currentSlideEl = document.getElementById('currentSlide');
            if (currentSlideEl) {
                currentSlideEl.textContent = currentIndex + 1;
            }
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

        function changeSlide(direction) {
            const newIndex = currentIndex + direction;
            if (newIndex >= 0 && newIndex < totalFaqs) {
                currentIndex = newIndex;
                updateSlideDisplay();
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.faq-slide');
            totalFaqs = slides.length;
            const totalSlidesEl = document.getElementById('totalSlides');
            if (totalSlidesEl) {
                totalSlidesEl.textContent = totalFaqs;
            }
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
            if (totalFaqs > 0) {
                updateSlideDisplay();
            }
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                changeSlide(1);
            } else if (e.key === 'ArrowRight') {
                changeSlide(-1);
            }
        });

    </script>
</body>
</html>
