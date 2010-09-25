<?php

namespace Respect\Validation;

interface Validatable
{

    public function assert($input);

    public function is($input);

    public function getMessages();

    public function setMessages(array $messages);
}