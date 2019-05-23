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

/**
 * Abstract class that creates an envelope around another rule.
 *
 * This class is usefull when you want to create rules that use other rules, but
 * having an custom message.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
abstract class AbstractEnvelope extends AbstractRule
{
    /**
     * @var Validatable
     */
    private $validatable;

    /**
     * @var mixed[]
     */
    private $parameters;

    /**
     * Initializes the rule.
     *
     * @param mixed[] $parameters
     */
    public function __construct(Validatable $validatable, array $parameters = [])
    {
        $this->validatable = $validatable;
        $this->parameters = $parameters;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return $this->validatable->validate($input);
    }

    /**
     * {@inheritDoc}
     */
    public function reportError($input, array $extraParameters = []): ValidationException
    {
        return parent::reportError($input, $extraParameters + $this->parameters);
    }
}
