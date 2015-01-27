<?php
namespace Respect\Validation\Rules;


class Url extends FilterVar
{
    public function __construct()
    {
        parent::__construct(FILTER_VALIDATE_URL);
    }
}
