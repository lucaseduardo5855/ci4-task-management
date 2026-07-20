<?php $this->extend('layouts/default') ?>
<?php $this->section('content') ?>

<div class="container">
    <?php if(session()->getFlashdata('status')): ?>
       <div class="alert alert-success mt-3" id="flash-alert" role="alert">
            <?= session()->getFlashdata('status') ?>
        </div> 
    <?php endif; ?>
</div>

<div class="container mt-5">
    <h1 class="display-5 mb-3 text-center">Listagem de Tarefas</h1>
    <a href="<?= site_url('create') ?>" class="btn btn-success float-end mb-3">Nova Tarefa</a>
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
                    <?php if ($task['status'] === 'concluida'): ?>
                        <span class="badge bg-success">Concluída</span>
                    <?php elseif ($task['status'] === 'em_andamento'): ?>
                        <span class="badge bg-primary">Em andamento</span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark">Pendente</span>
                    <?php endif; ?>
                </td>
<td>
                    <a href="<?= site_url('edit/' . $task['id']) ?>" class="btn btn-sm btn-secondary">Editar</a>
                    <a href="<?= site_url('delete/' . $task['id']) ?>" class="btn btn-sm btn-danger">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

<script>
    // Ocultar o alerta após 3 segundos
    setTimeout(function() {
        var alertElement = document.getElementById('flash-alert');
        if (alertElement) {
            alertElement.style.display = 'none';
        }
    }, 3000);
</script>
<?= $this->endSection() ?>
