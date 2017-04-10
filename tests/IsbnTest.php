<?php
namespace Altmetric\Identifiers;

class IsbnTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractsIsbn13s()
    {
        $this->assertEquals(['9780805069099', '9780671879198'], Isbn::extract("ISBN: 9780805069099\nISBN: 9780671879198"));
    }

    public function testExtractsIsbn13sWithDashes()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('978-0-80-506909-9'));
    }

    public function testExtractsIsbn13sWithUnicodeDashes()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('978–0–80–506909–9'));
    }

    public function testExtractsIsbn13sWithSpaces()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('978 0 80 506909 9'));
    }

    public function testExtractsIsbn13sPrecededByText()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('I like 978 0 80 506909 9'));
    }

    public function testExtractsIsbn13sSucceededByText()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('978 0 80 506909 9 is great'));
    }

    public function testExtractsIsbn13sWithTrailingUnicodePunctuation()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('978 0 80 506909 9…'));
    }

    public function testExtractsIsbn13sOnNewLines()
    {
        $this->assertEquals(['9780805069099', '9780671879198'], Isbn::extract("978-0-80-506909-9\n978-0-67-187919-8"));
    }

    public function testExtractsIsbn13sSeparatedByUnicodeWhitespace()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('978 0 80 506909 9'));
    }

    public function testDoesNotExtractInvalidIsbn13s()
    {
        $this->assertEmpty(Isbn::extract('9783319217280'));
    }

    public function testConvertsValidIsbn10sToIsbn13s()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('0-8050-6909-7'));
    }

    public function testConvertsValidIsbn10sSeparatedByUnicodeWhitespaceToIsbn13s()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('0–8050–6909–7'));
    }

    public function testConvertsValidIsbn10sWithTrailingUnicodePunctuationToIsbn13s()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('0-8050-6909-7…'));
    }

    public function testConvertsValidIsbn10sWithSpacesToIsbn13s()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('0 8050 6909 7'));
    }

    public function testConvertsValidIsbn10sWithUnicodeWhitespaceToIsbn13s()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('0 8050 6909 7'));
    }

    public function testConvertsValidIsbn10sWithSpacesAndXToIsbn13s()
    {
        $this->assertEquals(['9780805069952'], Isbn::extract('0 8050 6995 X'));
    }

    public function testConvertsValidIsbn10sWithXCheckDigitToIsbn13s()
    {
        $this->assertEquals(['9782759402694'], Isbn::extract('2-7594-0269-X'));
    }

    public function testDoesNotExtractInvalidIsbn10s()
    {
        $this->assertEmpty(Isbn::extract('0-8050-6909-X'));
    }

    public function testExtractsIsbnAsFromDois()
    {
        $this->assertEquals(['9788898392315'], Isbn::extract('http://dx.doi.org/10.978.8898392/315'));
    }

    public function testExtractsIsbnAsWithTrailingUnicodePunctuation()
    {
        $this->assertEquals(['9788898392315'], Isbn::extract('http://dx.doi.org/10.978.8898392/315…'));
    }

    public function testDoesNotExtractInvalidIsbnAsFromDois()
    {
        $this->assertEmpty(Isbn::extract('http://dx.doi.org/10.978.8898392/316'));
    }
}
