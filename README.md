# Identifiers [![Build Status](https://travis-ci.org/altmetric/php-identifiers.svg?branch=master)](https://travis-ci.org/altmetric/php-identifiers)

*This project is currently still in progress.*

Collection of utilities related to the extraction, validation and normalization
of various scholarly identifiers. The supported list is:

* [ADS Bibcodes](http://adsdoc.harvard.edu/abs_doc/help_pages/bibcodes.html);
* [National Clinical Trial IDs](https://clinicaltrials.gov/);
* [ORCID identifiers](http://orcid.org/).

## API Documentation

### `AdsBibcode::extract($str)`

```php
use Altmetric\Identifiers\AdsBibcode;

$bibcodes = AdsBibcode::extract('1974AJ.....79..819H');
```

Return an array of ADS bibcodes from a given string. Will return an empty array if no matches are found.

### `NationalClinicalTrialId::extract($str)`

```php
use Altmetric\Identifiers\NationalClinicalTrialId;

$nctIds = NationalClinicalTrialId::extract('NCT00000106');
```

Return an array of National Clinical Trial IDs from a given string. Will return an empty array if no matches are found.

### `OrcidId::extract($str)`

```php
use Altmetric\Identifiers\OrcidId;

$orcidIds = OrcidId::extract('0000-0002-0088-0058');
```

Return an array of ORCID identifiers from a given string. Will return an empty array if no matches are found.

## License

Copyright © 2016 Altmetric LLP

Distributed under the [MIT License](http://opensource.org/licenses/MIT).
