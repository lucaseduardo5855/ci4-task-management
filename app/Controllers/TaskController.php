<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TaskModel;

class TaskController extends BaseController
{
    public function register() {
        return view('tasks/register');
    }

    public function doRegister(){
        // Validar os dados do formulário
        $rules = [
                'title' => [
                    'rules' => 'required|min_length[3]|max_length[255]',
                    'label' => 'Título',        
                ],
                'description' => [
                    'rules' => 'required|min_length[3]|max_length[255]',
                    'label' => 'Descrição',
                ],
                'status' => [
                    'rules' => 'required|in_list[pendente,em_andamento,concluida]',
                    'label' => 'Status',
                ]
        ];

        if(! $this->validate($rules)){
            return view('tasks/register', [
                'validation' => 
                $this->validator
            ]);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status' => 
            $this->request->getPost('status')
        ];

        $model = new TaskModel();

        $model->save($data);

        return redirect()->to('/list')->with('status', 'Tarefa cadastrada com sucesso!');
    }

    public function list(): string{
     return view( 'tasks/list');
    }

}
