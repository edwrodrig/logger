edwrodrig\logger
========
Small fancy logger with indentation facilities

[![Latest Stable Version](https://poser.pugx.org/edwrodrig/logger/v/stable)](https://packagist.org/packages/edwrodrig/logger)
[![Total Downloads](https://poser.pugx.org/edwrodrig/logger/downloads)](https://packagist.org/packages/edwrodrig/logger)
[![License](https://poser.pugx.org/edwrodrig/logger/license)](https://packagist.org/packages/edwrodrig/logger)
[![Build Status](https://travis-ci.org/edwrodrig/logger.svg?branch=master)](https://travis-ci.org/edwrodrig/logger)
[![codecov.io Code Coverage](https://codecov.io/gh/edwrodrig/logger/branch/master/graph/badge.svg)](https://codecov.io/github/edwrodrig/logger?branch=master)
[![Code Climate](https://codeclimate.com/github/edwrodrig/logger/badges/gpa.svg)](https://codeclimate.com/github/edwrodrig/logger)

 
## My use cases

 * A simple form to indent log if there are some nesting context.
 * Indent only when needed. When there is no logs inside
 * Compatible with php resources interface
 * I want to maintain the things as [simple as possible](https://en.wikipedia.org/wiki/KISS_principle)  

My infrastructure is targeted to __Ubuntu 16.04__ machines with last __php7.4__ installed from [ppa:ondrej/php](https://launchpad.net/~ondrej/+archive/ubuntu/php).
I'm sure that there are way to make it compatible with windows but I don't have time to program it and testing,
but I'm open for pull requests to make it more compatible.

## Documentation
The source code is documented using [phpDocumentor](http://docs.phpdoc.org/references/phpdoc/basic-syntax.html) style,
so it should pop up nicely if you're using IDEs like [PhpStorm](https://www.jetbrains.com/phpstorm) or similar.

![Architecture](https://github.com/edwrodrig/logger/raw/master/docs/images/arch.jpg "Architecture")
![Quick Reference](https://github.com/edwrodrig/logger/raw/master/docs/images/quick_reference.jpg "Quick Reference")

### Examples

There is a [example page](https://github.com/edwrodrig/logger/tree/master/examples) how to use the logger


## Composer
```
composer require edwrodrig/logger
```

## Testing
The test are built using PhpUnit. It generates images and compare the signature with expected ones. Maybe some test fails due metadata of some generated images, but at the moment I haven't any reported issue.

## License
MIT license. Use it as you want at your own risk.

## About language
I'm not a native english writer, so there may be a lot of grammar and orthographical errors on text, I'm just trying my best. But feel free to correct my language, any contribution is welcome and for me they are a learning instance.

