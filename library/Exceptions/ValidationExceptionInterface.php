<?php
namespace Respect\Validation\Exceptions;

interface ValidationExceptionInterface extends ExceptionInterface
{
    public function getMainMessage();
}
