<?php
namespace App\Services;

use Propaganistas\LaravelPhone\PhoneNumber;

class PhoneService
{
    public function getCountryByPhone($number): ?string
    {
        $phone = new PhoneNumber($number);

        return $phone->getCountry();
    }
}
