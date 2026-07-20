<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TaskController extends BaseController
{
    public function register() {
        return view('tasks/register');
    }

    public function doRegister(){
        // Validar os dados do formulário
        $rules = [
                'título' => [
                    'rules' => 'required|min_length[3]|max_length[255]',
                    'label' => 'title',
                ],
                'description' => [
                    'rules' => 'required|min_length[3]|max_length[255]',
                    'label' => 'description',
                ],
                'status' => [
                    'rules' => 'required|in_list[pendente,em_andamento,concluida]',
                    'label' => 'Status',
                ]
        ];
    }

    public function list(): string{
     return view( 'tasks/list');
    }
}

                    'label' => 'Nome',
                ]
        ];
    }

    public function list(): string{
     return view( 'tasks/list');
    }
}
