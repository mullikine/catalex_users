<?php

namespace App\Library;

class Billing
{
    const DECIMAL_PLACES = 2;
    const DAYS_IN_TRIAL_PERIOD = 14;

	/**
	 * Calculate the included GST component given an inclusive total. Works with string
	 * representations of numbers to be easily intergrated with bc math.
	 *
	 * @param  string $totalAmount
	 * @return string
	 */
	public static function includingGst($totalAmount)
    {
        // IRD recommended way of calculating GST: (total amount x 3) / 23
        $totalAmountTimesThree = bcmul((string) $totalAmount, '3', 2);
        $totalGst = bcdiv($totalAmountTimesThree, '23', 2);

        return self::formatDollars($totalGst);
	}
    
    /**
     * Subtract discount for a value
     *
     * @param $amount
     * @param $discountPercent
     *
     * @return string
     */
	public static function applyDiscount($amount, $discountPercent)
    {
        $payPercent = bcsub('100', (string) $discountPercent);
        $amountAfterDiscount = bcmul((string) $amount, $payPercent);
        
        return $amountAfterDiscount;
    }

	/**
	 * Convert number of cents to a string with the dollar amount
	 */
    public static function centsToDollars($cents)
    {
        $dollars = bcdiv($cents, 100, 2);
        return number_format($dollars, self::DECIMAL_PLACES, null, '');
    }

    /**
     * Format dollars with commas and the correct decimal places
     */
    public static function formatDollars($dollars)
    {
        return number_format($dollars, self::DECIMAL_PLACES);
    }
}
