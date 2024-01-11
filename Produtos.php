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

class Produto {
    private $nome;
    private $preco;
    private $quantidade;
    private $cadastrado = false; //booleano usado para verificar se o produto já foi preenchido com informações válidas

    public function validar($vetor) { // Verifica se todos os atributos esperados existem no vetor e se estão ou não vazios
        // Atributos esperados para a classe Produto
        $atributosEsperados = array('nome', 'preco', 'quantidade');
        foreach ($atributosEsperados as $atributo) {
            if (empty($vetor[$atributo])) {
                echo "<br>Erro!";
                error_log("Vetor incompleto ou incorreto.", 0);
                return false;
            }
        }
        return true;
    }

    public function verificaCadastro(){ //verifica se o produto não está cadastrado e, se não estiver, exibe log informando isso. 
        if(!$this->cadastrado){ 
            echo "<br>Erro!";
            error_log("Produto não cadastrado.", 0);
            return false;
        }
        return true;
    }
    
    public function setProduto($data) {
        if (!$this->validar($data)) {
            return;
        }
    
        $this->nome = $data['nome'];
        $this->preco = $data['preco'];
        $this->quantidade = $data['quantidade'];
        $this->cadastrado = true; //coloca o valor de cadastrado como verdadeiro, assim é possível identificar que o produto já foi cadastrado corretamente
    
        echo "<br>Produto $this->nome registrado!";
    }

    public function getProduto(){ //Caso esteja cadastrado, exibe suas informações
        if(!$this->verificaCadastro()){ //chamei o método de verificação de cadastro dentro de outros métodos em Produto, pois a responsábilidade de saber ele está cadastrado ou não é dele, não de vendas. Ao fazer isso, tornei a validação do produto transparente na classe de Venda
            return NULL;
        }
        echo "<br>Nome: $this->nome, Preço: $this->preco, Quantidade: $this->quantidade";
        return array('nome' => $this->nome, 'preco' => $this->preco, 'quantidade' => $this->quantidade);
    }
    
    public function diminuirEstoque($quantidadeRetirada){//Caso esteja cadastrado, retira a quantidade exigida do estoque
        if(!$this->verificaCadastro()){
            return;
        }
        if($quantidadeRetirada> $this->quantidade){//Assim como a verificação do cadastro, eu coloquei a validação se a quantidade vendida é maior ou não do que o estoque disponível em produto, pois é obrigação de produto saber se ele tem ou não estoque o suficiente
            echo "<br>Erro!";
            error_log("Quantidade acima do estoque.", 0);
            return;
        }
        $this->quantidade -= $quantidadeRetirada;
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



