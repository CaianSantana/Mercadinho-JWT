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


interface validador{
    public function validar($dados);
}

class Produto implements validador{
    public $nome;
    public $preco;
    public $quantidade;

    public function validar($vetor) {
        // Atributos esperados para a classe Produto
        $atributosEsperados = array('nome', 'preco', 'quantidade');
        // Verifica se todos os atributos esperados existem no vetor
        foreach ($atributosEsperados as $atributo) {
            if (empty($vetor[$atributo])) {
                return false;
            }
        }
        return true;
    }
    
    public function setProduto($data) {
        if (!$this->validar($data)) {
            echo "Erro!<br>";
            error_log("Vetor incompleto ou incorreto.", 0);
            return;
        }
    
        $this->nome = $data['nome'];
        $this->preco = $data['preco'];
        $this->quantidade = $data['quantidade'];
    
        echo "Produto $this->nome registrado!<br>";
        echo "Nome: $this->nome, Preço: $this->preco, Quantidade: $this->quantidade";
    }
    
    
}

// Exemplo de uso da classe Produto
$produto = new Produto();

// Dados a serem cadastrados em forma de array
$dados = array(
    'jorge' => 'A',
    'preco' => 19.99,
    'quantidade' => 50
);

// Chamando o método setProduto para cadastrar os dados
$produto->setProduto($dados);


