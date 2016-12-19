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

    public function testDoesNotExtractInvalidIsbn13s()
    {
        $this->assertEmpty(Isbn::extract('9783319217280'));
    }

    public function testConvertsValidIsbn10sToIsbn13s()
    {
        $this->assertEquals(['9780805069099'], Isbn::extract('0-8050-6909-7'));
    }

    public function testConvertsValidIsbn10sWithXCheckDigitToIsbn13s()
    {
        $this->assertEquals(['9782759402694'], Isbn::extract('2-7594-0269-X'));
    }

    public function testDoesNotExtractInvalidIsbn10s()
    {
        $this->assertEmpty(Isbn::extract('0-8050-6909-X'));
    }
}
