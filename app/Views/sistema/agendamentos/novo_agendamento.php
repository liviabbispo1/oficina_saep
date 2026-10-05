

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Agendamento</title>
    </head>
    <body>
        <h1>Novo Agendamento</h1>

        <form action="<?= base_url('agendamentos/inserir') ?>" method="POST">
            <label>Data e Hora:</label><br>
            <input type="datetime-local" id="data_hora" name="data_hora" required>
            <br><br>

            <label>Serviço:</label><br>
            <input type="text" id="servico" name="servico" placeholder="Serviço..." required>
            <br><br>

            <label>Status:</label><br>
            <input type="text" id="status" name="status" placeholder="Status..." required>
            <br><br>

            <label>Cliente:</label><br>
            <select id="clientes" name="clientes" required>
                <option value="">Selecione um responsável</option>
                <?php foreach($clientes  as $cli): ?>
                    <option value="<?= $cli['CLI_ID'] ?>">
                        <?= $cli['CLI_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>Veículo:</label><br>
            <select id="veiculos" name="veiculos" required>
                <option value="">Selecione um veiculo</option>
                <?php foreach($veiculos as $vei): ?>
                    <option value="<?= $vei['VEI_ID'] ?>">
                        <?= $vei['VEI_PLACA'] ?> 
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="cadastrar_agendamento" name="cadastrar_agendamento" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('agendamentos') ?>"><button>Voltar</button></a>
    </body>
</html>
