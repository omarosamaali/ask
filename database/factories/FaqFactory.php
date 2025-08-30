<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition()
    {
        // أسئلة وإجابات حسب المرحلة
        $questionsAnswers = [
            0 => [
                ['question' => 'ما هي الحروف الأبجدية؟', 'answer' => 'الحروف الأبجدية العربية 28 حرفاً'],
                ['question' => 'كيف نعد الأرقام؟', 'answer' => 'نعد الأرقام من واحد إلى عشرة: ١، ٢، ٣...'],
                ['question' => 'ما هي الألوان الأساسية؟', 'answer' => 'الألوان الأساسية هي الأحمر والأزرق والأصفر'],
            ],
            1 => [
                ['question' => 'ما ناتج ٥ + ٣؟', 'answer' => 'ناتج ٥ + ٣ = ٨'],
                ['question' => 'كم عدد أصابع اليد؟', 'answer' => 'عدد أصابع اليد خمسة أصابع'],
                ['question' => 'ما هي أيام الأسبوع؟', 'answer' => 'أيام الأسبوع سبعة: السبت، الأحد، الاثنين...'],
            ],
            2 => [
                ['question' => 'ما ناتج ٦ × ٤؟', 'answer' => 'ناتج ٦ × ٤ = ٢٤'],
                ['question' => 'ما عاصمة مصر؟', 'answer' => 'عاصمة مصر هي القاهرة'],
                ['question' => 'كم عدد فصول السنة؟', 'answer' => 'فصول السنة أربعة: ربيع، صيف، خريف، شتاء'],
            ],
            3 => [
                ['question' => 'ما ناتج ٤٨ ÷ ٦؟', 'answer' => 'ناتج ٤٨ ÷ ٦ = ٨'],
                ['question' => 'أين يقع نهر النيل؟', 'answer' => 'نهر النيل يقع في شمال شرق أفريقيا'],
                ['question' => 'كم عدد قارات العالم؟', 'answer' => 'عدد قارات العالم سبع قارات'],
            ],
            4 => [
                ['question' => 'ما الجذر التربيعي لـ ٦٤؟', 'answer' => 'الجذر التربيعي لـ ٦٤ = ٨'],
                ['question' => 'من اكتشف الجاذبية؟', 'answer' => 'اكتشف الجاذبية العالم نيوتن'],
                ['question' => 'ما أكبر المحيطات؟', 'answer' => 'أكبر المحيطات هو المحيط الهادئ'],
            ],
        ];

        $stage = $this->faker->numberBetween(0, 11);

        // اختيار سؤال عشوائي للمرحلة أو إنشاء سؤال عام
        $availableQA = $questionsAnswers[$stage] ?? [];

        if (!empty($availableQA)) {
            $qa = $this->faker->randomElement($availableQA);
        } else {
            // للمراحل المتقدمة
            $qa = [
                'question' => $this->faker->sentence() . '؟',
                'answer' => $this->faker->paragraph(2)
            ];
        }

        return [
            'stage' => $stage,
            'question' => $qa['question'],
            'answer' => $qa['answer'],
            'status' => $this->faker->boolean(80), // 80% فعال
            'images' => $this->generateFakeImages(), // صور وهمية سريعة
        ];
    }

    /**
     * إنشاء مسارات صور وهمية (سريع جداً)
     */
    private function generateFakeImages()
    {
        $shouldHaveImages = $this->faker->boolean(30); // 30% من الأسئلة لها صور

        if (!$shouldHaveImages) {
            return [];
        }

        $imageCount = $this->faker->numberBetween(1, 2);
        $images = [];

        $sampleImages = [
            'faqs/math_diagram.jpg',
            'faqs/science_lab.jpg',
            'faqs/books_stack.jpg',
            'faqs/classroom.jpg',
            'faqs/student_study.jpg',
            'faqs/chemistry_formula.jpg',
            'faqs/geography_map.jpg',
            'faqs/physics_experiment.jpg',
        ];

        for ($i = 0; $i < $imageCount; $i++) {
            $images[] = $this->faker->randomElement($sampleImages);
        }

        return $images;
    }

    /**
     * إنشاء FAQ للمرحلة محددة
     */
    public function forStage($stage)
    {
        return $this->state(function (array $attributes) use ($stage) {
            return ['stage' => $stage];
        });
    }

    /**
     * إنشاء FAQ فعال
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return ['status' => true];
        });
    }

    /**
     * إنشاء FAQ غير فعال
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return ['status' => false];
        });
    }

    /**
     * إنشاء FAQ بدون صور
     */
    public function withoutImages()
    {
        return $this->state(function (array $attributes) {
            return ['images' => []];
        });
    }
}
