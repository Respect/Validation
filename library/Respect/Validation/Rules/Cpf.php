<?php

namespace Respect\Validation\Rules;

class Cpf extends AbstractRule 
{
    public function validate($input) 
    {
        // Ported from JSFromHell
        $c = preg_replace('/\D/', '', $input);
        if (strlen($c) != 11) return false;
        if (preg_match("/^{$c[0]}{11}$/", $c)) return false;
        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);
        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) return false;
        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);
        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) return false;
        return true;
    }
}
