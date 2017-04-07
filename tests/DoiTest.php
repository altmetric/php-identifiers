<?php
namespace Altmetric\Identifiers;

class DoiTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsDois()
    {
        $this->assertEquals(['10.1049/el.2013.3006'], Doi::extract('This is an example of DOI: 10.1049/el.2013.3006'));
    }

    public function testReturnsEmptyIfGivenNothing()
    {
        $this->assertEmpty(Doi::extract(null));
    }

    public function testExtractsDoisFromMiddlesOfStrings()
    {
        $this->assertEquals(['10.1049/el.2013.3006'], Doi::extract('This is an example of DOI: 10.1049/el.2013.3006 with trailing words'));
    }

    public function testExtractsIsbnAs()
    {
        $this->assertEquals(['10.978.8898392/315'], Doi::extract('http://dx.doi.org/10.978.8898392/315'));
    }

    public function testDoesNotExtractsInvalidIsbnAs()
    {
        $this->assertEmpty(Doi::extract('http://dx.doi.org/10.978.8898392/NotARealIsbnA'));
    }

    public function testLowercasesDois()
    {
        $this->assertEquals(['10.1097/01.asw.0000443266.17665.19'], Doi::extract('10.1097/01.ASW.0000443266.17665.19'));
    }

    public function testDiscardsTrailingPunctuation()
    {
        $this->assertEquals(['10.1130/2013.2502'], Doi::extract('This is an example of a DOI: 10.1130/2013.2502.'));
    }

    public function testDiscardsContiguousTrailingPunctuation()
    {
        $this->assertEquals(['10.1130/2013.2502'], Doi::extract('This is an example of a DOI: 10.1130/2013.2502...",'));
    }

    public function testRetainsClosingParenthesesThatArePartOfTheDoi()
    {
        $this->assertEquals(['10.1130/2013.2502(04)'], Doi::extract('This is an example of a DOI: 10.1130/2013.2502(04)'));
    }

    public function testDiscardsClosingParenthesesThatAreNotPartOfTheDoi()
    {
        $this->assertEquals(['10.1130/2013.2502'], Doi::extract('(This is an example of a DOI: 10.1130/2013.2502)'));
    }

    public function testExtractsExoticDois()
    {
        $this->assertEquals(
            ['10.1002/(sici)1096-8644(199601)99:1<135::aid-ajpa8>3.0.co;2-#'],
            Doi::extract('This is an example of an exotic DOI: 10.1002/(SICI)1096-8644(199601)99:1<135::AID-AJPA8>3.0.CO;2-#')
        );
    }
}
