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

/**
 * Validates if the input is an instance of the given class or interface.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Instance extends AbstractRule
{
    /**
     * @var string
     */
    private $instanceName;

    /**
     * Initializes the rule with the expected instance name.
     */
    public function __construct(string $instanceName)
    {
        $this->instanceName = $instanceName;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return $input instanceof $this->instanceName;
    }
}
