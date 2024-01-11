<?php
class Venda {
    //vendas contem produto e não herda de produto, afinal, venda não é um produto
    private $produto = NULL; 
    private $valor = 0;
    private $quantidade = 0;
    private $desconto = 0;

    // Valida os valores do array "vetor"
    //se não estiverem de acordo com o exigido, lança exceção informando isso.
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
                throw new ValidacaoException("Quantidade precisa ser int, não pode ser negativo e não pode ser maior do que quantidade em estoque.");
            }
            elseif(!is_float($vetor['desconto']) || $vetor['desconto']<0 || $vetor['desconto']>1){
                throw new ValidacaoException("Desconto precisa ser float, não pode ser negativo e nem maior que 0.");
            }
        }
        return true;
    }

    //caso tudo esteja válido, executa a venda do produto
    //nessa função, há 3 possíveis lançamentos de exceção: em validar(); em diminuirEstoque(); e em getProduto();
    public function setVenda($vetorProduto){
        $this->validar($vetorProduto);
        $vetorProduto['produto']->diminuirEstoque($vetorProduto['quantidade']);
        $this->produto = $vetorProduto['produto']->getProduto();
        $this->quantidade = $vetorProduto['quantidade'];
        $this->desconto = $vetorProduto['desconto'];
        $this->valor = $this->produto['preco'] - $this->produto['preco']*$this->desconto;
    }

    //Caso a venda seja válida, exibe ela
    //se não estiver de acordo com o exigido, lança exceção informando isso.
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