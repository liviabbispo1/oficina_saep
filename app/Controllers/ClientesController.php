<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ClientesModel;

class ClientesController extends BaseController
{
    // Exibe a listagem de Clientes
    public function index()
    {
        // Instancia o Model Cliente pela tabela Clientes
        $model = new ClientesModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado no campo de pesquisa
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca Clientes que possuem o termo informado
            // no nome OU DATA NASCIMENTO
            $dados['clientes'] = $model
                ->like('CLI_NOME', $pesquisar)
                ->orLike('CLI_CPF', $pesquisar)
                ->orLike('CLI_TELEFONE', $pesquisar)

                
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os clientes cadastrados
            $dados['clientes'] = $model->findAll();
        }

        // Carrega a View de listagem e envia os clientes encontrados
        return view('sistema/clientes/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo clientes
    public function novo()
    {
        // Apenas carrega a View com o formulário
        return view('sistema/clientes/novo_cliente');
    }


    // Insere um novo clientes no banco de dados
    public function inserir()
    {
        // Instancia o Model
        $model = new ClientesModel();

        // Recupera os valoCLI enviados pelo formulário
        $dados = [
            'CLI_NOME' => $this->request->getPost('nome'),
            'CLI_CPF' => $this->request->getPost('cpf'),
            'CLI_TELEFONE' => $this->request->getPost('telefone'),

        ];

        // Insere o novo Clientes no banco
        $model->insert($dados);

        // Redireciona para a listagem de Clientes
        return redirect()
            ->to(base_url('clientes'))
            ->with('success', 'Cliente cadastrado com sucesso!');
    }


    // Exibe o formulário para editar um clientes
    public function editar($id)
    {
        // Instancia o Model
        $model = new ClientesModel();

        // Busca o clientes pelo ID recebido na URL
        $dados['clientes'] = $model->find($id);

        // Carrega a View de edição enviando os dados do clientes
        return view('sistema/clientes/editar_cliente', $dados);
    }


    // Atualiza os dados de um Clientes
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new ClientesModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'CLI_NOME' => $this->request->getPost('nome'),
            'CLI_CPF' => $this->request->getPost('cpf'),
            'CLI_TELEFONE' => $this->request->getPost('telefone'),
            
        ];

        // Atualiza o registro correspondente ao ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('clientes'))
            ->with('success', 'Cliente atualizado com sucesso!');
    }


    // Exclui um clientes
    public function excluir($id)
    {
        // Instancia o Model
        $model = new ClientesModel();

        // Exclui o registro correspondente ao ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('clientes'))
            ->with('success', 'Cliente excluído com sucesso!');
    }
}