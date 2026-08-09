<?php

namespace App\Services;

class JazzCashService
{
    protected string $merchantId;
    protected string $password;
    protected string $integritySalt;
    protected string $endpoint;

    public function __construct()
    {
        $this->merchantId = env('JAZZCASH_MERCHANT_ID', 'MC12345');
        $this->password = env('JAZZCASH_PASSWORD', 'x4b8y5t1w4');
        $this->integritySalt = env('JAZZCASH_INTEGRITY_SALT', '3igox9lj0a');
        $this->endpoint = env('JAZZCASH_SANDBOX', true)
            ? 'https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/'
            : 'https://payments.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/';
    }

    /**
     * Build the signed field set for JazzCash's hosted "Purchase Form" redirect.
     * $amount is in whole rupees; JazzCash expects amount in paisas (x100).
     */
    public function buildCheckoutFields(string $txnRefNo, float $amount, string $returnUrl, string $description = 'Kimih Order'): array
    {
        $now = now();

        $fields = [
            'pp_Version' => '2.0',
            'pp_TxnType' => '',
            'pp_Language' => 'EN',
            'pp_MerchantID' => $this->merchantId,
            'pp_SubMerchantID' => '',
            'pp_Password' => $this->password,
            'pp_BankID' => '',
            'pp_ProductID' => '',
            'pp_TxnRefNo' => $txnRefNo,
            'pp_Amount' => (string) (int) round($amount * 100),
            'pp_TxnCurrency' => 'PKR',
            'pp_TxnDateTime' => $now->format('YmdHis'),
            'pp_BillReference' => $txnRefNo,
            'pp_Description' => $description,
            'pp_TxnExpiryDateTime' => $now->copy()->addHours(1)->format('YmdHis'),
            'pp_ReturnURL' => $returnUrl,
        ];

        $fields['pp_SecureHash'] = $this->generateSecureHash($fields);

        return [
            'action' => $this->endpoint,
            'fields' => $fields,
        ];
    }

    public function generateSecureHash(array $fields): string
    {
        $fields = array_filter($fields, fn ($value) => $value !== null && $value !== '');
        ksort($fields);

        $hashString = $this->integritySalt . '&' . implode('&', $fields);

        return strtoupper(hash_hmac('sha256', $hashString, $this->integritySalt));
    }

    public function verifyResponse(array $response): bool
    {
        if (empty($response['pp_SecureHash'])) {
            return false;
        }

        $received = $response['pp_SecureHash'];
        $toVerify = $response;
        unset($toVerify['pp_SecureHash']);

        return hash_equals($this->generateSecureHash($toVerify), $received);
    }

    public function isSuccessful(array $response): bool
    {
        return isset($response['pp_ResponseCode']) && $response['pp_ResponseCode'] === '000';
    }
}
