<?php

class Answers
{
    protected const INVALID_PARAMS = 'Invalid params';
    protected bool $exceptionOnErrors = false;
    protected bool $offErrors = true;

    /**
     * 1) need to do a transformation of the array with diff numbers [1  ... n]
     * - we need to reverse it without using the reverse method and return in format [n  ... 1].
     * Arguments: array
     * Result: array
     * @param array $arguments
     * @return array
     * @throws Exception
     */
    function task_1(array &$arguments): array
    {
        for ($i = 0; $i < count($arguments); $i++) {
            if (!is_numeric($arguments[$i])) {
                $error = self::INVALID_PARAMS . ': param ' . var_export($arguments[$i], 1) . ' invalid type';
                $this->addError($error);
                unset($arguments[$i]);
            }
            for ($k = ($i + 1); $k < count($arguments); $k++) {
                if ($arguments[$i] < $arguments[$k]) {
                    $next = $arguments[$i];
                    $arguments[$i] = $arguments[$k];
                    $arguments[$k] = $next;
                }
            }
        }
        return $arguments;
    }

    /**
     * 2) need to make a deep check of two arrays with the random count of items -
     * that they have the same items. The order of items and arrays length can be different.
     * We could get all JS types here except Symbol.  We need to get a boolean type as a result
     * Arguments: array1, array2
     * Result: boolean
     * @param array $array1
     * @param array $array2
     * @return bool
     */
    function task_2(array $array1, array $array2): bool
    {
        return empty(array_diff($array1, $array2)) && empty(array_diff($array2, $array1));
    }

    /**
     * 3) need to check the array with structure [ [id: (int), value: (any) ] ].
     * we should group it by id property and count the same value property types. equal objects should be counted only 1 time.
     * as response we should return array with the structure [ [id: 1, number: 1, string: 10 ] ]
     * Arguments: [ [id: (number), value: (any) ] ]
     * Result: array
     * Example:
     * Input
     * [id: 1, value: 2],
     * [id: 1, value: 'asd'],
     * [id: 1, value: 'asd’]
     * Output
     * [[id: 1, number: 1, string: 1]]
     * @param array $arguments
     * @return array
     * @throws Exception
     */
    function task_3(array $arguments): array
    {
        $result = [];
        foreach ($arguments as $line => $item) {
            $item = (object)$item;
            $strings = 0;
            $numbers = 0;
            if (!isset($item->id) || !isset($item->value)) {
                $this->addError(self::INVALID_PARAMS . ' in item ' . $line);
                continue;
            } elseif (is_numeric($item->value)) {
                $numbers++;
            } elseif (is_string($item->value)) {
                $strings++;
            }
            $numbers += $result[$item->id]->number ?? 0;
            $strings += $result[$item->id]->string ?? 0;
            $result[$item->id] = (object)['id' => $item->id, 'number' => $numbers, 'string' => $strings];
        }
        sort($result);
        return array_values($result);
    }

    /**
     * 4) need to count the difference (even - odd) in the sum of all values even and odd indexes from the array with integers.
     * As a response, we should return an integer value.
     * Arguments: [ 1, 44, 2234, 0, 4, -1 ] positive and negative numbers
     * Result: integer
     * @param array $arguments
     * @return int
     * @throws Exception
     */
    function task_4(array $arguments): int
    {
        $evenSum = 0;
        $oddSum = 0;
        $line = 0;
        foreach ($arguments as $kay => $argument) {
            $line++;
            if (!is_int($kay)) {
                $this->addError(self::INVALID_PARAMS . ' in line ' . $line);
                continue;
            }

            if ($kay & 1) {
                $oddSum += (int)$argument;
            } else {
                $evenSum += (int)$argument;
            }
        }
        return $evenSum - $oddSum;
    }

    /**
     * 5) we should return all indexes from the string with random lengths where the needed character exists.
     * as the response, we should return an array with integer values
     * Arguments: 'asdasdasdasd' 'a' (two strings)
     * Result: array with integer
     * @param string $strOne
     * @param string $strTwo
     * @param array $result
     * @param int $offset
     * @return array
     */
    function task_5(string $strOne, string $strTwo, array &$result = [], int $offset = 0): array
    {
        $pos = strpos($strOne, $strTwo, $offset);
        if ($pos === false) {
            asort($result);
            return $result;
        }
        $result[] = $pos;
        return $this->task_5($strOne, $strTwo, $result, $pos + 1);
    }

