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
use Respect\Validation\Factory;
use Respect\Validation\Validatable;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Vicente Mendoza <vicentemmor@yahoo.com.mx>
 */
abstract class AbstractRule implements Validatable
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $template;

    /**
     * @param mixed$input
     */
    public function __invoke($input): bool
    {
        return $this->validate($input);
    }

    /**
     * {@inheritDoc}
     */
    public function assert($input): void
    {
        if ($this->validate($input)) {
            return;
        }

        throw $this->reportError($input);
    }

    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        $this->assert($input);
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function reportError($input, array $extraParams = []): ValidationException
    {
        return Factory::getDefaultInstance()->exception($this, $input, $extraParams);
    }

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): Validatable
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setTemplate(string $template): Validatable
    {
        $this->template = $template;

        return $this;
    }
}
