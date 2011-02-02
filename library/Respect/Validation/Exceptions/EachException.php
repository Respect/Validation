<?php

namespace Respect\Validation\Exceptions;

class EachException extends ValidationException
{

    public static $defaultTemplates = array(
        '%4$d invalid itens found (%3$s)',
    );

}