    /**
     * 6) we should return the max count of characters repeating from the string with random length with case insensitive search.
     * as the response, we should return the integer value
     * Arguments: 'asdasdasdasd' 'a' (two random strings)
     * Result: integer
     * @param string $strOne
     * @param string $strTwo
     * @return int
     */
    function task_6(string $strOne, string $strTwo): int
    {
        return preg_match_all("/($strTwo)/i", $strOne);
    }

    /**
     * 7) need to do a transformation of array with structure [ [currency: (string), value: (any)] ],
     * need to do sum of all valid values grouped by currency property and return an array in format [ 'USD:12.00', 'EUR:1.02', UAH:3.00']
     * Arguments: [ [currency: (string), value: (any) ], ….. ,[currency: (string), value: (any) ] ]
     * Result: array with strings [ 'USD:12.00', 'EUR:1.02', UAH:3.00']
     * @param array $arguments
     * @return array
     * @throws Exception
     */
    function task_7(array $arguments): array
    {
        $result = array_map(function ($item) {
            $item = (object)$item;
            if (!isset($item->currency) || !is_string($item->currency) || !isset($item->value) || empty((float)$item->value)) {
                $this->addError(self::INVALID_PARAMS. ' '.var_export($item,1));
                return '';
            }
            return $item->currency . ':' . number_format((float)$item->value, 2, '.', '');
        }, $arguments);
        return array_filter($result);
    }

    /**
     * 8) need to do a transformation of the array with random elements and types.
     * need to take only alphanumeric characters and spaces and do concatenation of elements. as the response, we should return the string value
     * Arguments: [ 1, ‘asd’, ‘ff’,  ' ', null, false]
     * Result: string
     * @param array $arguments
     * @return string
     */
    function task_8(array $arguments): string
    {
        if (empty($arguments)) {
            return '';
        }
        return array_reduce($arguments, function ($result, $item) {
            $result .= preg_match('/[\w\d\s]/i', $item) ? $item : '';
            return $result;
        });
    }

    /**
     * 9) need to do a transformation of the array with structure [[id: (int), done: (bool) ]...,[id: (int), done: (bool)] ].
     * We need to check that all objects marked as done (done == true). we need to get a boolean type as a result
     * Arguments: [ [id: (int), done: (bool) ], …, [id: (int), done: (bool) ] ]
     * Result: boolean
     * @param array $arguments
     * @return bool
     */
    function task_9(array $arguments): bool
    {
        return empty(array_filter($arguments, function ($item) {
            $item = (object)$item;
            return isset($item->done) && $item->done !== true;
        }));
    }

    /**
     * 10)  need to replace each plaintext letter with a different one in a fixed number of places (can be negative too) down the English alphabet.
     * For example 'D' will be transformed into 'A', 'E' will be transformed into 'B', and so on if the key will be equal 3.
     * As a result, we should get a string value.
     * Arguments: 'Lorem ipsum dolor sit amet.', 3
     * Result: string
     * @param string $string
     * @param int $transformed
     * @return string
     */
    function task_10(string $string, int $transformed = 0): string
    {
        $letters = [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        ];
        $result = '';
        foreach (str_split($string) as $letter) {
            $isUpperRegister = ctype_upper($letter);
            $letter = strtoupper($letter);
            $realIndex = array_search($letter, $letters);
            $moveKay = $realIndex - $transformed;
            if ($transformed > 0 && !key_exists($moveKay, $letters)) {
                $moveKay = count($letters) - abs($moveKay);
            } elseif ($transformed < 0 && !key_exists($moveKay, $letters)) {
                $moveKay = abs($moveKay) - count($letters);
            }
            if (key_exists($moveKay, $letters)) {
                $result .= $isUpperRegister ? $letters[$moveKay] : strtolower($letters[$moveKay]);
            }
        }

        return $result;
    }

    /**
     * @param bool $exceptionOnErrors
     */
    public function setExceptionOnErrors(bool $exceptionOnErrors): void
    {
        $this->exceptionOnErrors = $exceptionOnErrors;
    }

    /**
     * @param bool $offErrors
     */
    public function setOffErrors(bool $offErrors): void
    {
        $this->offErrors = $offErrors;
    }


    /**
     * @throws Exception
     */
    protected function addError(string $error): void
    {
        if ($this->offErrors) {
            return;
        }

        if ($this->exceptionOnErrors) {
            throw new Exception($error);
        } else {
            echo $error . '<br>';
        }
    }
}
