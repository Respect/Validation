<?php

namespace Respect\Validation;

interface Validatable
{

    public function assert($input);

    public function validate($input);

    public function getMessageTemplates();

    public function setMessageTemplates(array $templates);

    public function setMessageTemplate($code, $templage);

    public function getMessageTemplate($code);
}