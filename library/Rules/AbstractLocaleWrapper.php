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
use function class_exists;
use function mb_strtolower;
use function sprintf;
use function ucfirst;

/**
 * Abstract class to help creating rules based on location.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
abstract class AbstractLocaleWrapper extends AbstractWrapper
{
    /**
     * @var string
     */
    private $countryCode;

    /**
     * Initializes the rule.
     *
     * @param string $countryCode
     *
     * @throws ComponentException when country is not supported
     */
    public function __construct(string $countryCode)
    {
        $normalized = ucfirst(mb_strtolower($countryCode));
        $className = sprintf('%s\\Locale\\%s%s', __NAMESPACE__, $normalized, $this->getSuffix());
        if (!class_exists($className)) {
            throw new ComponentException(sprintf('"%s" is not a supported country code', $countryCode));
        }

        $this->countryCode = $countryCode;
        parent::__construct(new $className());
    }

    /**
     * Returns the class name based on the identifier.
     *
     * @return string
     */
    abstract protected function getSuffix(): string;
}
