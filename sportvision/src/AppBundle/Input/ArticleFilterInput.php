<?php

namespace AppBundle\Input;


class ArticleFilterInput
{
    /** @var  int */
    public $page = 1;

    /** @var  int */
    public $limit = 10;

    /** @var  string */
    public $type;

    /** @var  string */
    public $gender;

    /** @var  string */
    public $sport;

    /** @var  string */
    public $name;
}