<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\EachException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Helpers\CanValidateIterable;
use Respect\Validation\Validatable;

/**
 * Validates whether each value in the input is valid according to another rule.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Each extends AbstractRule
{
    use CanValidateIterable;

    /**
     * @var Validatable
     */
    private $rule;

    /**
     * Initializes the constructor.
     */
    public function __construct(Validatable $rule)
    {
        $this->rule = $rule;
    }

    /**
     * {@inheritDoc}
     */
    public function assert($input): void
    {
        if (!$this->isIterable($input)) {
            throw $this->reportError($input);
        }

        $exceptions = [];
        foreach ($input as $value) {
            try {
                $this->rule->assert($value);
            } catch (ValidationException $exception) {
                $exceptions[] = $exception;
            }
        }

        if (!empty($exceptions)) {
            /** @var EachException $eachException */
            $eachException = $this->reportError($input);
            $eachException->addChildren($exceptions);

            throw $eachException;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        if (!$this->isIterable($input)) {
            throw $this->reportError($input);
        }

        foreach ($input as $value) {
            $this->rule->check($value);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        try {
            $this->check($input);
        } catch (ValidationException $exception) {
            return false;
        }

        return true;
    }
}
