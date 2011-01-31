<?php

namespace Respect\Validation\Exceptions;

class EachException extends ValidationException
{

    public static $defaultTemplates = array(
        '%3$d invalid itens found',
    );

}