<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['title' => 'Google Analytics', 'key' => 'google_analytics', 'value' => null, 'active' => false],

            // Social
            ['title' => 'Facebook', 'key' => 'facebook', 'value' => 'https://facebook.com', 'active' => false],
            ['title' => 'Instagram', 'key' => 'instagram', 'value' => 'https://instagram.com', 'active' => false],
            ['title' => 'LinkedIn', 'key' => 'linkedin', 'value' => 'https://linkedin.com', 'active' => false],
            ['title' => 'Whatsapp', 'key' => 'whatsapp', 'value' => 'https://whatsapp.com', 'active' => false],
        ];

        foreach($settings as $setting):
            Setting::create([
                'title' => $setting['title'],
                'key' => $setting['key'],
                'value' => $setting['value'],
                'active' => $setting['active']
            ]);
        endforeach;
    }
}
