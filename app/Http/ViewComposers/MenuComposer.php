<?php

namespace App\Http\ViewComposers;

use App\Models\Contact;
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
        $networks = Network::status()->get();
        $contact = Contact::findOrFail(1);
        $solutions = Solution::status()->get();

        $view->with([
            'networks' => $networks,
            'contact' => $contact,
            'solutions' => $solutions,
        ]);
    }
}
