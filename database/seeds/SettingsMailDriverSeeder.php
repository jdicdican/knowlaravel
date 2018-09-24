<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Services\Mailer\Mailer;

class SettingsMailDriverSeeder extends Seeder
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
            'key' => 'driver_default',
            'value' => Mailer::SENDGRID,
        ]);
    }
}
