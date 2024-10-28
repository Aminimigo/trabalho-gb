<?php
class Pessoa {
    var string $email;
    var string $nome;
    var string $senha;
    var string $dataNasci;

    function __construct(string $email,string $nome,string $senha,string $dataNasci) {
        $this->setEmail($email);
        $this->setNome($nome);
        $this->setSenha($senha);
        $this->setDataNasci($dataNasci);
    
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
}
?>
