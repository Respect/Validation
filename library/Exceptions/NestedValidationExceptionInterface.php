<?php
namespace Respect\Validation\Exceptions;

interface NestedValidationExceptionInterface extends ValidationExceptionInterface
{
    public function findMessages(array $paths);
    public function getFullMessage();
}
