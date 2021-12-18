<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class Recaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //Google reCAPTCHA驗證
        if (config('services.recaptcha_enable') == true) {
            return $this->verify($value);
        }

        return true;
    }

    /**
     * 驗證Google reCAPTCHA token.
     */
    private function verify(string $token = null)
    {
        $url = config('services.recaptcha_url');

        $response = (new Client())->request('POST', $url, [
            'form_params' => [
                'secret' => config('services.recaptcha_secret_key'),
                'response' => $token,
            ],
        ]);

        $code = $response->getStatusCode();
        $content = json_decode($response->getBody()->getContents());

        return $code == 200 && $content->success == true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Google reCAPTCHA 驗證失敗';
    }
}
