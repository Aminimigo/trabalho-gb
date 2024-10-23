<?php
class Pessoa {
    var int $codigo;
    var string $nome;
    var string $nascimento;
    var int $idade;

    function __construct(int $codigo, string $nome, string $nascimento) {
        $this->codigo = $codigo;
        $this->setNome($nome);
        $this->setNascimento($nascimento);
    }

    function setNome(string $nome) {
        $this->nome = $nome;
    }

    function setNascimento(string $nascimento) {
        $this->nascimento = $nascimento;
        $anoAtual = date("Y");
        $this->idade = $anoAtual - date('Y', strtotime($nascimento));
    }
}
?>
