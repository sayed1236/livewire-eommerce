<?php

namespace Modules\Admin\Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocialMedia::create(
            array(
                'ord' => 1,
                'ord_footer' => 1,
                'name' => 'facebok',
                'url_link' => 'https://www.facebook.com/',
                'img' => '<i class="icon-lg fab fa-facebook"></i>',
                'img_type' => 'icon',
                'is_active' => 'Y',

            )
        );
        SocialMedia::create(
            array(
                'ord' => 2,
                'ord_footer' => 2,
                'name' => 'twitter',
                'url_link' => 'https://www.twitter.com/',
                'img' => '<i class="icon-lg fab fa-twitter-square"></i>',
                'img_type' => 'icon',
                'is_active' => 'Y',

            )
        );
        SocialMedia::create(
            array(
                'ord' => 3,
                'ord_footer' => 3,
                'name' => 'instagram',
                'url_link' => 'https://www.instagram.com/',
                'img' => '<i class="icon-lg fab fa-instagram-square"></i>',
                'img_type' => 'icon',
                'is_active' => 'Y',

            )
        );
        SocialMedia::create(
            array(
                'ord' => 4,
                'ord_footer' => 4,
                'name' => 'youtube',
                'url_link' => 'https://www.youtube.com/',
                'img' => '<i class="icon-lg fab fa-youtube"></i>',
                'img_type' => 'icon',
                'is_active' => 'Y',

            )
        );
        SocialMedia::create(
            array(
                'ord' => 5,
                'ord_footer' => 5,
                'name' => 'linkedin',
                'url_link' => 'https://www.linkedin.com/',
                'img' => '<i class="icon-lg fab fa-linkedin"></i>',
                'img_type' => 'icon',
                'is_active' => 'Y',

            )
        );
        SocialMedia::create(
            array(
                'ord' => 6,
                'ord_footer' => 6,
                'name' => 'pinterest',
                'url_link' => 'https://www.pinterest.com/',
                'img' => '<i class="icon-lg fab fa-pinterest"></i>',
                'img_type' => 'icon',
                'is_active' => 'Y',

            )
        );

    }
}
