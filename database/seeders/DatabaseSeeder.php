<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Faq;
use App\Models\Job;
use App\Models\User;
use \App\Models\Post;
use App\Models\Tabel;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Inmessage;
use App\Models\Outmessage;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Dtlpack;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // User::create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('123123')
        // ]);

        // User::create([
        //     'name' => 'Test2 User',
        //     'email' => 'test2@example.com',
        //     'password' => bcrypt('qweqwe')
        // ]);

        //=====================================
        User::create([
            'username' => 'qwe',
            'employee_id' => '1',
            'email' => 'qwr@example.com',
            'password' => bcrypt('qwe')
        ]);

        Category::create([
            'tabel_id' => '8',
            'name' => 'Owner',
            'slug' => 'owner',
        ]);

        Employee::create([
            'category_id' => '1',
            'nama' => 'Febri Ayu L',
            'jk' => 'Wanita',
            'no_telp' => '+62 813-7775-9997'
        ]);

        //=====================================
        // Category::create([
        //     'tabel_id' => '1',
        //     'name' => 'Manicure',
        //     'slug' => 'manicure',
        // ]);

        // Category::create([
        //     'tabel_id' => '1',
        //     'name' => 'Padicure',
        //     'slug' => 'padicure',
        // ]);

        // Category::create([
        //     'tabel_id' => '2',
        //     'name' => 'Perawatan Rambut',
        //     'slug' => 'perawatan-rambut',
        // ]);

        // Category::create([
        //     'tabel_id' => '2',
        //     'name' => 'Lulur',
        //     'slug' => 'lulur',
        // ]);

        // Category::create([
        //     'tabel_id' => '2',
        //     'name' => 'Pijat',
        //     'slug' => 'pijat',
        // ]);

        // Category::create([
        //     'tabel_id' => '3',
        //     'name' => 'Pembersih Wajah',
        //     'slug' => 'pembersih-wajah',
        // ]);

        // Category::create([
        //     'tabel_id' => '3',
        //     'name' => 'Alat Kecantikan',
        //     'slug' => 'alat-kecantikan',
        // ]);

        // Category::create([
        //     'tabel_id' => '4',
        //     'name' => 'Pembelian',
        //     'slug' => 'pembelian',
        // ]);

        // Category::create([
        //     'tabel_id' => '4',
        //     'name' => 'Login',
        //     'slug' => 'login',
        // ]);

        // Category::create([
        //     'tabel_id' => '6',
        //     'name' => 'Informasi',
        //     'slug' => 'informasi',
        // ]);

        // Category::create([
        //     'tabel_id' => '6',
        //     'name' => 'Promo',
        //     'slug' => 'promo',
        // ]);

        //=====================================
        Tabel::create([
            'name' => 'Post',
            'link' => 'formulir/blogs',
        ]);

        Tabel::create([
            'name' => 'Service',
            'link' => 'formulir/services',
        ]);

        Tabel::create([
            'name' => 'Product',
            'link' => 'formulir/products',
        ]);

        Tabel::create([
            'name' => 'FAQs',
            'link' => 'formulir/faqs',
        ]);

        Tabel::create([
            'link' => 'pesans#inbox',
        ]);

        Tabel::create([
            'name' => 'Message',
            'link' => 'pesans#sent',
        ]);

        Tabel::create([
            'link' => 'schedules',
        ]);

        Tabel::create([
            'name' => 'Job'
        ]);

        //=====================================
        // Faq::factory(11)->create();
        // Customer::factory(8)->create();
        // User::factory(4)->create();
        // Service::factory(6)->create();
        // Appointment::factory(5)->create();
        // Product::factory(20)->create();
        // Employee::factory(5)->create();
        // Post::factory(20)->create();
        // Outmessage::factory(8)->create();
        // Inmessage::factory(8)->create();
        // Notification::factory(4)->create();
        // Package::factory(4)->create();
        // Dtlpack::factory(12)->create();
    }
}
