# soluble-explogg

[![PHP Version](http://img.shields.io/badge/php-7.1+-ff69b4.svg)](https://packagist.org/packages/soluble/explog)
[![Build Status](https://travis-ci.org/belgattitude/soluble-explog.svg?branch=master)](https://travis-ci.org/belgattitude/soluble-explog)
[![codecov](https://codecov.io/gh/belgattitude/soluble-explog/branch/master/graph/badge.svg)](https://codecov.io/gh/belgattitude/soluble-explog)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/belgattitude/soluble-explog/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/belgattitude/soluble-explog/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/soluble/explog/v/stable.svg)](https://packagist.org/packages/soluble/explog)
[![Total Downloads](https://poser.pugx.org/soluble/explog/downloads.png)](https://packagist.org/packages/soluble/explog)
[![License](https://poser.pugx.org/soluble/explog/license.png)](https://packagist.org/packages/soluble/explog)


**Experimental** zend-expressive 2.0 out-of-the-box and *(still or forever)* opinionated logger with monolog.  

## Motivations

- Provide ready to use, minimal logging facilities for zend-expressive 2.0 projects (ErrorHandler). 

## Status

Early-days experiment based off this [issue](https://github.com/zendframework/zend-expressive-skeleton/issues/158)

- [x] Separate component from zend-expressive-skeleton.
- [x] Define a `ConfigProvider`, added to `composer.json`.
- [x] Auto-registration of a delegator on the stratigility ErrorHandler. Supported by all DI.
- [ ] Log listener compose a service with a discrete name that should resolve to a PSR-3 logger (this will allow having multiple loggers in your system)
- [ ] It should use Psr\Log\NullLogger by default.
- [ ] Configuration: exclude 404,...

Later on,

- [ ] Unit tests, coverag 100%
- [ ] Documentation

## Documentation

  

