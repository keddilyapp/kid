
<?php

namespace App\Helpers\Payment;

use App\Models\StaticOption;

class PayTabsCurrencyHelper
{
    /**
     * Convert amount to EGY if needed for PayTabs
     * 
     * @param float $amount
     * @param string $currentCurrency
     * @return array
     */
    public static function convertToEgyIfNeeded($amount, $currentCurrency)
    {
        // PayTabs supported currencies
        $supportedCurrencies = [
            'EGP', 'USD', 'EUR', 'SAR', 'AED', 'KWD', 'BHD', 'QAR', 'OMR', 'JOD'
        ];
        
        // If current currency is already supported, return as is
        if (in_array(strtoupper($currentCurrency), $supportedCurrencies)) {
            return [
                'amount' => $amount,
                'currency' => strtoupper($currentCurrency),
                'converted' => false
            ];
        }
        
        // Convert to EGY
        $egyExchangeRate = get_static_option('paytabs_egy_exchange_rate') ?? 1;
        $convertedAmount = $amount * $egyExchangeRate;
        
        return [
            'amount' => $convertedAmount,
            'currency' => 'EGP',
            'converted' => true,
            'original_amount' => $amount,
            'original_currency' => $currentCurrency,
            'exchange_rate' => $egyExchangeRate
        ];
    }
    
    /**
     * Get PayTabs supported currencies
     * 
     * @return array
     */
    public static function getSupportedCurrencies()
    {
        return [
            'EGP' => 'Egyptian Pound',
            'USD' => 'US Dollar',
            'EUR' => 'Euro',
            'SAR' => 'Saudi Riyal',
            'AED' => 'UAE Dirham',
            'KWD' => 'Kuwaiti Dinar',
            'BHD' => 'Bahraini Dinar',
            'QAR' => 'Qatari Riyal',
            'OMR' => 'Omani Rial',
            'JOD' => 'Jordanian Dinar'
        ];
    }
}