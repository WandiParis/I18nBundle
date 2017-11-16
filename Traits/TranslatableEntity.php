<?php

namespace Wandi\I18nBundle\Traits;

use Symfony\Component\PropertyAccess\Exception\RuntimeException;

trait TranslatableEntity
{
    private $locale = null;

    public function __call($name, $args=array())
    {
        $methodName = ((strtolower(substr($name, 0, 3) == "get")) ? "" : "get").ucfirst($name).ucfirst($this->locale);
        if (method_exists($this, $methodName)){
            return $this->$methodName();
        }
        throw new RuntimeException('Neither the property "'.$name.'" nor one of the methods "'.$name.'()", "get'.ucfirst($name).'()"/"is'.ucfirst($name).'()" or "get'.ucfirst($name).ucfirst($this->locale).'()" exist and have public access in class "'.get_class().'"');
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}
