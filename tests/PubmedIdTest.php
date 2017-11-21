<?php
namespace Altmetric\Identifiers;

class PubmedIdTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsPubmedIDs()
    {
        $this->assertEquals(['123', '456', '78910'], PubmedId::extract("123\n456\n78910"));
    }

    public function testDoesNotReturnOutputsWithPubmedIDsInDois()
    {
        $this->assertEmpty(PubmedId::extract('10.1038/nplants.2015.3\n10.1126/science.286.5445.1679e'));
    }

    public function testStripsLeadingZeroes()
    {
        $this->assertSame(['10203', '456000'], PubmedId::extract("0000010203\n000456000"));
    }

    public function testDoesNotConsiderZeroAsAValidPubmedID()
    {
        $this->assertEmpty(PubmedId::extract('00000000'));
    }

    public function testExtractsPubmedIdsWithTrailingUnicodeWhitespace()
    {
        $this->assertEquals(['123'], PubmedId::extract('123 '));
    }

    public function testReturnsAnEmptyArrayWhenGivenNull()
    {
        $this->assertEmpty(PubmedId::extract(null));
    }
}
