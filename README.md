DI
==========

> DI - dependencies injection container - singleton Pimple wrapper
https://github.com/silexphp/Pimple
* easy access by a method not by an array property
* no need to remember DI array keys (or go back to the DI class to look) every time you need something
* type hinting

## Install

Using Composer and Packagist
https://packagist.org/packages/g4/di

```sh
composer require g4/di
```

## Usage

Services are defined by anonymous functions that return an instance of an object. Define all services in one DI Container class inside your application:
```php

namespace MyNamespace;

use G4\DI\Container;

class DI extends Container
{
    /**
     * @return \MyNamespace\MyConfig
     */
    public static function configInstance()
    {
        return self::registerShare(function (DI $c) {
            return new \MyNamespace\MyConfig();
        });
    }
    
    /**
     * @return \MyNamespace\MyClass
     */
    public static function myClassInstance()
    {
        return self::registerFactory(function (DI $c) {
            return new \MyNamespace\MyClass($c::configInstance());
        });
    }
}
```
Methods
* registerFactory($callable) - Register a service that will each time return new instance of it
* registerShare($callable) - Register a service that will each time return the same instance of it


Using the defined services
```php

use MyNamespace\DI;

$myClass = DI::myClassInstance();

// the above call is equivalent to:
// $myConfig = new \MyNamespace\MyConfig();
// $myClass = new \MyNamespace\MyClass($myConfig);
```

## Development

### Install dependencies

    $ make install

### Run tests

    $ make test

## License

(The MIT License)
see LICENSE file for details...
