<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'group' => 'mail',
            'key' => 'from_email',
            'value' => 'noreply@knowlaravel.com',
        ]);

        Setting::create([
            'group' => 'mail',
            'key' => 'from_name',
            'value' => 'Know Laravel (no reply)',
        ]);
    }
}
