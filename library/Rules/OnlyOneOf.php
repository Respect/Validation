<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;

/**
 * @author Bradyn Poulsen <bradyn@bradynpoulsen.com>
 */
class OnlyOneOf extends AbstractComposite
{
    public function assert($input)
    {
        $validators = $this->getRules();
        $exceptions = $this->validateRules($input);
        $numRules = count($validators);
        $numExceptions = count($exceptions);
        if ($numExceptions !== $numRules - 1) {
            throw $this->reportError($input)->setRelated($exceptions);
        }

        return true;
    }

    public function validate($input)
    {
        $onePassed = false;
        foreach ($this->getRules() as $v) {
            if ($v->validate($input)) {
                if (false === $onePassed) {
                    $onePassed = true;
                } else {
                    return false;
                }
            }
        }

        return $onePassed;
    }

    public function check($input)
    {
        $onePassed = false;
        foreach ($this->getRules() as $v) {
            try {
                if ($v->check($input)) {
                    if (false === $onePassed) {
                        $onePassed = true;
                    } else {
                        return false;
                    }
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

        return $onePassed;
    }
}
