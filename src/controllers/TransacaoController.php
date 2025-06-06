<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TransacaoController {
    private $transacaoService;
    
    public function __construct() {
        $this->transacaoService = new TransacaoService();
    }
    
    public function criar(Request $request, Response $response) {
        try {

            $dados = $request->getParsedBody();

            if (empty($dados)) {
                return $response->withStatus(400);
            }

            $this->transacaoService->criarTransacao($dados);

            return $response->withStatus(201);
            
        } catch (InvalidArgumentException $e) {

            return $response->withStatus(422);
            
        } catch (Exception $e) {

            error_log("Erro ao criar transação: " . $e->getMessage());
            return $response->withStatus(400);
        }
    }
   
}