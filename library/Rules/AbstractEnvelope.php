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
     * @var array
     */
    private $parameters;

    /**
     * Initializes the rule.
     *
     * @param Validatable $validatable
     * @param array $parameters
     */
    public function __construct(Validatable $validatable, array $parameters)
    {
        $this->validatable = $validatable;
        $this->parameters = $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        return $this->validatable->validate($input);
    }

    /**
     * {@inheritdoc}
     */
    public function reportError($input, array $extraParameters = [])
    {
        return parent::reportError($input, $extraParameters + $this->parameters);
    }
}
