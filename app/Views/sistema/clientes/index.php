
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
</head>

<body>

    <h1>Lista de Clientes</h1>

    <form method="POST" action="<?= base_url('clientes') ?>">
        <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">

        <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
    </form>

    <br>

    <table border="1">

        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>

        <?php foreach ($clientes as $cli): ?>

            <tr>

                <td>
                    <?= $cli['CLI_NOME'] ?>
                </td>

                <td>
                    <?= $cli['CLI_CPF'] ?>
                </td>

                <td>
                    <?= $cli['CLI_TELEFONE'] ?>
                </td>


                <td>
                    <a href="<?= base_url('clientes/editar/' .$cli['CLI_ID']) ?>">
                        Editar
                    </a>
                </td>

                <td>
                    <a href="<?= base_url('clientes/excluir/' .$cli['CLI_ID']) ?>">
                        Excluir
                    </a>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>

    <br>

    <a href="<?= base_url('clientes/novo') ?>">
        <button>Cadastrar Clientes</button>
    </a>

    <br><br>

    <a href="<?= base_url('inicio') ?>">
        <button>Voltar</button>
    </a>

</body>

</html>

