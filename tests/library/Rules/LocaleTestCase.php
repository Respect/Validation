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

use malkusch\bav\BAV;
use malkusch\bav\ConfigurationRegistry;
use malkusch\bav\DataBackend;
use malkusch\bav\DataBackendContainer;

class LocaleTestCase extends \PHPUnit_Framework_TestCase
{
    protected function getBavMock()
    {
        $bavMock = $this->getMockBuilder(BAV::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $bavMock;
    }

    protected function setUp()
    {
        $dataBackend = $this->getMockForAbstractClass(DataBackend::class);
        $dataBackendContainer = $this->getMockForAbstractClass(DataBackendContainer::class);
        $dataBackendContainer
            ->expects($this->any())
            ->method('makeDataBackend')
            ->will($this->returnValue($dataBackend));

        ConfigurationRegistry::getConfiguration()->setDataBackendContainer($dataBackendContainer);
        ConfigurationRegistry::getConfiguration()->setUpdatePlan(null);
    }
}
