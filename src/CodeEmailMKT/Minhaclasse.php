<?php

namespace CodeEmailMKT;

class Minhaclasse
{

   const MINHA_CONSTANTE  = "minha constante";

    private $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }
}
