<?php $this->extend('layouts/default') ?>
<?php $this->section('content') ?>

<div class="container">

        <?php if(session()->getFlashdata('status')):?>
         <div class="alert alert-success mt-3" role="alert">
            <?= session()->getFlashdata('status') ?>
        <?php endif; ?>
    </div>
</div>

<div class="container mt-5">
    <h1 class="display mb-3 text-center">Listagem de Tarefas</h1>
    <table class="table table-sm table-hover ">
        <thead> 
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
           <?php foreach($tasks as $task): ?>
    <tr>
        <td><?= esc($task['id']) ?></td>
        <td><?= esc($task['title']) ?></td>
        <td><?= esc($task['description']) ?></td>
        <td><?= date('d/m/Y H:i', strtotime($task['created_at'])) ?></td>
        <td><?= ucfirst(str_replace('_', ' ', esc($task['status']))) ?></td>
        <td>
            <a href="" class="btn btn-sm btn-secondary">Editar</a>
            <a href="" class="btn btn-sm btn-danger">Deletar</a>
        </td>
    </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?> 

