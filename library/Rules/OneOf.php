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

use Respect\Validation\Exceptions\OneOfException;
use Respect\Validation\Exceptions\ValidationException;

use function array_shift;
use function count;

/**
 * @author Bradyn Poulsen <bradyn@bradynpoulsen.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class OneOf extends AbstractComposite
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
        if ($numExceptions !== $numRules - 1) {
            /** @var OneOfException $oneOfException */
            $oneOfException = $this->reportError($input);
            $oneOfException->addChildren($exceptions);

            throw $oneOfException;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        $rulesPassedCount = 0;
        foreach ($this->getRules() as $rule) {
            if (!$rule->validate($input)) {
                continue;
            }

            ++$rulesPassedCount;
        }

        return $rulesPassedCount === 1;
    }

    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        $exceptions = [];
        $rulesPassedCount = 0;
        foreach ($this->getRules() as $rule) {
            try {
                $rule->check($input);

                ++$rulesPassedCount;
            } catch (ValidationException $exception) {
                $exceptions[] = $exception;
            }
        }

        if ($rulesPassedCount === 1) {
            return;
        }

        throw array_shift($exceptions) ?: $this->reportError($input);
    }
}
