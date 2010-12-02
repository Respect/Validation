<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\AtLeastException;

class AtLeast extends AbstractComposite
{

    protected $howMany = 1;

    public function __construct($howMany, $rules=array())
    {
        $this->howMany = $howMany;
        $this->addRules($rules);
    }

    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        if ($this->howMany > (count($validators) - count($exceptions)))
            throw $this
                ->getException()
                ->setParams(count($exceptions), $this->howMany)
                ->setRelated($exceptions);
        return true;
    }

    public function createException()
    {
        return new AtLeastException(AtLeastException::INVALID_ATLEAST);
    }

    public function validate($input)
    {
        $validators = $this->getRules();
        $pass = 0;
        foreach ($validators as $v) {
            try {
                $v->check($input);
                $pass++;
            } catch (ValidationException $e) {
                
            }
            if ($pass >= $this->howMany)
                return true;
        }
        return false;
    }

    public function check($input)
    {
        $validators = $this->getRules();
        $pass = 0;
        $exceptions = array();
        foreach ($validators as $v) {
            try {
                $v->check($input);
                $pass++;
            } catch (ValidationException $e) {
                $exceptions[] = $e;
            }
            if ($pass >= $this->howMany)
                return true;
            if (count($exceptions) > (count($validators) - $this->howMany))
                throw $this
                    ->getException()
                    ->setParams(count($exceptions), $this->howMany)
                    ->setRelated($exceptions);
        }
        return false;
    }

}