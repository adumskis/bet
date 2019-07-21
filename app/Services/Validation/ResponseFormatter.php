<?php

namespace App\Services\Validation;

use Illuminate\Support\Arr;

/**
 * Class ResponseFormatter
 * @package App\Services\Validation
 */
class ResponseFormatter
{
    /**
     * @param array $requestData
     * @param array|ValidationError[] $errors
     * @return array
     */
    public function format(array $requestData, array $errors): array
    {
        foreach ($errors as $error) {
            $displayKey = $error->getDisplayKey();
            $requestErrors = Arr::get($requestData, $displayKey, []);
            $requestErrors[] = $error->toArray();
            Arr::set($requestData, $displayKey, $requestErrors);
        }

        return $requestData;
    }
}
