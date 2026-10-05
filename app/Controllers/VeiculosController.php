<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ClientesModel;
use App\Models\VeiculosModel;

// Vincula o veiculos com seu respectivo cliente (FK_RES_ID)
class VeiculosController extends BaseController
{
    // Exibe a listagem de Veiculoss
    public function index()
    {
        // Instancia o Model de Veiculos
        $model = new VeiculosModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado pelo usuário
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os veículos juntamente com o nome do cliente
            // responsável por cada veiculos
            $dados['veiculos'] = $model
                ->select('VEICULOS.*, CLIENTES.CLI_NOME')

                // Relaciona VEICULOS com CLIENTES pela chave estrangeira
                ->join(
                    'CLIENTES',
                    'CLIENTES.CLI_ID = VEICULOS.FK_CLI_ID'
                )

                // Agrupa as condições da pesquisa
                ->groupStart()

                    // Pesquisa pela placa
                    ->like('VEI_PLACA', $pesquisar)

                    // Pesquisa pela marca
                    ->orLike('VEI_MARCA', $pesquisar)

                    // Também permite pesquisar pelo nome do proprietário
                    ->orLike('CLIENTES.CLI_NOME', $pesquisar)

                ->groupEnd()

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso não exista pesquisa, busca todos os veículos
            // juntamente com o nome dos CLIpectivos clientes
            $dados['veiculos'] = $model
                ->select('VEICULOS.*, CLIENTES.CLI_NOME')
                ->join(
                    'CLIENTES',
                    'CLIENTES.CLI_ID = VEICULOS.FK_CLI_ID'
                )
                ->findAll();
        }

        // Carrega a View de VEICULOS
        return view('sistema/veiculos/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo veiculos
    public function novo()
    {
        // Instancia o Model de responsaveis
        $clientesModel = new ClientesModel();

        // Busca todos os responsaveis cadastrados
        // Esses dados serão utilizados em um campo SELECT
        $dados['clientes'] = $clientesModel->findAll();

        // Carrega o formulário de cadastro do veiculos
        return view('sistema/veiculos/novo_veiculo', $dados);
    }


    // Insere um novo VEICULOS
    public function inserir()
    {
        // Instancia o Model de VEICULOS
        $model = new VeiculosModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'VEI_PLACA' => $this->request->getPost('placa'),
            'VEI_MARCA' => $this->request->getPost('marca'),
            'VEI_MODELO' => $this->request->getPost('modelo'),
            'VEI_ANO' => $this->request->getPost('ano'),

            // Guarda o ID do clientes escolhido no formulário
            // como chave estrangeira do veiculos
            'FK_CLI_ID' => $this->request->getPost('clientes')
        ];

        // Insere o veiculos no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('veiculos'))
            ->with('success', 'Veículo cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia o Model de Veiculos
        $veiculosModel = new VeiculosModel();

        // Instancia o Model de responsáveis
        $clientesModel = new ClientesModel();

        // Busca o veículo que será editado
        $dados['veiculos'] = $veiculosModel->find($id);

        // Busca todos os clientes para preencher o SELECT
        $dados['clientes'] = $clientesModel->findAll();

        // Carrega a View de edição
        return view('sistema/veiculos/editar_veiculo', $dados);
    }


    // Atualiza um Veículo
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new VeiculosModel();

        // Recupera os novos dados do formulário
        $dados = [
             'VEI_PLACA' => $this->request->getPost('placa'),
            'VEI_MARCA' => $this->request->getPost('marca'),
            'VEI_MODELO' => $this->request->getPost('modelo'),
            'VEI_ANO' => $this->request->getPost('ano'),

            // Guarda o ID do clientes escolhido no formulário
            // como chave estrangeira do veiculos
            'FK_CLI_ID' => $this->request->getPost('clientes')
        ];


        // Atualiza o veiculos pelo ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('veiculos'))
            ->with('success', 'Veículo atualizado com sucesso!');
    }


    // Exclui um Veículo
    public function excluir($id)
    {
        // Instancia o Model
        $model = new VeiculosModel();

        // Exclui o veículo pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('veiculos'))
            ->with('success', 'Veículo excluído com sucesso!');
    }
}