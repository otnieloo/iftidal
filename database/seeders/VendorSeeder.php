<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::create([
            'vendor_status_id' => 1,
            'company_name' => 'Company Name 1',
            'company_phone' => '111111',
            'company_email' => 'Companyemail1@gmail.com',
            'company_address' => 'Company Address',
            'logo' => 'logo.png',
            'contact_person_name' => 'Contact Name',
            'contact_person_phone' => '089123123',
            'contact_person_email' => 'contactperson@gmail.com',
            'longitude' => '123123123',
            'latitude' => '123123',

        ]);
    }
}
