<?php
namespace Altmetric\Identifiers;

class UrnTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsValidUrns()
    {
        $this->assertEquals(['urn:namespace:specificstring'], Urn::extract('urn:namespace:specificstring'));
    }

    public function testDoesNotExtractInvalidUrns()
    {
        $this->assertEmpty(Urn::extract('urn:urn:1234'));
    }

    public function testExtractsValidUrnsWithPercentEncodedCharacters()
    {
        $this->assertEquals(['urn:foo:123%2c456'], Urn::extract('urn:foo:123%2c456'));
    }

    public function testLowercasesUrnPrefix()
    {
        $this->assertEquals(['urn:foo:bar'], Urn::extract('URN:foo:bar'));
    }

    public function testLowercasesNamespaceIdentifier()
    {
        $this->assertEquals(['urn:foo:bar'], Urn::extract('urn:FOO:bar'));
    }

    public function testLowercasesPercentEncoding()
    {
        $this->assertEquals(['urn:foo:bar%2c'], Urn::extract('urn:foo:bar%2C'));
    }

    public function testDoesNotLowercaseOtherCharactersInNamespaceSpecificString()
    {
        $this->assertEquals(['urn:foo:BAR'], Urn::extract('urn:foo:BAR'));
    }
}
