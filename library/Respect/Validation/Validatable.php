<?php

namespace Respect\Validation;

interface Validatable
{

    public function validate($input);

    public function isValid($input);

    public function getMessages();

    public function setMessages(array $messages);
}