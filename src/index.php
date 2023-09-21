<?php

include_once "services/Frete.php";

function retorno($servico)
{
    if (!$servico) return;

    $frete = new Frete($servico);
    $valor = $frete->calcula(10);

    return $valor;
}

function setServico($servico)
{
    $sedex = new Sedex;
    $pac = new PAC;
    $mercadoLivre = new MercadoEnvio;

    if ($servico == "SEDEX") {
        return $servico = $sedex;
    } else if ($servico == "PAC") {
        return $servico = $pac;
    } else if ($servico == "MercadoEnvio") {
        return $servico = $mercadoLivre;
    }
}


$servicoEscolhido = $_POST['servico'];

$servico = setServico($servicoEscolhido);
$valorTotal = retorno($servico);
?>


<html>

<head>
    <title>Calcula Frete</title>
</head>

<body>
    <form action="index.php" method="post">
        <label for="servico">Escolha o serviço de envio</label>
        <select name="servico">
            <option value="SEDEX">SEDEX</option>
            <option value="PAC">PAC</option>
            <option value="MercadoEnvio">Mercado Livre</option>
        </select>

        <button type="submit">Calcular</button>
    </form>

    <div>
        <?php

        if ($valorTotal &&  $servicoEscolhido) {
            echo 'Serviço:' . $servicoEscolhido . '<br>';
            echo 'Valor: ' . $valorTotal;
        }

        ?>
    </div>
</body>

</html>