<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

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
     *
     * @param mixed $rule
     */
    public function __construct(Validatable $rule)
    {
        $this->rule = $rule;
    }

    /**
     * {@inheritdoc}
     */
    public function assert($input): void
    {
        if (!$this->isIterable($input)) {
            throw $this->reportError($input);
        }

        $exceptions = [];
        foreach ($input as $value) {
            try {
                $this->rule->check($value);
            } catch (ValidationException $exception) {
                $exceptions[] = $exception;
            }
        }

        if (!empty($exceptions)) {
            throw $this->reportError($input)->setRelated($exceptions);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        try {
            $this->assert($input);
        } catch (ValidationException $exception) {
            return false;
        }

        return true;
    }
}
