<?php

use Illuminate\Database\Seeder;
use App\PList;


class ListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = new PList();

        collect(config('lists.default'))->each(function($options, $list_name) use($list) {
            collect($options)->each(function($option_name) use($list, $list_name) {
                $exist = PList::where('list', $list_name)->where('option', $option_name)->first();
                if (!$exist) {
                    $list->newQuery()->updateOrCreate([
                        'list' => $list_name,
                        'option' => $option_name,
                        'status' => 1,
                    ]);
                }
            });
        });
    }
}
