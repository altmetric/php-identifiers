# Identifiers [![Build Status](https://travis-ci.org/altmetric/php-identifiers.svg?branch=master)](https://travis-ci.org/altmetric/php-identifiers)

Collection of utilities related to the extraction, validation and normalization
of various scholarly identifiers.

**Current version:** 0.5.0  
**Supported PHP versions:** 5.4, 5.5, 5.6, 7

## Installation

```shell
$ composer require altmetric/identifiers
```

## Supported identifiers

The supported list is:

* [ADS Bibcodes](http://adsdoc.harvard.edu/abs_doc/help_pages/bibcodes.html);
* [arXiv IDs](https://arxiv.org/help/arxiv_identifier);
* [DOIs](https://www.doi.org/) (including [ISBN-As](https://www.doi.org/factsheets/ISBN-A.html));
* [Handles](https://en.wikipedia.org/wiki/Handle_System);
* [ISBNs](https://en.wikipedia.org/wiki/International_Standard_Book_Number);
* [National Clinical Trial IDs](https://clinicaltrials.gov/);
* [ORCID identifiers](http://orcid.org/);
* [PubMed IDs](http://www.ncbi.nlm.nih.gov/pubmed);
* [RePEc IDs](https://en.wikipedia.org/wiki/Research_Papers_in_Economics);
* [URNs](https://en.wikipedia.org/wiki/Uniform_Resource_Name);
* [URIs](https://en.wikipedia.org/wiki/Uniform_Resource_Identifier).

## API Documentation

### `public AdsBibcode::extract(string $str): array`

```php
use Altmetric\Identifiers\AdsBibcode;

$bibcodes = AdsBibcode::extract('ADS: 1974AJ.....79..819H');
//=> ['1974AJ.....79..819H']
```

Return an array of ADS bibcodes from a given string. Will return an empty array if no matches are found.

### `public ArxivId::extract(string $str): array`

```php
use Altmetric\Identifiers\ArxivId;

$arxivIds = ArxivId::extract("math.GT/0309136\narXiv:1501.00001v2");
//=> ['math.GT/0309136', '1501.00001v2']
```

Return an array of arXiv IDs from a given string. Will return an empty array if no matches are found.

### `public Doi::extract(string $str): array`

```php
use Altmetric\Identifiers\Doi;

$dois = Doi::extract('doi:10.1049/el.2013.3006')
//=> ['10.1049/el.2013.3006']
```

Return an array of DOIs (including [ISBN-As](https://www.doi.org/factsheets/ISBN-A.html)) from a given string. Will return an empty array if no matches are found.

### `public Handle::extract(string $str): array`

```php
use Altmetric\Identifiers\Handle;

$handles = Handle::extract('http://hdl.handle.net/10149/596901')
//=> ['10149/596901']
```

Return an array of Handles from a given string. Will return an empty array if no matches are found.

### `public Isbn::extract(string $str): array`

```php
use Altmetric\Identifiers\Isbn;

$isbns = Isbn::extract("ISBN: 9780805069099\nISBN: 2-7594-0269-X");
//=> ['9780805069099', '9782759402694']
```

Return an array of ISBN-13s from a given string. Will convert ISBN-As and ISBN-10s to ISBN-13s automatically and return an empty array if no matches are found.

### `public NationalClinicalTrialId::extract(string $str): array`

```php
use Altmetric\Identifiers\NationalClinicalTrialId;

$nctIds = NationalClinicalTrialId::extract('Trial ID: NCT00000106');
//=> ['NCT00000106']
```

Return an array of National Clinical Trial IDs from a given string. Will return an empty array if no matches are found.

### `public OrcidId::extract(string $str): array`

```php
use Altmetric\Identifiers\OrcidId;

$orcidIds = OrcidId::extract('orcid.org/0000-0002-0088-0058');
//=> ['0000-0002-0088-0058']
```

Return an array of ORCID identifiers from a given string. Will return an empty array if no matches are found.

### `public PubmedId::extract(string $str): array`

```php
use Altmetric\Identifiers\PubmedId;

$pubmedIds = PubmedId::extract("23193287\n14599470");
```

Return an array of PubMed IDs from a given string. Will return an empty array if no matches are found.

### `public RepecId::extract(string $str): array`

```php
use Altmetric\Identifiers\RepecId;

$repecIds = RepecId::extract("RePEc:wbk:wbpubs:2266\nRePEc:inn:wpaper:2016-03");
//=> ['RePEc:wbk:wbpubs:2266', 'RePEc:inn:wpaper:2016-03']
```

Return an array of RePEc identifiers from a given string. Will return an empty array if no matches are found.

### `public Urn::extract(string $str): array`

```php
use Altmetric\Identifiers\Urn;

$urns = Urn::extract("urn:foo:bar\nURN:FOO:BA%2CZ");
//=> ['urn:foo:bar', 'urn:foo:BA%2cZ']
```

Return an array of URNs from a given string. Will return an empty array if no matches are found.

### `public Uri::extract(string $str): array`

```php
use Altmetric\Identifiers\Uri;

$uris = Uri::extract("http://www.altmetric.com:80/foo?bar#1");
//=> ['http://www.altmetric.com:80/foo?bar#1']
```

Return an array of URIs from a given string. Will return an empty array if no matches are found.

## Ruby version

We also maintain [a version of this library for Ruby](https://github.com/altmetric/identifiers).

## Acknowledgements

* Thanks to Jeff Roberson's ["Regular Expression URI Validation"](http://jmrware.com/articles/2009/uri_regexp/URI_regex.html)

## License

Copyright © 2016-2017 Altmetric LLP

Distributed under the [MIT License](http://opensource.org/licenses/MIT).
