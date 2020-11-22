### Development

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Added case-sensitive option for encoding validation.

## 2.0.1

### Added
- Added docs directory with additional documentation.

## 2.0.0

### Added
- Added support for PSR-4 autoloading.
- Added ability to validate encoding.
- Added SECURITY.md policy.
- Added static analysis tools.
- Added FUNDING.yml policy.
- Added proxy support for static calls to encoder.
- Added contracts to all public methods that are not internal.
- Added an option to control the default encoding.
- Added an option to remove the UTF-8 BOM.
- Added support for mb regex.

### Changed
- Removed support for PHP < 7.2.
- Updated dependencies.
- Added changelog.

### Removed
- Removed the `Encode` object.