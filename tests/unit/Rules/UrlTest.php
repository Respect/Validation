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

use Respect\Validation\TestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Url
 * @covers Respect\Validation\Exceptions\UrlException
 */
class UrlTest extends TestCase
{
    /**
     * @dataProvider providerForValidUrl
     */
    public function testShouldValidateValidUrls($validUrl)
    {
        $validator = new Url();

        $this->assertTrue($validator->validate($validUrl));
    }

    /**
     * @dataProvider providerForInvalidUrl
     */
    public function testShouldNotValidateInvalidUrls($invalidUrl)
    {
        $validator = new Url();

        $this->assertFalse($validator->validate($invalidUrl));
    }

    public function providerForValidUrl()
    {
        return [
            ['ftp://ftp.is.co.za.example.org/rfc/rfc1808.txt'],
            ['gopher://spinaltap.micro.umn.example.edu/00/Weather/California/Los%20Angeles'],
            ['http://www.ietf.org/rfc/rfc2396.txt'],
            ['http://www.math.uio.no.example.net/faq/compression-faq/part1.html'],
            ['https://www.youtube.com/watch?v=6FOUqQt3Kg0'],
            ['ldap://[2001:db8::7]/c=GB?objectClass?one'],
            ['mailto:John.Doe@example.com'],
            ['mailto:mduerst@ifi.unizh.example.gov'],
            ['news:comp.infosystems.www.servers.unix'],
            ['news:comp.infosystems.www.servers.unix'],
            ['telnet://192.0.2.16:80/'],
            ['telnet://melvyl.ucop.example.edu/'],
        ];
    }

    public function providerForInvalidUrl()
    {
        return [
            ['example.com'],
            ['http:/example.com/'],
            ['tel:+1-816-555-1212'],
            ['urn:oasis:names:specification:docbook:dtd:xml:4.1.2'],
        ];
    }
}
