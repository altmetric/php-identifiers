<?php
namespace Altmetric\Identifiers;

use Altmetric\Identifiers\Isbn;

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
}
