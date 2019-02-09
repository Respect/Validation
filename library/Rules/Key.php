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

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class Key extends AbstractRelated
{
    /**
     * @param mixed $reference
     */
    public function __construct($reference, ?Validatable $referenceValidator = null, bool $mandatory = true)
    {
        if (!is_scalar($reference) || $reference === '') {
            throw new ComponentException('Invalid array key name');
        }
        parent::__construct($reference, $referenceValidator, $mandatory);
    }

    /**
     * {@inheritdoc}
     */
    public function getReferenceValue($input)
    {
        return $input[$this->reference];
    }

    /**
     * {@inheritdoc}
     */
    public function hasReference($input): bool
    {
        return is_array($input) && array_key_exists($this->reference, $input);
    }
}
