<?php
/*
A aplicação deve incluir uma classe responsável pelo cadastro
de produtos, com os atributos de nome, preço e quantidade. A classe Produto deve
conter um método setProduto, que terá um parâmetro chamado data, representando
um array contendo informações como nome, preço e quantidade. Esse método será
responsável por cadastrar o produto e alimentar os atributos da classe. Além disso, a
classe deve possuir o método getProduto, que será responsável apenas por exibir o
produto atualmente cadastrado.
*/
require_once 'Validador.php';

class Produto implements validador{
    private $nome;
    private $preco;
    private $quantidade;
    private $cadastrado = false; //booleano usado para verificar se o produto já foi preenchido com informações válidas

    public function validar($vetor) { // Verifica se todos os atributos esperados existem no vetor e se estão ou não vazios
        // Atributos esperados para a classe Produto
        $atributosEsperados = array('nome', 'preco', 'quantidade');
        foreach ($atributosEsperados as $atributo) {
            if (empty($vetor[$atributo])) {
                return false;
            }
        }
        return true;
    }
    
    public function setProduto($data) {
        if (!$this->validar($data)) {
            echo "<br>Erro!";
            error_log("Vetor incompleto ou incorreto.", 0);
            return;
        }
    
        $this->nome = $data['nome'];
        $this->preco = $data['preco'];
        $this->quantidade = $data['quantidade'];
        $this->cadastrado = true; //coloca o valor de cadastrado como verdadeiro, assim é possível identificar que o produto já foi cadastrado corretamente
    
        echo "<br>Produto $this->nome registrado!";
    }

    public function getProduto(){ //verifica se o produto não está cadastrado e, se não estiver, exibe log informando isso. Caso esteja cadastrado, exibe suas informações
        if(!$this->cadastrado){
            echo "<br>Erro!";
            error_log("Produto não cadastrado.", 0);
            return;
        }
        echo "<br>Nome: $this->nome, Preço: $this->preco, Quantidade: $this->quantidade";
    }
    
    public function vender($quantidadeVendida){
        if(!is_int($quantidadeVendida) || $quantidadeVendida<0 || $quantidadeVendida> $this->quantidade){
            echo "<br>Erro!";
            error_log("Quantidade inválida.", 0);
            return;
        }
        $this->quantidade -= $quantidadeVendida;
    }
}

// Exemplo de uso da classe Produto
$produto1 = new Produto();
$produto2 = new Produto();

// Dados a serem cadastrados em forma de array
$dados = array(
    'nome' => 'A',
    'preco' => 19.99,
    'quantidade' => 50
);

// Chamando o método setProduto para cadastrar os dados
$produto1->setProduto($dados);
$produto1->getProduto();
$produto1->vender(10);
$produto1->getProduto();
$produto2->getProduto();



