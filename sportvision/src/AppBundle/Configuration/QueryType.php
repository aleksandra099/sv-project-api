<?php

namespace AppBundle\Configuration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationAnnotation;

/**
 * @Annotation
 * @Target("METHOD")
 */
class QueryType extends ConfigurationAnnotation
{
    /**
     * Form type class name or alias
     *
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $data = 'query';

    public function setValue($value) {
        $this->setType($value);
    }

    public function getAliasName()
    {
        return 'query_type';
    }

    public function allowArray()
    {
        return false;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}