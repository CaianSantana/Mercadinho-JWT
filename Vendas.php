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

require_once 'Produtos.php';
class Venda {
    private $produto = NULL; //vendas contem produto e não herda de produto, afinal, venda não é um produto
    private $valor = 0;
    private $quantidade = 0;
    private $desconto = 0;

    public function validar($vetor) { // Verifica se todos os atributos esperados existem no vetor e se estão ou não vazios
        $atributosEsperados = array('produto', 'quantidade', 'desconto');
        foreach ($atributosEsperados as $atributo) {
            if (!isset($vetor[$atributo])) {
                echo "<br>Erro na venda!";
                error_log("Vetor incompleto ou incorreto.", 0);
                return false;
            }
            if(!$vetor['produto'] instanceof Produto){
                echo "<br>Erro na venda!";
                error_log("Este produto não é instância de Produto.", 0);
                return false;
            }
            elseif(!is_int($vetor['quantidade']) || $vetor['quantidade']<0){
                echo "<br>Erro na venda!";
                error_log("Quantidade inválida.", 0);
                return false;
            }
            elseif(!is_float($vetor['desconto']) || $vetor['desconto']<0 || $vetor['desconto']>1){
                echo "<br>Erro na venda!";
                error_log("Desconto inválido.", 0);
                return false;
            }
        }
        return true;
    }

    public function setVenda($vetorProduto){
        if(!$this->validar($vetorProduto)){
            return;
        }
        $vetorProduto['produto']->diminuirEstoque($vetorProduto['quantidade']);
        $this->produto = $vetorProduto['produto']->getProduto();
        $this->quantidade = $vetorProduto['quantidade'];
        $this->desconto = $vetorProduto['desconto'];
        $this->valor = $this->produto['preco'] - $this->produto['preco']*$this->desconto;
    }

    public function getVenda(){
        if($this->produto == NULL){
            return;
        }
        $atributosProduto =  $this->produto;
        echo "<br>Última venda realizada:
        <br>Produto = $atributosProduto[nome];
        <br>Quantidade = $this->quantidade;
        <br>Valor final = $this->valor;
        <br>Desconto = $this->desconto;
        <br>Estoque Atual do Produto = $atributosProduto[quantidade]; ";
    }

    public function calculaDesconto(){
        return $this->produto['preco'] - $this->produto['preco']*$this->desconto;
    }
}

// Exemplo de uso da classe Produto
$produto1 = new Produto();
$venda1 = new Venda();

// Dados a serem cadastrados em forma de array
$dadosProduto = array(
    'nome' => 'A',
    'preco' => 19.99,
    'quantidade' => 50
);

// Dados a serem cadastrados em forma de array
$dadosVenda = array(
    'produto' => $produto1,
    'quantidade' => 20,
    'desconto' => 0.2
);

// Chamando o método setProduto para cadastrar os dados
$produto1->setProduto($dadosProduto);
$venda1->setVenda($dadosVenda);
$venda1->getVenda();
$produto1->diminuirEstoque(10);