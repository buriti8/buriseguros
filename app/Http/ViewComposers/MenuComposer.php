<?php

namespace App\Http\ViewComposers;

use App\Models\Contact;
use App\Models\Insurance;
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
        $personals = Insurance::status()->solution(Solution::PERSONAL)->get();
        $businesses = Insurance::status()->solution(Solution::BUSINESS)->get();

        $view->with([
            'networks' => $networks,
            'contact' => $contact,
            'personals' => $personals,
            'businesses' => $businesses,
        ]);
    }
}
