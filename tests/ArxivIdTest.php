<?php
namespace Altmetric\Identifiers;

class ArxivIdTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsPre2007ArxivIds()
    {
        $this->assertEquals(['math.GT/0309136'], ArxivId::extract('Example: math.GT/0309136'));
    }

    public function testExtractsPre2007ArxivIdsEndingInUnicodeWhitespace()
    {
        $this->assertEquals(['math.GT/0309136'], ArxivId::extract('Example: math.GT/0309136 '));
    }

    public function testExtractsPost2007UnversionedArxivIds()
    {
        $this->assertEquals(['0706.0001'], ArxivId::extract('Example: arXiv:0706.0001'));
    }

    public function testExtractsPost2007VersionedArxivIds()
    {
        $this->assertEquals(['1501.00001v2'], ArxivId::extract('Example: arXiv:1501.00001v2'));
    }

    public function testExtractsPost2007ArxivIdsEndingInUnicodeWhitespace()
    {
        $this->assertEquals(['1501.00001v2'], ArxivId::extract('Example: arXiv:1501.00001v2 '));
    }

    public function testDoesNotExtractArxivIdsFromDois()
    {
        $this->assertEmpty(ArxivId::extract("10.1049/el.2013.3006\n10.2310/7290.2014.00033"));
    }

    public function testExtractsPost2007ArxivIdsFromUrls()
    {
        $this->assertEquals(['1704.01279'], ArxivId::extract('https://arxiv.org/abs/1704.01279'));
    }

    public function testExtractsPre2007ArxivIdsFromUrls()
    {
        $this->assertEquals(['math/0309136'], ArxivId::extract('https://arxiv.org/abs/math/0309136'));
    }

    public function testReturnsEmptyArrayWhenGivenNull()
    {
        $this->assertEmpty(ArxivId::extract(null));
    }
}
