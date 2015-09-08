<?php

class IranianNationalCodeComponent extends Component
{
    protected static $nationalCode = 0;

    protected static $notNationalCode = array(
        "1111111111",
        "2222222222",
        "3333333333",
        "4444444444",
        "5555555555",
        "6666666666",
        "7777777777",
        "8888888888",
        "9999999999",
        "0000000000"
    );

    public function nationalCode($code)
    {
        self:: $nationalCode = trim($code);

        if (self:: validCode()) {
            $melliCode = self:: $nationalCode;

            $subMid = self:: subMidNumbers($melliCode, 10, 1);

            $getNum = 0;

            for ($i = 1; $i < 10; $i++)
                $getNum += (self:: subMidNumbers($melliCode, $i, 1) * (11 - $i));

            $modulus = ($getNum % 11);

            if ((($modulus < 2) && ($subMid == $modulus)) || (($modulus >= 2) && ($subMid == (11 - $modulus))))
                return true;
        }

        return false;
    }

    protected function validCode()
    {
        $melliCode = self:: $nationalCode;

        if ((is_numeric($melliCode)) && (strlen($melliCode) == 10) && (strspn($melliCode, $melliCode[0]) != strlen($melliCode)))
            return true;

        return false;
    }

    protected function subMidNumbers($number, $start, $length)
    {
        return substr($number, ($start - 1), $length);
    }
}