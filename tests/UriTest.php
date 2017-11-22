<?php
namespace Altmetric\Identifiers;

class UriTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsValidUris()
    {
        $this->assertEquals(['https://www.altmetric.com/', 'http://altmetric.it'], Uri::extract('I like https://www.altmetric.com/ and http://altmetric.it'));
    }

    public function testExtractsUrisWithPorts()
    {
        $this->assertEquals(['http://www.altmetric.com:80/foo/bar'], Uri::extract('http://www.altmetric.com:80/foo/bar is great'));
    }

    public function testExtractsUrisWithIpV4Hosts()
    {
        $this->assertEquals(['http://8.8.8.8/foo'], Uri::extract('http://8.8.8.8/foo'));
    }

    public function testExtractsUrisWithIpV6Hosts()
    {
        $this->assertEquals(['http://[1080::8:800:200C:417A]/foo', 'http://[::1]'], Uri::extract('http://[1080::8:800:200C:417A]/foo http://[::1]'));
    }

    public function testExtractsUrisWithQueries()
    {
        $this->assertEquals(['http://www.altmetric.com/?foo=bar'], Uri::extract('http://www.altmetric.com/?foo=bar'));
    }

    public function testExtractsUrisWithFragments()
    {
        $this->assertEquals(['http://www.altmetric.com/#foo'], Uri::extract('http://www.altmetric.com/#foo'));
    }

    public function testExtractsUrisWithPortQueryAndFragment()
    {
        $this->assertEquals(['http://www.altmetric.com:80/foo?bar#1'], Uri::extract('http://www.altmetric.com:80/foo?bar#1'));
    }

    public function testExtractsMailtoUris()
    {
        $this->assertEquals(['mailto:support@altmetric.com'], Uri::extract('<a href="mailto:support@altmetric.com">E-mail</a>'));
    }

    public function testIgnoresInvalidUris()
    {
        $this->assertEmpty(Uri::extract('Nothing to.see here.'));
    }

    public function testReturnsEmptyArrayWhenGivenNull()
    {
        $this->assertEmpty(Uri::extract(null));
    }
}
