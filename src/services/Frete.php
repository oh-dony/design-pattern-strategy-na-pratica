<?php

include_once "correios/Correios.php";
include_once "mercado-livre/MercadoLivre.php";

// Strategy
interface FreteServico
{
    function calcula(float $peso): float;
}

// Concrete Strategy
class Sedex implements FreteServico
{
    function calcula(float $peso): float
    {
        $correios = new \Correios();
        $valorTotal = $correios->calculaRemessa("SEDEX", $peso);
        return $valorTotal;
    }
}

class Pac implements FreteServico
{
    function calcula(float $peso): float
    {
        $correios = new \Correios();
        $valorTotal = $correios->calculaRemessa("PAC", $peso);
        return $valorTotal;
    }
}

class MercadoEnvio implements FreteServico
{
    function calcula(float $peso): float
    {
        $mercadoenvio = new \MercadoLivre();
        $valorTotal = $mercadoenvio->calcula($peso);
        return $valorTotal;
    }
}

// Context
class Frete
{
    private $servico;

    function __construct(FreteServico $servico)
    {
        $this->servico = $servico;
    }

    function calcula(int $peso)
    {
        $valorTotal = $this->servico->calcula($peso);

        return $valorTotal;
    }
}
