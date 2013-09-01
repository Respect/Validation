<?php

namespace Respect\Validation\Rules;

class Hostname extends Domain
{

    public function __construct()
    {
        parent::__construct();
        $this->ip = new AllOf(
                new Not(new Ip()),
                new Domain()
        );
    }

}

