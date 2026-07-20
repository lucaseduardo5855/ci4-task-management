<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class TaskApiController extends ResourceController
{
    protected $format = 'json';

    /**
     * Lista todas as tarefas cadastradas.
     *
     * @return ResponseInterface Resposta JSON contendo a lista de tarefas.
     */
    public function index(): ResponseInterface
    {
        $model = new TaskModel();
        $tasks = $model->findAll();

        return $this->respond($tasks);
    }

    /**
     * Busca uma tarefa específica pelo ID informado.
     * 
     * @param int|null $id Identificador da tarefa a ser buscada.
     * @return ResponseInterface Resposta JSON com os dados da tarefa ou erro 404.
     */
    public function show($id = null): ResponseInterface
    {
        $model = new TaskModel();
        $task = $model->find($id);

        if ($task) {
            return $this->respond($task);
        }

        return $this->failNotFound('Nenhuma tarefa encontrada com o ID: ' . $id);
    }

    /**
     * Cria uma nova tarefa com os dados recebidos no corpo da requisição.
     *
     * @return ResponseInterface Resposta JSON confirmando a criação da tarefa ou retornando erros de validação.
     */
    public function create(): ResponseInterface
    {
        $data = $this->request->getJSON(true) ?? [];
        $model = new TaskModel();

        if (!$this->validateTaskData($data)) {
            return $this->failedValidationErrors($this->validator->getErrors());
        }

        if ($model->save($data)) {
            return $this->respondCreated([
                'status' => 201,
                'message' => 'Tarefa criada com sucesso',
                'data' => $data,
            ]);
        }

        return $this->failedValidationErrors($model->errors());
    }

    /**
     * Atualiza uma tarefa existente com base no ID informado.
     *
     * @param int|null $id Identificador da tarefa a ser atualizada.
     * @return ResponseInterface Resposta JSON confirmando a atualização ou retornando erro 404/validação.
     */
    public function update($id = null): ResponseInterface
    {
        $model = new TaskModel();

        if (!$model->find($id)) {
            return $this->failNotFound('Nenhuma tarefa encontrada com o ID: ' . $id);
        }

        $data = $this->request->getJSON(true) ?? [];

        if (!$this->validateTaskData($data)) {
            return $this->failedValidationErrors($this->validator->getErrors());
        }

        if ($model->update($id, $data)) {
            return $this->respond([
                'status' => 200,
                'message' => 'Tarefa atualizada com sucesso',
                'data' => $data,
            ]);
        }

        return $this->failedValidationErrors($model->errors());
    }

    /**
     * Exclui uma tarefa existente pelo ID informado.
     *
     * @param int|null $id Identificador da tarefa a ser excluída.
     * @return ResponseInterface Resposta JSON confirmando a exclusão ou erro 404.
     */
    public function delete($id = null): ResponseInterface
    {
        $model = new TaskModel();

        if (!$model->find($id)) {
            return $this->failNotFound('Nenhuma tarefa encontrada com o ID: ' . $id);
        }

        if ($model->delete($id)) {
            return $this->respondDeleted([
                'status' => 200,
                'message' => 'Tarefa excluída com sucesso',
            ]);
        }

        return $this->failServerError('Erro ao excluir a tarefa com o ID: ' . $id);
    }

    /**
     * Valida os dados recebidos para o cadastro ou atualização de uma tarefa.
     *
     * @param array $data Dados enviados na requisição.
     * @return bool Retorna true quando os dados são válidos.
     */
    protected function validateTaskData(array $data = []): bool
    {
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[3]|max_length[255]',
            'status' => 'required|in_list[pendente,em_andamento,concluida]',
        ];

        return $this->validate($rules, $data);
    }
}