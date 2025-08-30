<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run()
    {
        // إنشاء أسئلة محددة لكل مرحلة (سريع)
        for ($stage = 0; $stage <= 11; $stage++) {
            // 2 أسئلة فعالة لكل مرحلة
            Faq::factory(2)
                ->forStage($stage)
                ->active()
                ->withoutImages()
                ->create();
        }

        // إنشاء بعض الأسئلة المميزة
        $specialFaqs = [
            [
                'stage' => 5,
                'question' => 'ما هي خصائص المثلث متساوي الأضلاع؟',
                'answer' => 'المثلث متساوي الأضلاع له ثلاثة أضلاع متساوية وثلاث زوايا متساوية كل منها 60 درجة',
                'status' => true,
                'images' => ['faqs/math_diagram.jpg']
            ],
            [
                'stage' => 7,
                'question' => 'ما هو قانون حفظ الطاقة؟',
                'answer' => 'قانون حفظ الطاقة ينص على أن الطاقة لا تفنى ولا تستحدث من العدم ولكنها تتحول من شكل إلى آخر',
                'status' => true,
                'images' => ['faqs/physics_experiment.jpg']
            ],
            [
                'stage' => 9,
                'question' => 'ما هو الفرق بين الخلية النباتية والخلية الحيوانية؟',
                'answer' => 'الخلية النباتية تحتوي على جدار خلوي وبلاستيدات خضراء وفجوة كبيرة، بينما الخلية الحيوانية لا تحتوي على هذه المكونات',
                'status' => true,
                'images' => ['faqs/science_lab.jpg', 'faqs/biology_cell.jpg']
            ]
        ];

        foreach ($specialFaqs as $faqData) {
            Faq::create($faqData);
        }

        $this->command->info('تم إنشاء ' . Faq::count() . ' سؤال بنجاح!');
    }
}
