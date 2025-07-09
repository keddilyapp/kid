<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Language; // Make sure to import the Language model here
class MultiLanguageSeeder extends Seeder
{
    public function run()
    {
        $languages = [
            [
                'name' => 'English (US)',
                'slug' => 'en_US',
                'direction' => 0,
                'default' => 0,
                'status' => 1,
            ],
            [
                'name' => 'English (GB)',
                'slug' => 'en_GB',
                'direction' => 0,
                'default' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Spanish',
                'slug' => 'es_ES',
                'direction' => 0,
                'default' => 0,
                'status' => 1,
            ],
            [
                'name' => 'French',
                'slug' => 'fr_FR',
                'direction' => 0,
                'default' => 0,
                'status' => 1,
            ],
            [
                'name' => 'German',
                'slug' => 'de_DE',
                'direction' => 0,
                'default' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Arabic',
                'slug' => 'ar',
                'direction' => 1,
                'default' => 0,
                'status' => 1,
            ],
        ];

        foreach ($languages as $language) {
            Language::updateOrCreate(
                ['slug' => $language['slug']],
                $language
            );
        }
    }
}