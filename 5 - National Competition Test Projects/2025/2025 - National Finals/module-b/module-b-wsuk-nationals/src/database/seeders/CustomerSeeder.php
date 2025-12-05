<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'cust_id' => 1,
            'cust_fname' => 'John',
            'cust_lname' => 'Doe',
            'cust_phone' => '07123456689',
            'cust_addr1' => '123 Street',
            'cust_postcode' => 'AB12CD',
            'cust_email' => 'john.doe@mail.com',
        ]);

        Customer::create([
            'cust_id' => 2,
            'cust_fname' => 'Alice',
            'cust_lname' => 'Smith',
            'cust_phone' => '07111222333',
            'cust_addr1' => '456 Avenue',
            'cust_postcode' => 'CD34EF',
            'cust_email' => 'alice.smith@mail.com',
        ]);

        Customer::create([
            'cust_id' => 3,
            'cust_fname' => 'Michael',
            'cust_lname' => 'Brown',
            'cust_phone' => '07987654321',
            'cust_addr1' => '789 Boulevard',
            'cust_postcode' => 'EF56GH',
            'cust_email' => 'michael.brown@mail.com',
        ]);

        // New customers
        Customer::create([
            'cust_id' => 4,
            'cust_fname' => 'Emily',
            'cust_lname' => 'Davis',
            'cust_phone' => '07456789123',
            'cust_addr1' => '22 Green Lane',
            'cust_addr2' => 'Flat 3A',
            'cust_postcode' => 'GH78IJ',
            'cust_email' => 'emily.davis@mail.com',
        ]);

        Customer::create([
            'cust_id' => 5,
            'cust_fname' => 'Olivia',
            'cust_lname' => 'Wilson',
            'cust_phone' => '07555667788',
            'cust_addr1' => '10 Kings Road',
            'cust_postcode' => 'JK90LM',
            'cust_email' => 'olivia.wilson@mail.com',
        ]);

        Customer::create([
            'cust_id' => 6,
            'cust_fname' => 'Sophie',
            'cust_lname' => 'Taylor',
            'cust_phone' => '07711223344',
            'cust_addr1' => '5 Orchard View',
            'cust_postcode' => 'MN12OP',
            'cust_email' => 'sophie.taylor@mail.com',
        ]);

        Customer::create([
            'cust_id' => 7,
            'cust_fname' => 'David',
            'cust_lname' => 'Smith',
            'cust_phone' => '07741283244',
            'cust_addr1' => '2 Paddington Street',
            'cust_postcode' => 'SW12EP',
            'cust_email' => 'david.smith@mail.com',
        ]);

        Customer::create([
            'cust_id' => 8,
            'cust_fname' => 'Marcus',
            'cust_lname' => 'Wilson',
            'cust_phone' => '07515647758',
            'cust_addr1' => '10 Kings Road',
            'cust_postcode' => 'JK90LM',
            'cust_email' => 'marcus.wilson@mail.com',
        ]);
    }
}
