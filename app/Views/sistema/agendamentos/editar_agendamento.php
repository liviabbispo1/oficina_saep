
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Agendamento</title>
    </head>
    <body>
        <h1>Editar Agendamento</h1>

        <form action="<?= base_url('agendamentos/atualizar/'.$agendamentos['AGE_ID']) ?>" method="POST">
            <label>Data e Hora:</label><br>
            <input type="datetime-local" id="data_hora" name="data_hora" value="<?= date('Y-m-d\TH:i', strtotime($agendamentos['AGE_DATA_HORA'])) ?>" required>
            <br><br>

            <label>Serviço:</label><br>
            <input type="text" id="servico" name="servico" value="<?= $agendamentos['AGE_SERVICO'] ?>" required>
            <br><br>

            <label>Status:</label><br>
            <input type="text" id="status" name="status" value="<?= $agendamentos['AGE_STATUS'] ?>" required>
            <br><br>

            <label>Cliente:</label><br>
            <select id="clientes" name="clientes" required>
                <?php foreach($clientes as $cli): ?>
                    <option value="<?= $cli['CLI_ID'] ?>"
                        <?= $cli['CLI_ID'] == $agendamentos['FK_CLI_ID'] ? 'selected' : '' ?>>
                        <?= $cli['CLI_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>Veículo:</label><br>
            <select id="veiculos" name="veiculos" required>
                <?php foreach($veiculos as $vei): ?>
                    <option value="<?= $vei['VEI_ID'] ?>"
                        <?= $vei['VEI_ID'] == $agendamentos['FK_VEI_ID'] ? 'selected' : '' ?>>
                        <?= $vei['VEI_PLACA'] ?> 
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="editar_agendamento" name="editar_agendamento" value="Salvar Alterações">
        </form>
        <br>
        <a href="<?= base_url('agendamentos') ?>"><button>Voltar</button></a>
    </body>
</html>