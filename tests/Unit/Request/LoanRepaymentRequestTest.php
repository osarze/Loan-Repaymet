<?php

namespace Tests\Unit\Request;

use Tests\TestCase;
use App\Http\Requests\LoanRepaymentRequest;
use Illuminate\Support\Facades\Validator;

class LoanRepaymentRequestTest extends TestCase
{
    private $rules;
    private $testData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->rules = (new LoanRepaymentRequest())->rules();
        $this->testData = [
            'amount' => 345,
            'tenure' => mt_rand(1, 12),
            'repayment_day' => mt_rand(1,28),
            'interest' => 5
        ];
    }

    public function test_amount_is_required(){
        $this->testData['amount'] = '';
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertTrue($validator->fails());

        $this->testData['amount'] = 100;
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertFalse($validator->fails());
    }

    public function test_amount_must_be_number()
    {
        $this->testData['amount'] = '100dolls';
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertTrue($validator->fails());

        $this->testData['amount'] = '100';
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertFalse($validator->fails());

        $this->testData['amount'] = 100;
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertFalse($validator->fails());
    }

    public function test_tenure_is_required()
    {
        $this->testData['tenure'] = '';
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertTrue($validator->fails());

        $this->testData['tenure'] = 1;
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertFalse($validator->fails());
    }

    public function test_tenure_must_be_a_number()
    {
        $this->testData['tenure'] = '12dolls';
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertTrue($validator->fails());

        $this->testData['tenure'] = 2;
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertFalse($validator->fails());
    }

    public function test_tenure_must_be_any_number_from_1_to_12()
    {
        $this->testData['tenure'] = 0;
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertTrue($validator->fails());

        $this->testData['tenure'] = 13;
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertTrue($validator->fails());

        $this->testData['tenure'] = mt_rand(1, 12);
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertFalse($validator->fails());
    }

    public function test_repayment_day_is_required()
    {
        $this->testData['repayment_day'] = '';
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertTrue($validator->fails());

        $this->testData['repayment_day'] = 1;
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertFalse($validator->fails());
    }

    public function test_repayment_day_must_be_a_number()
    {
        $this->testData['repayment_day'] = '12dolls';
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertTrue($validator->fails());

        $this->testData['repayment_day'] = mt_rand(1, 31);
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertFalse($validator->fails());
    }

    public function test_repayment_day_must_be_any_number_from_1_to_31()
    {
        $this->testData['repayment_day'] = 0;
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertTrue($validator->fails());

        $this->testData['repayment_day'] = 32;
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertTrue($validator->fails());

        $this->testData['repayment_day'] = mt_rand(1, 31);
        $validator = Validator::make($this->testData, $this->rules);
        $this->assertFalse($validator->fails());
    }
}
