<?php

include_once('models/Produtos.php');
include_once('models/Vendas.php');
include_once('exceptions/ValidacaoException.php');
include_once('exceptions/SemCadastroException.php');
include_once('exceptions/EstoqueInsuficienteException.php');

class App{
    public function run(){
        $produto1 = new Produto();
        $produto2 = new Produto();
        $venda1 = new Venda();

        $dadosProduto = array(
            'nome' => 'A',
            'preco' => 19.99,
            'quantidade' => 50
        );

        $dadosVenda = array(
            'produto' => $produto1,
            'quantidade' => 50,
            'desconto' => 0.2
        );

        try {
            $produto1->setProduto($dadosProduto);
            $venda1->setVenda($dadosVenda);
            $venda1->getVenda();
        } catch (ValidacaoException | SemCadastroException | EstoqueInsuficienteException | Exception $e) {
            error_log($e->getMessage(), 0);
        }
    }
}

class Main{
    public static function main(){
        $app = new App();
        $app->run();
    }
}

Main::main();