<?php
class Pessoa {
    var string $email;
    var string $nome;
    var string $senha;
    var string $dataNasci;
    var string $sobre;

    function __construct(string $email,string $nome,string $senha,string $dataNasci,string $sobre) {
        $this->setEmail($email);
        $this->setNome($nome);
        $this->setSenha($senha);
        $this->setDataNasci($dataNasci);
        $this->setSobre($sobre);
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setNome(string $nome) {
        $this->nome = $nome;
    }

    public function setSenha(string $senha) {
        $this->senha = $senha;
    }

    public function setDataNasci(string $dataNasci) {
        $this->dataNasci = $dataNasci;
    }

    public function setSobre(string $sobre) {
        $this->sobre = $sobre;
    }
}
?>
