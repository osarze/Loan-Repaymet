<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\LoanRepaymentRequest;

class LoanRepaymentController extends Controller
{
    /**
     *
     */
    public function calculateRepayment(LoanRepaymentRequest $request)  {
        $loanAmount = $request->amount;
        $tenure = $request->tenure;
        $repaymentDay = $request->repayment_day;
        $interestPercentage = 5;

        $interestAmount = $interestPercentage/100 * $loanAmount;

        $totalLoanRepaymentAmount = $loanAmount + $interestAmount;

        $monthlyLoanRepaymentAmount = $totalLoanRepaymentAmount/$tenure;

        $monthlyRepaymentData = array();

        for ($i = 1 ; $i <= $tenure ; $i++) {
            $monthlyRepaymentData[$i] = [
                'amount' => round($monthlyLoanRepaymentAmount, 2, PHP_ROUND_HALF_UP),
                'day' => $repaymentDay
            ];
        }


        return [
            'total_amount' => $totalLoanRepaymentAmount,
            'repayment_plan' => $monthlyRepaymentData
        ];
    }
}
