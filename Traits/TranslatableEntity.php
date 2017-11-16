<?php

namespace Wandi\I18nBundle\Traits;

use Symfony\Component\PropertyAccess\Exception\RuntimeException;
use Symfony\Component\PropertyAccess\PropertyAccess;

trait TranslatableEntity
{
    private $locale = null;

    public function __call($name, $args=array())
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        $name = $name.$this->locale;

        if (substr($name, 0, 3) == "get") {
            $name = lcfirst(substr($name, 3));
        }

        if ($accessor->isReadable($this, $name)){
            return $accessor->getValue($this, $name);
        }

        throw new RuntimeException('Neither the property "'.$name.'" nor one of the methods "'.$name.'()", "get'.ucfirst($name).'()"/"is'.ucfirst($name).'()" or "get'.ucfirst($name).ucfirst($this->locale).'()" exist and have public access in class "'.get_class().'"');
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}
