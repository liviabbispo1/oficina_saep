
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Veículos</title>
</head>

<body>

    <h1>Lista de Veículos</h1>

    <form method="POST" action="<?= base_url('veiculos') ?>">
        <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">

        <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
    </form>

    <br>

    <table border="1">

        <tr>
            <th>Placa</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th>Responsável</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>

        <?php foreach ($veiculos as $vei): ?>

            <tr>

                <td><?= $vei['VEI_PLACA'] ?></td>

                <td> <?= $vei['VEI_MARCA'] ?></td>

                <td> <?= $vei['VEI_MODELO'] ?></td>

                <td> <?= $vei['VEI_ANO'] ?></td>



                  <td> <?= $vei['CLI_NOME'] ?> </td>

                <td><a href="<?= base_url('veiculos/editar/' .$vei['VEI_ID']) ?>">Editar</a></td>

                <td><a href="<?= base_url('veiculos/excluir/' .$vei['VEI_ID']) ?>">Excluir</a></td>

            </tr>

        <?php endforeach; ?>

    </table>

    <br>

    <a href="<?= base_url('veiculos/novo') ?>">
        <button>Cadastrar veiculo</button>
    </a>

    <br><br>

    <a href="<?= base_url('inicio') ?>">
        <button>Voltar</button>
    </a>

</body>

</html>

