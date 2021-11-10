<?php

namespace App\Entity;

abstract class BaseEntity
{
    public function fillFromArray(array $postValues){
        foreach($postValues as $key => $value) {
            $set = 'set' . ucfirst($key);
            if (strtolower($key) !== 'id') {
                $this->$set($value);
            }
        }
    }

}