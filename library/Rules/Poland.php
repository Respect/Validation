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

use Respect\Validation\Exceptions\ComponentException;

/**
 * Validates Poland specific documents or number
 */
class Poland extends AbstractWrapper
{
    public $type;

    /**
     * @param String $type
     * @throws ComponentException
     */
    public function __construct($type)
    {
        $className = __NAMESPACE__.'\\Poland\\'.$type;
        if (!class_exists($className)) {
            throw new ComponentException(sprintf('"%s" is not a valid document type or number type for Poland', $type));
        }

        $this->type = $type;
        $this->validatable = new $className();
    }
}
