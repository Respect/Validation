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

use PHPUnit\Framework\TestCase;
use Respect\Validation\Validatable;

class AbstractLocaleWrapperTest extends TestCase
{
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessageRegExp /"\w+" is not a supported country code/
     */
    public function testConstructorShouldThrowComponentException()
    {
        $abstractLocaleWrapperMock = $this->getMockForAbstractClass(AbstractLocaleWrapper::class, ['invalid_country_code']);
    }
}
