<?php 

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TaskModel;

class TaskApiController extends ResourceController {
protected $format = 'json';

//Lista todas as tarefas
public function index(){
    $model = new TaskModel();
    $tasks = $model->findAll();

    return $this->respond($tasks);
}

//Busca uma tarefa específica pelo ID
public function show($id = null) {
    $model = new TaskModel();
    $task = $model->find($id);

    if($task){
    return $this->respond($task);
}
return $this->failNotFound('Nenhuma tarefa encontrada com o ID: ' . $id);
}

//Cria uma nova tarefa 
public function create(){
    $data = $this->request->getJson(true);
    $model = new TaskModel();

    if($model->save($data)){
        return $this->respondCreated([
            'satus' => 201,
            'mensage' => 'Tarefa criada com sucesso',
            'data' => $data
        ]);
    }

    return $this->failedValidationErrors($model->errors());
}

//Atualizar uma tarefa existente
public function update($id = null){
    $model = new TaskModel();

   if (!$model->find($id)) { 
    return $this->failNotFound('Nenhuma tarefa encontrada com o ID: ' . $id);
}

    $data = $this->request->getJson(true);

    if($model->update($id, $data)){
        return $this->respond([
            'status' => 200,
            'message' => 'Tarefa atualizada com sucesso',
            'data' => $data
        ]);
    }

    return $this->failedValidationErrors($model->errors());
}

//Exclui uma tarefa existente
public function delete($id = null){
    $model = new TaskModel();

    if(!$model->find($id)) {
        return $this->failNotFound('Nenhuma tarefa encontrada com o ID: ' . $id);
    }

    if($model->delete($id)){
        return $this->respondDeleted([
            'status' => 200,
            'message' => 'Tarefa excluída com sucesso'
        ]);
    }

    return $this->failServerError('Erro ao excluir a tarefa com o ID: ' . $id);
}
}