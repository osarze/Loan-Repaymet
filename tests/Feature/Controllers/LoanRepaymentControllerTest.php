<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoanRepaymentControllerTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function test_loan_calculation_route_is_validated()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Validation\ValidationException');

        $response = $this->postJson('/api/loan/calculate-repayment');
    }

    public function test_loan_repayment_plan_calculated_and_returned(){
        // dd(round(34.2233323, 2, PHP_ROUND_HALF_UP));
        $interest = 5;
        $data = [
            'amount' => 1000,
            'tenure' => 12,
            'repayment_day' => 15,
            'interest' => $interest
        ];

        $this->postJson('/api/loan/calculate-repayment', $data)
        ->assertStatus(200)
        ->assertJson([
            'total_amount' => 1050,
            'repayment_plan' => [
                1 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
                2 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
                3 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
                4 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
                5 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
                6 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
                7 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
                8 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
                9 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
                10 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
                11 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
                12 => [
                    'amount' => 87.50,
                    'day' => $data['repayment_day'],
                ],
            ]
        ]);

        $data['tenure'] = 6;

        $this->postJson('/api/loan/calculate-repayment', $data)
        ->assertStatus(200)
        ->assertJson([
            'total_amount' => 1050,
            'repayment_plan' => [
                1 => [
                    'amount' => 175,
                    'day' => $data['repayment_day'],
                ],
                2 => [
                    'amount' => 175,
                    'day' => $data['repayment_day'],
                ],
                3 => [
                    'amount' => 175,
                    'day' => $data['repayment_day'],
                ],
                4 => [
                    'amount' => 175,
                    'day' => $data['repayment_day'],
                ],
                5 => [
                    'amount' => 175,
                    'day' => $data['repayment_day'],
                ],
                6 => [
                    'amount' => 175,
                    'day' => $data['repayment_day'],
                ],
            ]
        ]);

        $data['tenure'] = 9;
        $data['amount'] = 55555;

        $this->postJson('/api/loan/calculate-repayment', $data)
        ->assertStatus(200)
        ->assertJson([
            'total_amount' => 58332.75,
            'repayment_plan' => [
                1 => [
                    'amount' => 6481.42,
                    'day' => $data['repayment_day'],
                ],
                2 => [
                    'amount' => 6481.42,
                    'day' => $data['repayment_day'],
                ],
                3 => [
                    'amount' => 6481.42,
                    'day' => $data['repayment_day'],
                ],
                4 => [
                    'amount' => 6481.42,
                    'day' => $data['repayment_day'],
                ],
                5 => [
                    'amount' => 6481.42,
                    'day' => $data['repayment_day'],
                ],
                6 => [
                    'amount' => 6481.42,
                    'day' => $data['repayment_day'],
                ],
                7 =>[
                    'amount' => 6481.42,
                    'day' => $data['repayment_day'],
                ],
                8 => [
                    'amount' => 6481.42,
                    'day' => $data['repayment_day'],
                ],
                9 => [
                    'amount' => 6481.42,
                    'day' => $data['repayment_day'],
                ],
            ]
        ]);

    }
}
