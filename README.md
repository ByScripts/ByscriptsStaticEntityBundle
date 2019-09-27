# Byscripts Static Entity Bundle

This bundle brings ParamConverter and FormType supports to Symfony 3 and Symfony 4 for the [StaticEntity library](https://github.com/ByScripts/ByscriptsStaticEntity).

If you just need to use StaticEntity, and don't need the FormType and ParamConverter support, then this bundle is NOT required.

You can use StaticEntity in your project like any other library.

**This 4.x branch supports Symfony 3 and Symfony 4**

Use branch 3.x for SymfonyFrameworkBundle 3.x (Used by Symfony 2.4+)

For support of SensioFrameworkBundle 2.x (Used by Symfony 2.3), use the 1.x branch

## Installation

### Add the package in your composer.json

At command line, run `composer require byscripts/static-entity-bundle:~4.0`

### Enable the Bundle

#### Symfony 3

Add `Byscripts\Bundle\StaticEntityBundle\ByscriptsStaticEntityBundle` to the `app/AppKernel.php` file.

#### Symfony 4

Add `Byscripts\Bundle\StaticEntityBundle\ByscriptsStaticEntityBundle::class => ['all' => true]` to the `config/bundles.php` file. 

## Usage

### Create a static entity

First, create a static entity on your project (for example, in `src/AppBundle/StaticEntity`)

```php
<?php

namespace AppBundle\StaticEntity;

use Byscripts\StaticEntity\StaticEntity;

class Civility extends StaticEntity
{
    private $name;
    private $shortName;

    public static function getDataSet()
    {
        return array(
            'mr' => array('name' => 'Mister', 'shortName' => 'Mr'),
            'mrs' => array('name' => 'Misses', 'shortName' => 'Mrs'),
        );
    }
}
```

For more details on usage of Static Entities, look at [StaticEntity README.md](https://github.com/ByScripts/ByscriptsStaticEntity/blob/master/README.md)

### Use the FormType

```php
$builder->add('civility', StaticEntityType, $parameters);
```

#### List of parameters

| class    | required | FQCN of the static entity                       | null      |
| function | optional | The function to use to get SE instances         | getAll    |

`StaticEntityType` extends the native `ChoiceType` and can use any of its options.

### Use the ParamConverter

```php
class MyController
{
    public function myAction(Civility $civility)
    {
        $name = $civility->getName();
    }
}
```
