<?php

namespace Database\Seeders;

use App\Http\Controllers\ShortLinkController;
use App\Jobs\CrawlerPageTitle;
use App\Models\ShortLink;
use Illuminate\Database\Seeder;

class ShortLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = ShortLink::factory()->count(50)->create();

        foreach ($links as $link) {
            $link->short = ShortLinkController::encode($link->id);
            $link->save();
            CrawlerPageTitle::dispatch($link);
        }

    }
}
