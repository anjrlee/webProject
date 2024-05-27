<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleLink;

class ArticleLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            ['article_id' => 1, 'link' => 'https://im.mgt.ncu.edu.tw/'],
            ['article_id' => 1, 'link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
            ['article_id' => 2, 'link' => 'https://pdc.adm.ncu.edu.tw/#&panel1-1'],
            ['article_id' => 3, 'link' => 'http://www.atm.ncu.edu.tw/'],
            ['article_id' => 3, 'link' => 'https://www.youtube.com/watch?v=632gA4P-fB4'],
            ['article_id' => 4, 'link' => 'https://ncusec.ncu.edu.tw/secretariat/'],
            ['article_id' => 5, 'link' => 'https://w2.math.ncu.edu.tw/'],
            ['article_id' => 6, 'link' => 'https://cis.ncu.edu.tw/iNCU/messageNotice/activityManagement/activity/548'],
            ['article_id' => 6, 'link' => 'https://cis.ncu.edu.tw/iNCU/messageNotice/activityManagement/activity/540'],
            ['article_id' => 7, 'link' => 'https://service-learning.ncu.edu.tw/activities/activityInfo/28336']
        ];

        foreach ($links as $link) {
            ArticleLink::create($link);
        }
    }
}
