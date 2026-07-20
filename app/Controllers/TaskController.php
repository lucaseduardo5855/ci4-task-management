<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TaskModel;

class TaskController extends BaseController
{
    public function index(): string 
    {
        $model = new TaskModel();
        $data['tasks'] = $model->findAll();
        return view('tasks/index', $data);
    }

    public function create() 
    {
        return view('tasks/create');
    }

    public function store()
    {
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

        if (!$this->validate($rules)) {
            return view('tasks/create', [
                'validation' => $this->validator
            ]);
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status')
        ];

        $model = new TaskModel();
        $model->save($data);

        return redirect()->to('/')->with('status', 'Tarefa cadastrada com sucesso!');
    }

    public function edit($id) 
    {
        $model = new TaskModel();
        $task = $model->find($id); 

        if (!$task) {
            return redirect()->to('/')->with('status', 'Tarefa não encontrada!');
        }

        $data['task'] = $task;
        return view('tasks/edit', $data);
    }

    public function update($id)
    {
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

        if (!$this->validate($rules)) {
            return view('tasks/edit', [
                'validation' => $this->validator,
                'task'       => array_merge(['id' => $id], $this->request->getPost())
            ]);
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status')
        ];

        $model = new TaskModel();
        $model->update($id, $data);

        return redirect()->to('/')->with('status', 'Tarefa atualizada com sucesso!');
    }

    public function delete($id) 
    {
        $model = new TaskModel();
        $model->delete($id);
        return redirect()->to('/')->with('status', 'Tarefa deletada com sucesso!');
    }
}