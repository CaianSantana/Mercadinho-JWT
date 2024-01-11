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
include_once('../exceptions/ValidacaoException.php');
include_once('../exceptions/SemCadastroException.php');
include_once('../exceptions/EstoqueInsuficienteException.php');
class Produto {
    private $nome;
    private $preco;
    private $quantidade;
     //booleano usado para verificar se o produto já foi preenchido com informações válidas
    private $cadastrado = false;

    // Verifica se todos os atributos esperados existem no vetor, são do tipo correto e se estão ou não vazios
    public function validar($vetor) {
        $atributosEsperados = array('nome', 'preco', 'quantidade');
        //verifica cada elemento do array "vetor"
        foreach ($atributosEsperados as $atributo) {
            if (empty($vetor[$atributo])) {
                throw new ValidacaoException('Vetor incompleto ou incorreto.');
            }
            if(!is_string($vetor['nome'])){
                throw new ValidacaoException('Nome precisa ser uma String.');
            }
            if(!is_float($vetor['preco']) || $vetor['preco']<0){
                throw new ValidacaoException('Preço precisa ser float e não pode ser negativo.');
            }
            if(!is_int($vetor['quantidade']) || $vetor['quantidade']<0){
                throw new ValidacaoException('Quantidade precisa ser int e não pode ser negativo.');
            }
        }
    }

    //verifica se o produto não está cadastrado e, se não estiver, exibe log informando isso. 
    public function verificaCadastro(){ 
        if(!$this->cadastrado){ 
            throw new SemCadastroException('Produto não cadastrado.');
        }
    }
    
    //caso tudo esteja válido, cadastra o produto
    public function setProduto($data) {
        $this->validar($data);

        $this->nome = $data['nome'];
        $this->preco = $data['preco'];
        $this->quantidade = $data['quantidade'];
        //coloca o valor de cadastrado como verdadeiro, assim é possível identificar que o produto já foi cadastrado corretamente
        $this->cadastrado = true; 
    
        echo "<br>Produto $this->nome registrado!";
    }

    //Caso esteja cadastrado, exibe suas informações
    public function getProduto(){ 
        $this->verificaCadastro();
        echo "<br>Nome: $this->nome, Preço: $this->preco, Quantidade: $this->quantidade";
        return array('nome' => $this->nome, 'preco' => $this->preco, 'quantidade' => $this->quantidade);
    }
    
    //Caso esteja cadastrado, retira a quantidade exigida do estoque
    public function diminuirEstoque($quantidadeRetirada){
        $this->verificaCadastro();
        //Assim como a verificação do cadastro, eu coloquei a validação se a quantidade vendida é maior ou não do que o estoque disponível em produto
        //pois é obrigação de produto saber se ele tem ou não estoque o suficiente
        if($quantidadeRetirada> $this->quantidade){
            throw new EstoqueInsuficienteException('Quantidade acima do estoque.');
        }
        $this->quantidade -= $quantidadeRetirada;
    }
}