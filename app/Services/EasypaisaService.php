<?php

namespace App\Services;

/**
 * Easypaisa "EasyPay" hosted-checkout integration.
 *
 * Unlike JazzCash, Easypaisa does not publish a universal public sandbox
 * merchant — Store ID / Hash Key / exact endpoint URL are issued per-merchant
 * when you sign up at https://easypaisa.com.pk/business (or via your Telenor
 * Microfinance Bank business relationship manager). Fill EASYPAISA_STORE_ID,
 * EASYPAISA_HASH_KEY and EASYPAISA_ENDPOINT in .env once you have them, and
 * confirm the field names/hash order below against the integration guide
 * they send you — Easypaisa has more than one API product (EasyPay OpenAPI
 * vs InstaPay) and field names differ between them.
 */
class EasypaisaService
{
    protected string $storeId;
    protected string $hashKey;
    protected string $endpoint;

    public function __construct()
    {
        $this->storeId = env('EASYPAISA_STORE_ID', '');
        $this->hashKey = env('EASYPAISA_HASH_KEY', '');
        $this->endpoint = env('EASYPAISA_SANDBOX', true)
            ? env('EASYPAISA_SANDBOX_URL', 'https://easypaystg.easypaisa.com.pk/easypay/Index.jsf')
            : env('EASYPAISA_LIVE_URL', 'https://easypay.easypaisa.com.pk/easypay/Index.jsf');
    }

    public function isConfigured(): bool
    {
        return $this->storeId !== '' && $this->hashKey !== '';
    }

    /**
     * Build the signed field set for Easypaisa's hosted checkout redirect.
     * $amount is in whole rupees.
     */
    public function buildCheckoutFields(string $orderRefNum, float $amount, string $postBackUrl): array
    {
        $expiryDate = now()->addHours(1)->format('YmdHis');

        $fields = [
            'storeId' => $this->storeId,
            'amount' => number_format($amount, 1, '.', ''),
            'postBackURL' => $postBackUrl,
            'orderRefNum' => $orderRefNum,
            'expiryDate' => $expiryDate,
            'autoRedirect' => '1',
            'paymentMethod' => 'MA_PAYMENT_METHOD',
        ];

        $fields['merchantHashedReq'] = $this->generateHash($fields);

        return [
            'action' => $this->endpoint,
            'fields' => $fields,
        ];
    }

    public function generateHash(array $fields): string
    {
        $hashString = implode('&', [
            'amount=' . $fields['amount'],
            'storeId=' . $fields['storeId'],
            'postBackURL=' . $fields['postBackURL'],
            'orderRefNum=' . $fields['orderRefNum'],
            'expiryDate=' . $fields['expiryDate'],
        ]);

        return base64_encode(hash_hmac('sha256', $hashString, $this->hashKey, true));
    }

    public function isSuccessful(array $response): bool
    {
        return isset($response['status']) && strtolower($response['status']) === 'success';
    }
}
