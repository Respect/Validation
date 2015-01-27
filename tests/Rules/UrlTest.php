<?php
namespace Respect\Validation\Rules;

/**
 * @covers Respect\Validation\Rules\Url
 */
class UrlTest extends \PHPUnit_Framework_TestCase
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
        return array(
            array('ftp://ftp.is.co.za.example.org/rfc/rfc1808.txt'),
            array('gopher://spinaltap.micro.umn.example.edu/00/Weather/California/Los%20Angeles'),
            array('http://www.ietf.org/rfc/rfc2396.txt'),
            array('http://www.math.uio.no.example.net/faq/compression-faq/part1.html'),
            array('https://www.youtube.com/watch?v=6FOUqQt3Kg0'),
            array('ldap://[2001:db8::7]/c=GB?objectClass?one'),
            array('mailto:John.Doe@example.com'),
            array('mailto:mduerst@ifi.unizh.example.gov'),
            array('news:comp.infosystems.www.servers.unix'),
            array('news:comp.infosystems.www.servers.unix'),
            array('telnet://192.0.2.16:80/'),
            array('telnet://melvyl.ucop.example.edu/'),
        );
    }

    public function providerForInvalidUrl()
    {
        return array(
            array('example.com'),
            array('http:/example.com/'),
            array('tel:+1-816-555-1212'),
            array('urn:oasis:names:specification:docbook:dtd:xml:4.1.2'),
        );
    }
}
