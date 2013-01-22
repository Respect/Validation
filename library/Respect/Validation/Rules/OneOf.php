<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;

class OneOf extends AbstractComposite
{
    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        $numRules = count($validators);
        $numExceptions = count($exceptions);
        $numPassed = $numRules - $numExceptions;
        if ($numExceptions === $numRules) {
            throw $this->reportError($input)->setRelated($exceptions);
        }

        return true;
    }

    public function validate($input)
    {
        foreach ($this->getRules() as $v) {
            if ($v->validate($input)) {
                return true;
            }
        }

        return false;
    }

    public function check($input)
    {
        foreach ($this->getRules() as $v) {
            try {
                if ($v->check($input)) {
                    return true;
                }
            } catch (ValidationException $e) {
                if (!isset($firstException)) {
                    $firstException = $e;
                }
            }
        }

        if (isset($firstException)) {
            throw $firstException;
        }

        return false;
    }
}

