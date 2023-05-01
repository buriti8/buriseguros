<?php

namespace App\Http\ViewComposers;

use App\Models\Information;
use App\Models\Network;
use App\Models\Solution;
use Illuminate\Contracts\View\View;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $information = Information::get()->first();
        $networks = Network::status()->get();
        $solutions = Solution::status()->get();

        $view->with([
            'information' => $information,
            'networks' => $networks,
            'solutions' => $solutions,
        ]);
    }
}
