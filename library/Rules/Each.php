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
 * Iterates over an array or Iterator and validates the value or key
 * of each entry:
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
    private $itemValidator;

    /**
     * @var Validatable
     */
    private $keyValidator;

    /**
     * @param Validatable $keyValidator
     * @param Validatable $itemValidator
     */
    public function __construct(Validatable $itemValidator = null, Validatable $keyValidator = null)
    {
        $this->itemValidator = $itemValidator;
        $this->keyValidator = $keyValidator;
    }

    /**
     * {@inheritdoc}
     */
    public function assert($input): void
    {
        $exceptions = [];

        if (!$this->isIterable($input)) {
            throw $this->reportError($input);
        }

        foreach ($input as $key => $item) {
            if (isset($this->itemValidator)) {
                try {
                    $this->itemValidator->assert($item);
                } catch (ValidationException $e) {
                    $exceptions[] = $e;
                }
            }

            if (isset($this->keyValidator)) {
                try {
                    $this->keyValidator->assert($key);
                } catch (ValidationException $e) {
                    $exceptions[] = $e;
                }
            }
        }

        if (!empty($exceptions)) {
            throw $this->reportError($input)->setRelated($exceptions);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function check($input): void
    {
        if (!$this->isIterable($input)) {
            throw $this->reportError($input);
        }

        foreach ($input as $key => $item) {
            if (isset($this->itemValidator)) {
                $this->itemValidator->check($item);
            }

            if (isset($this->keyValidator)) {
                $this->keyValidator->check($key);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!$this->isIterable($input)) {
            return false;
        }

        foreach ($input as $key => $item) {
            if (isset($this->itemValidator) && !$this->itemValidator->validate($item)) {
                return false;
            }

            if (isset($this->keyValidator) && !$this->keyValidator->validate($key)) {
                return false;
            }
        }

        return true;
    }
}
