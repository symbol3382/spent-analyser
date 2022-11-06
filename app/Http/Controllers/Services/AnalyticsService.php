<?php

namespace App\Http\Controllers\Services;

use App\Models\Transaction;

class AnalyticsService {

    /**
     * // month active hours
     * // category wise spent // done
     * // spent line chart // done
     * // income / spent chart
     * //
     *
     */
    public function prepareAnalytics($transactions): array {
        $categoryWiseResult = $this->prepareCategoryWise($transactions);
        $dayWiseResult = $this->prepareDayWise($transactions);
        return [
            'categoryWiseSpentData' => $categoryWiseResult,
            'dayWiseSpentData'      => $dayWiseResult['dayWise'],
            'hourWiseSpentData'     => $dayWiseResult['hourWise'],
        ];
    }

    private function prepareDayWise($transactions): array {
        $dayWise = [];
        $hourWise = [];
        $dayFormat = 'Y-m-d';
        $hourFormat = 'Y-m-01 H:00:00';

        foreach ($transactions as $transaction) {
            if ($transaction->transaction_type !== Transaction::$transactionType_Debit) {
                continue;
            }
            $date = $transaction->transaction_time;

            $previous = $dayWise[$date->format($dayFormat)][1] ?? 0;
            $dayWise[$date->format($dayFormat)] = [$date->format($dayFormat), $previous + $transaction->amount];

            $previous = $hourWise[$date->format($hourFormat)][1] ?? 0;
            $hourWise[$date->format($hourFormat)] = [$date->format($hourFormat), $previous + $transaction->amount];
        }

        $hourKeys = array_values(collect(array_keys($hourWise))->sort()->toArray());
        $hourResult = [];
        foreach($hourKeys as $key) {
            $hourResult[] = $hourWise[$key];
        }

        return [
            'dayWise'  => array_values($dayWise),
            'hourWise' => array_values($hourResult)
        ];
    }

    private function prepareCategoryWise($transactions) {
        $topCategories = [];
        $categoryService = new CategoryService();

        $categoryWiseResult = [];

        foreach ($transactions as $transaction) {
            if ($transaction->transaction_type !== Transaction::$transactionType_Debit) {
                continue;
            }
            if (!isset($topCategories[$transaction->category->id])) {
                $parent = $categoryService->getTopParent($transaction->category);
                $topCategories[$transaction->category->id] = $parent;
            } else {
                $parent = $topCategories[$transaction->category->id];
            }

            $parentName = ucwords($parent->category_name);

            $previous = $categoryWiseResult[$parentName][1] ?? 0;
            $categoryWiseResult[$parentName] = [$parentName, $previous + $transaction->amount];
        }

        return array_values($categoryWiseResult);
    }


}
