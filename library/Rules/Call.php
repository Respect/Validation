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

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;
use Throwable;
use function call_user_func;
use function restore_error_handler;
use function set_error_handler;

/**
 * Validates the return of a callable for a given input.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Call extends AbstractRule
{
    /**
     * @var callable
     */
    private $callable;

    /**
     * @var Validatable
     */
    private $rule;

    /**
     * Initializes the rule with the callable to be executed after the input is passed.
     */
    public function __construct(callable $callable, Validatable $rule)
    {
        $this->callable = $callable;
        $this->rule = $rule;
    }

    /**
     * {@inheritDoc}
     */
    public function assert($input): void
    {
        $this->setErrorHandler($input);

        try {
            $this->rule->assert(call_user_func($this->callable, $input));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Throwable $throwable) {
            throw $this->reportError($input);
        } finally {
            restore_error_handler();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        $this->setErrorHandler($input);

        try {
            $this->rule->check(call_user_func($this->callable, $input));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Throwable $throwable) {
            throw $this->reportError($input);
        } finally {
            restore_error_handler();
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

    /**
     * @param mixed $input
     */
    private function setErrorHandler($input): void
    {
        set_error_handler(function () use ($input): void {
            throw $this->reportError($input);
        });
    }
}
