<?php

namespace Respect\Validation\Exceptions;

class AbstractCompositeException extends ValidationException
{
    const INVALID_NONE= 'AbstractComposite_1';
    const INVALID_SOME= 'AbstractComposite_2';
    public static $defaultTemplates = array(
        self::INVALID_NONE => 'None of the rules passed',
        self::INVALID_SOME => '%2$d rules did not passed',
    );

    public function chooseTemplate($input, $numFailed, $numRequired, $numTotal)
    {
        if ($numFailed === $numTotal)
            return static::INVALID_NONE;
        else
            return static::INVALID_SOME;
    }

    public function renderMessage()
    {
        if (1 === count($this->related)) {
            $this->message = $this->related[0]->getMessage();
        } else {
            parent::renderMessage();
        }
    }

}