<?php
namespace Respect\Validation\Rules;

class Graph extends AbstractCtypeRule
{
    protected function ctypeFunction($input)
    {
        return ctype_graph($input);
    }
}

