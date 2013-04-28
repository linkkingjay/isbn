<?php

namespace Isbn;

class CheckDigit {

    public static function make($isbn)
    {
        if (strlen($isbn) == 12 OR strlen($isbn) == 13)
            return CheckDigit::make13($isbn);
        if (strlen($isbn) == 9 OR strlen($isbn) == 10)
            return CheckDigit::make10($isbn);
        return false;
    }

    public static function make10($isbn)
    {
        if (strlen($isbn) < 9 OR strlen($isbn) > 10)
            return false;
        $check = 0;
        for ($i = 0; $i < 9; $i++)
            if ($isbn[$i] == "X")
                $check += 10 * intval(10 - $i);
            else
                $check += intval($isbn[$i]) * intval(10 - $i);
        return 11 - $check % 11;
    }

    public static function make13($isbn)
    {
        if (strlen($isbn) < 12 OR strlen($isbn) > 13)
            return false;
        $check = 0;
        for ($i = 0; $i < 12; $i+=2)
            $check += substr($isbn, $i, 1);
        for ($i = 1; $i < 12; $i+=2)
            $check += 3 * substr($isbn, $i, 1);
        return 10 - $check % 10;
    }
}
