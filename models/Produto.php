<?php
class Produto {
    private $nome;
    private $preco;
    private $quantidade;
    //booleano usado para verificar se o produto já foi preenchido com informações válidas
    private $cadastrado = false;

    // Verifica se todos os atributos esperados existem no vetor, são do tipo correto e se estão ou não vazios
    //se não estiverem de acordo com o exigido, lança exceção informando isso.
    public function validar($vetor) {
        $atributosEsperados = array('nome', 'preco', 'quantidade');
        //verifica cada elemento do array "vetor"
        foreach ($atributosEsperados as $atributo) {
            if (empty($vetor[$atributo])) {
                throw new ValidacaoException("O vetor fornecido não contém o atributo necessário: $atributo.");
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

    //verifica se o produto não está cadastrado e, se não estiver, lança exceção informando isso. 
    public function verificaCadastro(){ 
        if(!$this->cadastrado){ 
            throw new SemCadastroException("O produto não está cadastrado.");
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

    //Caso esteja cadastrado, retorna suas informações em forma de array, assim eu posso controlar o quanto eu quero revelar sobre os atributos que a classe possui.
    public function getProduto(){ 
        $this->verificaCadastro();
        return array('nome' => $this->nome, 'preco' => $this->preco, 'quantidade' => $this->quantidade);
    }
    
    //Caso esteja cadastrado, retira a quantidade exigida do estoque
    //se não estiver de acordo com o exigido, lança exceção informando isso.
    public function diminuirEstoque($quantidadeRetirada){
        $this->verificaCadastro();
        //Assim como a verificação do cadastro, eu coloquei a validação se a quantidade vendida é maior ou não do que o estoque disponível em produto
        //pois é obrigação de produto saber se ele tem ou não estoque o suficiente
        if($quantidadeRetirada> $this->quantidade){
            throw new EstoqueInsuficienteException("A quantidade solicitada excede o estoque disponível.");
        }
        $this->quantidade -= $quantidadeRetirada;
    }

    //Caso esteja cadastrado, printa suas informações e retorna sua string
    public function toString(){
        $this->verificaCadastro();
        $string = "<br>Nome: $this->nome, Preço: $this->preco, Quantidade: $this->quantidade";
        echo "$string";
        return $string;
    }
}