<?php

namespace Ejemplos\act31\model\vo;

interface Vo
{
    public function toArray():array;
    public function fromArray(array $data);
}