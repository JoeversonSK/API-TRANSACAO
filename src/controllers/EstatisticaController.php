<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class EstatisticaController {
    private $estatisticaService;
    
    public function __construct() {
        $this->estatisticaService = new EstatisticaService();
    }
    
    public function calcular(Request $request, Response $response) {
        try {
            $estatisticas = $this->estatisticaService->calcularEstatisticas();
            
            $response->getBody()->write(json_encode($estatisticas));
            return $response->withStatus(200);
            
        } catch (Exception $e) {
            error_log("Erro ao calcular estatísticas: " . $e->getMessage());
            return $response->withStatus(500);
        }
    }
}