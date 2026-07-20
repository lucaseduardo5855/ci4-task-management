<?php $this->extend('layouts/default') ?>
<?php $this->section('content') ?>

<div class="container">
    <?php if(session()->getFlashdata('status')): ?>
        <div class="alert alert-success mt-3" role="alert">
            <?= session()->getFlashdata('status') ?>
        </div> 
    <?php endif; ?>
</div>

<div class="container mt-5">
    <h1 class="display mb-3 text-center">Listagem de Tarefas</h1>
    <table class="table table-sm table-hover mt-4">
        <thead> 
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $i = 1; 
        foreach($tasks as $task): 
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= esc($task['title']) ?></td>
                <td><?= esc($task['description']) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($task['created_at'])) ?></td>
                <td>
                    <?php if ($task['status'] === 'concluída'): ?>
                        <span class="badge bg-success">Concluída</span>
                    <?php elseif ($task['status'] === 'em_andamento'): ?>
                        <span class="badge bg-primary">Em andamento</span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark">Pendente</span>
                    <?php endif; ?>
                </td>
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