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
use Respect\Validation\Validatable;

class Each extends Iterable
{
    public $itemValidator;
    public $keyValidator;

    public function __construct(Validatable $itemValidator = null, Validatable $keyValidator = null)
    {
        $this->itemValidator = $itemValidator;
        $this->keyValidator = $keyValidator;
    }

    public function assert($input)
    {
        $exceptions = [];

        if (!parent::validate($input)) {
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

        return true;
    }

    public function check($input)
    {
        if (!parent::validate($input)) {
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

        return true;
    }

    public function validate($input)
    {
        if (!parent::validate($input)) {
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
