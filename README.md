# I18nBundle
Wandi/I18nBundle is a Symfony bundle used to assist internationalization of projects.

## Setup

### Install via composer
```
$ composer require wandi/i18n-bundle
```

### Registering the bundle
```php
$bundles = [
    // ...
    new \Wandi\I18nBundle\WandiI18nBundle(),
];
```

## How to use

### Entity

* Add **TranslatableEntity** trait in your Entity.
* Create many fields as needed foreach languages used.

```php
class Foo
{
    use TranslatableEntity;
    
    // ...
    
    /**
     * @var string
     *
     * @ORM\Column(name="bar_fr", type="string", length=255)
     */
    private $barFr;
    
    /**
     * @var string
     *
     * @ORM\Column(name="bar_en", type="string", length=255)
     */
    private $barEn;
}
```

### View and Controller

* The trait will automatically use the correct getter depending to the current language used. 

#### View 

```twig
{{ Foo.bar }}
```

#### Controller

```php
$foo->getBar();
```

