<?php
namespace Respect\Validation\Rules;

class Graph extends AbstractCtypeRule
{
    protected function filter($input)
    {
        return $input;
    }

    protected function ctypeFunction($input)
    {
        return ctype_graph($input);
    }
}

