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

use Respect\Validation\Exceptions\AnyOfException;
use Respect\Validation\Exceptions\ValidationException;

use function count;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AnyOf extends AbstractComposite
{
    /**
     * {@inheritDoc}
     */
    public function assert($input): void
    {
        $validators = $this->getRules();
        $exceptions = $this->getAllThrownExceptions($input);
        $numRules = count($validators);
        $numExceptions = count($exceptions);
        if ($numExceptions === $numRules) {
            /** @var AnyOfException $anyOfException */
            $anyOfException = $this->reportError($input);
            $anyOfException->addChildren($exceptions);

            throw $anyOfException;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        foreach ($this->getRules() as $v) {
            if ($v->validate($input)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        foreach ($this->getRules() as $v) {
            try {
                $v->check($input);

                return;
            } catch (ValidationException $e) {
                if (!isset($firstException)) {
                    $firstException = $e;
                }
            }
        }

        if (isset($firstException)) {
            throw $firstException;
        }

        throw $this->reportError($input);
    }
}
