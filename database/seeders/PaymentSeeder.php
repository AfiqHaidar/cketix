<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            [
                'payment' => 'Bank',
            ],
            [
                'payment' => 'QRIS',
            ],
            [
                'payment' => 'Credit Card',
            ],
            [
                'payment' => 'Cash',
            ],
            [
                'payment' => 'PayPal',
            ],
            // Add more payment methods as needed
        ];

        foreach ($payments as $payment) {
            PaymentMethod::create($payment);
        }
    }
}
