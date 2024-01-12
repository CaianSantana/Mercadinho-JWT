<?php

include_once('models/Produto.php');
include_once('models/Venda.php');
include_once('exceptions/ValidacaoException.php');
include_once('exceptions/SemCadastroException.php');
include_once('exceptions/EstoqueInsuficienteException.php');

//classe cliente utilizada apenas para instanciar as outras classes e chamar seus métodos
class App{

    //função estática para não precisar instânciar a classe App fora dela mesma.
    //assim é possível usar o método run sem precisar instanciar a classe
    //além disso, App não fica refém de run() exclusivamente, caso seja necessário criar outros métodos runs(run1, run2 e etc)
    //posso usa-los alterando só uma linha de código na função main
    public static function main(){
        $app = new App();
        $app->run();
    }

    //método usado para instanciar todas as outras classes e chamar seus métodos
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
            'quantidade' => 10,
            'desconto' => 0.2
        );

        //as exceções lançadas durante a execução são tratadas aqui.
        try {
            $produto1->setProduto($dadosProduto);
            $produto1->toString();
            $venda1->setVenda($dadosVenda);
            $venda1->getVenda();
            $produto1->toString();
            $produto2->toString();
        } catch (ValidacaoException | SemCadastroException | EstoqueInsuficienteException | Exception $e) {
            //Mostra a mensagem da exceção na tela do usuário e mostra o nome da exceção no log
            $message = $e->getMessage();
            echo "<br>$message";
            error_log($e, 0);
        }
    }
}

//inicia o método main sem precisar instânciar App, o que torna tudo mais transparente também
//quem vai utilizar o código não precisa saber como App é instânciado, se leva parâmetros em seu construtor e etc...
App::main();