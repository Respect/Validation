<?php

namespace Respect\Validation\Contexts;

use Respect\Validation\Exceptions as e;

class Form extends AbstractContext
{

    public $defaultTemplates = array(
        'Respect\Validation\Exceptions\AttributeException' => array(
            e\AttributeException::NOT_PRESENT => 'You must fill %1$s'
        ),
        'Respect\Validation\Exceptions\NoWhitespaceException' => array(
            e\NoWhitespaceException::STANDARD => '"%1$s" can\'t have spaces or line breaks'
        )
    );

}