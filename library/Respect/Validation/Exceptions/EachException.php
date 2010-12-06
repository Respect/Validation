<?php

namespace Respect\Validation\Exceptions;

class EachException extends ValidationException
{
    const INVALID_EACH= 'Each_1';
    public static $defaultTemplates = array(
        self::INVALID_EACH => '%3$d invalid itens found',
    );

}