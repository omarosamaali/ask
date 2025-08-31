<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stageOne = Faq::where('stage', 1)->count();
        $stageTwo = Faq::where('stage', 2)->count();
        $stageThree = Faq::where('stage', 3)->count();
        $stageFour = Faq::where('stage', 4)->count();
        $stageFive = Faq::where('stage', 5)->count();
        $stageSix = Faq::where('stage', 6)->count();
        $stageSeven = Faq::where('stage', 7)->count();
        $stageEight = Faq::where('stage', 8)->count();
        $stageNine = Faq::where('stage', 9)->count();
        $stageTen = Faq::where('stage', 10)->count();
        $stageEleven = Faq::where('stage', 11)->count();
        $stageTwelve = Faq::where('stage', 12)->count();
        return view('admin.dashboard', compact('stageOne', 'stageTwo', 'stageThree', 'stageFour', 'stageFive', 'stageSix', 'stageSeven', 'stageEight', 'stageNine', 'stageTen', 'stageEleven', 'stageTwelve'));
    }
}
