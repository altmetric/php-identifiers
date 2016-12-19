# Identifiers [![Build Status](https://travis-ci.org/altmetric/php-identifiers.svg?branch=master)](https://travis-ci.org/altmetric/php-identifiers)

*This project is currently still in progress.*

Collection of utilities related to the extraction, validation and normalization
of various scholarly identifiers. The supported list is:

* [ADS Bibcodes](http://adsdoc.harvard.edu/abs_doc/help_pages/bibcodes.html);
* [ISBNs](https://en.wikipedia.org/wiki/International_Standard_Book_Number)
* [National Clinical Trial IDs](https://clinicaltrials.gov/);
* [ORCID identifiers](http://orcid.org/).

## API Documentation

### `AdsBibcode::extract($str)`

```php
use Altmetric\Identifiers\AdsBibcode;

$bibcodes = AdsBibcode::extract('ADS: 1974AJ.....79..819H');
//=> ['1974AJ.....79..819H']
```

Return an array of ADS bibcodes from a given string. Will return an empty array if no matches are found.

### `Isbn::extract($str)`

```php
use Altmetric\Identifiers\Isbn;

$isbns = Isbn::extract("ISBN: 9780805069099\nISBN: 2-7594-0269-X");
//=> ['9780805069099', '9782759402694']
```

Return an array of ISBN-13s from a given string. Will convert ISBN-10s to ISBN-13s automatically and return an empty array if no matches are found.

### `NationalClinicalTrialId::extract($str)`

```php
use Altmetric\Identifiers\NationalClinicalTrialId;

$nctIds = NationalClinicalTrialId::extract('Trial ID: NCT00000106');
//=> ['NCT00000106']
```

Return an array of National Clinical Trial IDs from a given string. Will return an empty array if no matches are found.

### `OrcidId::extract($str)`

```php
use Altmetric\Identifiers\OrcidId;

$orcidIds = OrcidId::extract('orcid.org/0000-0002-0088-0058');
//=> ['0000-0002-0088-0058']
```

Return an array of ORCID identifiers from a given string. Will return an empty array if no matches are found.

## License

Copyright © 2016 Altmetric LLP

Distributed under the [MIT License](http://opensource.org/licenses/MIT).
