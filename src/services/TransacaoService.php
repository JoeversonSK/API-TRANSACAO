<?php

class TransacaoService {
    private $transacaoModel;
    
    public function __construct() {
        $this->transacaoModel = new Transacao();
    }
    
    public function criarTransacao($dados) {

        $erros = TransacaoValidator::validarDados($dados);
        if (!empty($erros)) {
            throw new InvalidArgumentException(implode(', ', $erros));
        }
        
        if ($this->transacaoModel->verificarIdExiste($dados['id'])) {
            throw new InvalidArgumentException('ID já existe');
        }
        
        $dataHoraBanco = TransacaoValidator::formatarDataHoraBanco($dados['dataHora']);
        if ($dataHoraBanco === null) {
            throw new InvalidArgumentException('Formato de dataHora inválido');
        }
        
        $sucesso = $this->transacaoModel->criar(
            $dados['id'],
            $dados['valor'],
            $dataHoraBanco
        );
        
        if (!$sucesso) {
            throw new RuntimeException('Erro ao criar transação');
        }
        
        return true;
    }
    

}