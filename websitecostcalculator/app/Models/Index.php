<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    use HasFactory;

    public function information(): array
    {
        return [
            /** About the project */
            'new_project' => [
                'price' => 100
            ],
            'redesign' => [
                'price' => 500
            ],

            /** Time for the project */
            'time_2_3_months' => [
                'price' => 50
            ],
            'time_1_month' => [
                'price' => 3000
            ],
            'time_1_week' => [
                'price' => 6000
            ],

            /** a page number price */
            'number-page' => [
                'price' => 900
            ],

            /** Types of website */
            'static_type' => [
                'price' => 1000
            ],
            'business_type' => [
                'price' => 5000
            ],
            'ecommerce_type' => [
                'price' => 10000
            ],
            'blog_type' => [
                'price' => 2000
            ],

            /** CMS system */
            'wordpress' => [
                'price' => 500
            ],
            'magento' => [
                'price' => 4000
            ],
            'shopware' => [
                'price' => 5000
            ],
            'woo_commerce' => [
                'price' => 2000
            ],

            /** Design prices */
            'no_design' => [
                'price' => 500
            ],
            'simple_design' => [
                'price' => 3000
            ],
            'moderately_design' => [
                'price' => 5000
            ],
            'high-end_design' => [
                'price' => 10000
            ],
            'world-class_design' => [
                'price' => 15000
            ],


//            'copy-write-page' => [
//                'price' => 150
//            ],
            /** Add ons */
            'domain' => [
                'price' => 50
            ],
            'hosting' => [
                'price' => 100
            ],
            'responsive' => [
                'price' => 0
            ],
            'multi_langual' => [
                'price' => 1000
            ],
            'market' => [
                'price' => 22500
            ],
            'newsletter' => [
                'price' => 1200
            ],
            'online_booking' => [
                'price' => 1500
            ],
            'event_reservation' => [
                'price' => 1500
            ],
            'livechat' => [
                'price' => 800
            ],
            'seo' => [
                'price' => 50
            ],
            'sea' => [
                'price' => 50
            ],
            'logo' => [
                'price' => 2000
            ],
            'animation' => [
                'price' => 50
            ],

            /** Database integration */
            'basic-db_integration' => [
                'price' => 4000
            ],
            'advanced-db_integration' => [
                'price' => 4000
            ],
            'full_development-db_integration' => [
                'price' => 25000
            ],
        ];
    }
}
