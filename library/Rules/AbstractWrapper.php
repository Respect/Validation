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
 * Abstract class to help on creating rules that wrap rules.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
abstract class AbstractWrapper extends AbstractRule
{
    /**
     * @var Validatable
     */
    private $validatable;

    /**
     * Initializes the rule.
     *
     * @param Validatable $validatable
     */
    public function __construct(Validatable $validatable)
    {
        $this->validatable = $validatable;
    }

    /**
     * {@inheritdoc}
     */
    public function assert($input): void
    {
        $this->validatable->assert($input);
    }

    /**
     * {@inheritdoc}
     */
    public function check($input): void
    {
        $this->validatable->check($input);
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
    public function setName(string $name): Validatable
    {
        $this->validatable->setName($name);

        return parent::setName($name);
    }
}
