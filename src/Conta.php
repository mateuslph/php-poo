<?php

class Conta
{
    private $titular;  // atributo da "Conta"
    private $saldo;  // atributo da "Conta"
    private static $numeroDeContas = 0;  /* esse atributo eh "static" porque fica fixado na classe "Conta", e nao eh 
    requisitado ao criar o objeto. Porque cada vez que o objeto dessa classe for criado eh incrementado um numero
    significando um novo objeto, do contrario se o incrementador ficasse no objeto o incrementador representaria um determinado
    numero daquele ojeto e nao de todos da classe criada */

    public function __construct(Titular $titular)  /* dentro de classes as funcoes sao chamadas de metodos. Esse eh o metodo construtor, 
    deve-se colocar apenas o necessario, e isso compreende a dados, esses nao devem ser colocado diretamente na criacao da classe */
    {
        $this->titular = $titular;  // aqui diz: em "Conta" acessando "titular", recebe a variavel titular incrementada
        $this->saldo = 0;  // o saldo eh iniciado com zero

        self::$numeroDeContas++;  /* "self" eh uma pseudo-variavel, e faz referencia a classe atual. Os "::" foram usado para acessar um 
        atributo da classe, e nao do objeto */
    }

    public function __destruct()  /* quando eh excluida a variavel de referencia de um objeto logo esse objeto fica solto na memoria
    do computador, entao o "Garbage Collector" (Coletor de Lixo) detecta que esse endereco de memoria esta sem uso e o exclui*/
    {
        self::$numeroDeContas--;
    }

    public function saca(float $valorASacar): void  /* "void" significa nao retornar nada, eh importante exclarecer esses casos tambem. 
    Para fazer o saque ao inves do metodo exigir como parametro a conta criada e o valor a sacar, o "this" facilita, necessitando apenas 
    o objeto (que eh a conta criada) acessar o metodo (saca) passando como parametro somente o valor a sacar ($valorASacar) */
    {  // qualquer metodo e funcoes devem abrir as chaves na linha de baixo, e nela nao codificar nada
        if ($valorASacar > $this->saldo) {  // qualquer estrutura de controle de fluxo deve abrir as chaves na mesma linha do seu inicio
            echo "Saldo indisponível";
            return;
        }

        $this->saldo -= $valorASacar;  /* "this" eh uma pseudo-variavel, e faz referencia ao objeto atual. A "->" foi usado para acessar
        um atributo do objeto, e nao da classe */
    }

    public function deposita(float $valorADepositar): void
    {
        if ($valorADepositar < 0) {
            echo "Valor precisa ser positivo";
            return;
        }

        $this->saldo += $valorADepositar;
    }

    public function transfere(float $valorATransferir, Conta $contaDestino): void
    {
        if ($valorATransferir > $this->saldo) {
            echo "Saldo indisponível";
            return;
        }

        $this->saca($valorATransferir);
        $contaDestino->deposita($valorATransferir);
    }

    public function recuperaSaldo(): float
    {
        return $this->saldo;
    }

    public function recuperaNomeTitular(): string
    {
        return $this->titular->recuperaNome();
    }

    public function recuperaCpfTitular(): string
    {
        return $this->titular->recuperaCpf();
    }

    public static function recuperaNumeroDeContas(): int
    {
        return self::$numeroDeContas;
    }
}
