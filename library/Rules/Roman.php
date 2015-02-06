<?php
namespace Respect\Validation\Rules;

class Roman extends Regex
{
    public function __construct()
    {
        $pattern = '^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$';
        parent::__construct('/'.$pattern.'/');
    }
}
