<?php

/*
Após a conclusão da classe Produto, deve-se criar a classe Venda, que herdará os
atributos da classe produto, possuindo em seus próprios atributos a quantidade e
desconto.
Dentro da classe `Venda`, devem ser implementados os seguintes métodos:
- getVenda;
- setVenda.
O método setVenda é responsável pelo registro da venda. Inicialmente, ele deve
verificar se o produto está cadastrado. Em caso afirmativo, deve validar o estoque do
produto e, em seguida, permitir a venda do produto. Após a conclusão da venda, é
necessário utilizar o método getVenda para exibir a última venda registrada e informar o
estoque atual do produto. 
*/
include_once('../exceptions/ValidacaoException.php');
include_once('../exceptions/SemCadastroException.php');
include_once('../exceptions/EstoqueInsuficienteException.php');
require_once 'Produtos.php';
class Venda {
    //vendas contem produto e não herda de produto, afinal, venda não é um produto
    private $produto = NULL; 
    private $valor = 0;
    private $quantidade = 0;
    private $desconto = 0;

    // Valida os valores do array "vetor"
    public function validar($vetor) { 
        $atributosEsperados = array('produto', 'quantidade', 'desconto');
        //verifica cada elemento do array "vetor"
        foreach ($atributosEsperados as $atributo) {
            if (!isset($vetor[$atributo])) {
                throw new ValidacaoException("Vetor incompleto ou incorreto.");
            }
            if(!$vetor['produto'] instanceof Produto){
                throw new ValidacaoException("Este produto não é instância da classe Produto.");
            }
            elseif(!is_int($vetor['quantidade']) || $vetor['quantidade']<0){
                throw new ValidacaoException("Quantidade inválida.");
            }
            elseif(!is_float($vetor['desconto']) || $vetor['desconto']<0 || $vetor['desconto']>1){
                throw new ValidacaoException("Desconto inválido.");
            }
        }
        return true;
    }

    //caso tudo esteja válido, executa a venda do produto
    public function setVenda($vetorProduto){
        $this->validar($vetorProduto);
        $vetorProduto['produto']->diminuirEstoque($vetorProduto['quantidade']);
        $this->produto = $vetorProduto['produto']->getProduto();
        $this->quantidade = $vetorProduto['quantidade'];
        $this->desconto = $vetorProduto['desconto'];
        $this->valor = $this->produto['preco'] - $this->produto['preco']*$this->desconto;
    }

    //Caso a venda seja válida, exibe ela
    public function getVenda(){
        $atributosProduto =  $this->produto;
        if($atributosProduto == NULL){
            throw new Exception("Venda inválida.");
        }
        echo "<br>Última venda realizada:
        <br>Produto = $atributosProduto[nome];
        <br>Quantidade = $this->quantidade;
        <br>Valor final = $this->valor;
        <br>Desconto = $this->desconto;
        <br>Estoque Atual do Produto = $atributosProduto[quantidade]; ";
    }
}

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