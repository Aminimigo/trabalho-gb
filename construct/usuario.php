class Usuario {
    private $codigo;
    private $nome;
    private $servico;

    public function __construct(int $codigo, string $nome, string $servico) {
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->servico = $servico;
    }

    public function mostrarServico(): string {
        return "O serviço oferecido é: " . $this->servico;
    }
}
