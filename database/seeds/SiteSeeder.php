<?php

use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = [
            /* [
            'id' => '1',
            'host' => 'abstract.inc.treyventures.com',
            'name' => 'Abstract Tokenization',
            'logo' => '/img/abstract-logo.svg',
            'logo_dark' => '/img/abstract-logo.svg',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ],
        [
            'id' => '2',
            'host' => 'acg.abstract.inc.treyventures.com',
            'name' => 'American Capital group',
            'logo' => '/img/acg-logo.svg',
            'logo_dark' => '/img/acg-dark-logo.svg',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ] */
        [
            'id' => '1',
            'host' => 'abstract.test',
            'name' => 'Abstract Tokenization',
            'logo' => '/img/abstract-logo.svg',
            'logo_dark' => '/img/abstract-logo.svg',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ],
        [
            'id' => '2',
            'host' => 'cre.test',
            'name' => 'American Capital group',
            'logo' => '/img/acg-logo.svg',
            'logo_dark' => '/img/acg-dark-logo.svg',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]];
        DB::table('sites')->insert($sites);
    }
}
