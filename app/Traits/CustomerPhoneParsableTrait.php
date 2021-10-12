<?php

namespace App\Traits;

/**
 * Trait CustomerPhoneParsableTrait
 * @package App\Traits
 */
trait CustomerPhoneParsableTrait
{
    /**
     * @param $phones
     * @return array
     */
    public function parse($phones): array
    {
        $parsed = [];
        foreach ($phones as $key => $value)
        {
            $phoneArray = explode(' ', $value['phone']);

            $parsed[$key]['country'] = $this->getCountry($value['phone']);
            $parsed[$key]['state'] = $this->getState($value['phone']);
            $parsed[$key]['code'] = $this->getCode($value['phone']);
            $parsed[$key]['number'] = end($phoneArray);
        }

        return $parsed;
    }

    /**
     * @param $value
     * @return string
     */
    public function getCountry($value): string
    {
        $country = '';

        foreach ($this->countriesConfig as $key => $validator)
        {
            preg_match('/' . substr($validator['regex'], 0, 10) . '/', $value, $matches);

            if (sizeof($matches) > 0) {
                $country = $key;
            }
        }

        return $country;
    }

    /**
     * @param $value
     * @return bool
     */
    public function getState($value): bool
    {
        $valid = false;

        foreach ($this->countriesConfig as $validator)
        {
            preg_match('/' . $validator['regex'] . '/', $value, $matches);

            if (sizeof($matches) > 0) {
                $valid = true;
            }
        }

        return $valid;
    }

    /**
     * @param $value
     * @return string
     */
    public function getCode($value): string
    {
        $code = '';

        foreach ($this->countriesConfig as $validator)
        {
            preg_match('/' . substr($validator['regex'], 0, 10) . '/', $value, $matches);

            if (sizeof($matches) > 0) {
                $code = $validator['code'];
            }
        }

        return $code;
    }
}
