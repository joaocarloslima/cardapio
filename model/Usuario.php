<?php

class Usuario{
    public int $id;
    public string $email;
    public string $senha;

    function __construct($id, $email, $senha){
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;
    }
}