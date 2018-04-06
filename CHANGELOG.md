# Change Log
All notable changes to this project will be documented in this file. This
project adheres to [Semantic Versioning](http://semver.org/).

## [0.9.0] - 2018-04-06
### Added
- Added support for extracting more old Wiley DOIs

### Changed
- Performance improvements when extracting DOIs with trailing punctuation

## [0.8.0] - 2017-11-22
### Added
- Support extracting PubMed IDs from PubMed URLs and URIs with the pmid or info
  scheme

## [0.7.0] - 2017-07-01
### Changed
- Extracting arXiv IDs and ISBNs no longer deduplicates identifiers by default

### Fixed
- Don't extract duplicate ISBN-10s from within ISBN-13s

## [0.6.0] - 2017-07-31
### Added
- Support extracting multiple ISBNs separated by a single space

## [0.5.1] - 2017-04-11
### Fixed
- Use multibyte-aware string functions to avoid mangling DOIs in Unicode strings

## [0.5.0] - 2017-04-10
### Added
- Support for ISBNs with digits separated by Unicode whitespace and dashes
- Improved extraction of RePEc IDs from Unicode strings
- Improved extraction of NCT IDs from Unicode strings
- Improved extraction of PubMed IDs from Unicode strings
- Improved extraction of Handle IDs from Unicode strings
- Improved extraction of ADS Bibcodes from Unicode strings
- Support for valid DOIs ending in punctuation

## [0.4.0] - 2017-01-27
### Added
- Support for ISBN-As when extracting DOIs and ISBNs

## [0.3.0] - 2017-01-26
### Added
- Support for extracting URIs

## [0.2.0] - 2017-01-23
### Changed
- Extract ISBNs separated by spaces as well as hyphens

## [0.1.1] - 2017-01-13
### Fixed
- Fixed namespace-specific strings being truncated for URNs

## [0.1.0] - 2016-12-19
### Added
- Initial release

[0.1.0]: https://github.com/altmetric/php-identifiers/releases/tag/v0.1.0
[0.1.1]: https://github.com/altmetric/php-identifiers/releases/tag/v0.1.1
[0.2.0]: https://github.com/altmetric/php-identifiers/releases/tag/v0.2.0
[0.3.0]: https://github.com/altmetric/php-identifiers/releases/tag/v0.3.0
[0.4.0]: https://github.com/altmetric/php-identifiers/releases/tag/v0.4.0
[0.5.0]: https://github.com/altmetric/php-identifiers/releases/tag/v0.5.0
[0.5.1]: https://github.com/altmetric/php-identifiers/releases/tag/v0.5.1
[0.6.0]: https://github.com/altmetric/php-identifiers/releases/tag/v0.6.0
[0.7.0]: https://github.com/altmetric/php-identifiers/releases/tag/v0.7.0
[0.8.0]: https://github.com/altmetric/php-identifiers/releases/tag/v0.8.0
[0.9.0]: https://github.com/altmetric/php-identifiers/releases/tag/v0.9.0
