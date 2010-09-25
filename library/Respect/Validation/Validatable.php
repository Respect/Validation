<?php

namespace Respect\Validation;

interface Validatable
{

    public function assert($input);

    public function validate($input);

    public function getMessages();

    public function setMessages(array $messages);
}