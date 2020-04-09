# minimalism-service-api-caller

**minimalism-service-api-caller** is a service for [minimalism](https://github.com/carlonicora/minimalism) to call
[{json:api}](https://jsonapi.org) based APIs.

## Getting Started

To use this library, you need to have an application using minimalism. This library does not work outside this scope.

### Prerequisite

You should have read the [minimalism documentation](https://github.com/carlonicora/minimalism/readme.md) and understand
the concepts of services in the framework.

Encrypter requires either the [cURL](https://www.php.net/manual/en/book.curl.php) extension in order to work.

### Installing

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```
$ composer require carlonicora/minimalism-service-api-caller
```

or simply add the requirement in `composer.json`

```json
{
    "require": {
        "carlonicora/minimalism-service-api-caller": "~1.0"
    }
}
```

## Deployment

This service does not require any parameter in your `.env` file in order to work. You can, however, specify if you allow
unsafe calls

### Optional parameters

```dotenv
#default to false
ALLOW_UNSAFE_API_CALLS=true|false
```

## Build With

* [minimalism](https://github.com/carlonicora/minimalism) - minimal modular PHP MVC framework
* [minimalism-service-jsonapi](https://github.com/carlonicora/minimalism-service-jsonapi)
* [minimalism-service-security](https://github.com/carlonicora/minimalism-service-security)

## Versioning

This project use [Semantiv Versioning](https://semver.org/) for its tags.

## Authors

* **Carlo Nicora** - Initial version - [GitHub](https://github.com/carlonicora) |
[phlow](https://phlow.com/@carlo)

# License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT) - see the
[LICENSE.md](LICENSE.md) file for details 

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)