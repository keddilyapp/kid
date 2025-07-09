
<?php

namespace App\Helpers;

class CurrencyConversionHelper
{
    /**
     * Convert amount from source currency to target currency
     */
    public static function convertCurrency($amount, $fromCurrency, $toCurrency)
    {
        // If currencies are the same, return original amount
        if ($fromCurrency === $toCurrency) {
            return $amount;
        }
        
        // Get exchange rate from settings
        $exchange_rate_key = strtolower($fromCurrency) . '_to_' . strtolower($toCurrency) . '_exchange_rate';
        $exchange_rate = get_static_option($exchange_rate_key);
        
        if (empty($exchange_rate)) {
            // Fallback to hardcoded rates or default
            $rates = [
                'EGY_to_USD' => 0.032, // 1 EGY = 0.032 USD (update with current rate)
                'USD_to_EGY' => 31.25, // 1 USD = 31.25 EGY (update with current rate)
            ];
            
            $rate_key = strtoupper($fromCurrency) . '_to_' . strtoupper($toCurrency);
            $exchange_rate = $rates[$rate_key] ?? 1;
        }
        
        return round($amount * $exchange_rate, 2);
    }
    
    /**
     * Get PayTabs compatible currency and converted amount
     */
    public static function getPayTabsCompatibleCurrency($amount, $currency)
    {
        $supported_currencies = ['USD', 'EUR', 'SAR', 'AED', 'KWD', 'BHD', 'QAR', 'OMR', 'JOD'];
        
        if (in_array($currency, $supported_currencies)) {
            return [
                'amount' => $amount,
                'currency' => $currency
            ];
        }
        
        // Convert to USD if currency not supported
        $converted_amount = self::convertCurrency($amount, $currency, 'USD');
        
        return [
            'amount' => $converted_amount,
            'currency' => 'USD'
        ];
    }
}