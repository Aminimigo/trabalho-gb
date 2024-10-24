<?php
class Cadastro {
    private $email;
    private $nome;
    private $senha;
    private $dataNasci;
    private $sobre;

    public function __construct(string $email, string $nome, string $senha, string $dataNasci, string $sobre) {
        $this->email = $email;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->dataNasci = $dataNasci;
        $this->sobre = $sobre;
    }

    public function mostrarServico(): string {
        return "A pessoa cadastrada é: " . $this->sobre;
    }
}
