<?php

class EstoqueInsuficienteException extends Exception{
    public function __construct($mensagem){
        parent::__construct($mensagem);
    }
}