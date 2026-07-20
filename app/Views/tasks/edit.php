<?php $this->extend('layouts/default'); ?>
<?php $this->section('content'); ?>

<div class="container mt-4 w-50">
    <h1 class="text-center display-5">Editar Tarefa</h1>
    <hr>
   <form action="<?= site_url('update/' . ($task['id'] ?? '')) ?>" method="post">
        <div class="form-group mb-3">
            <label for="">Título</label>
            <input type="text" name="title" class="form-control border-secondary" value="<?= esc($task['title']) ?>">
        </div>

        <div class="form-group mb-3">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control border-secondary" value="<?= esc($task['description']) ?? '' ?>">
        </div>

        <div class="form-group mb-3">
            <label>Status</label>
            <select name="status" class="form-control border-secondary">
                <option value="pendente" <?= $task['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                <option value="em_andamento" <?= $task['status'] === 'em_andamento' ? 'selected' : '' ?>>Em Andamento</option>
                <option value="concluida" <?= $task['status'] === 'concluida' ? 'selected' : '' ?>>Concluída</option>
            </select>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-50">Salvar Alterações</button>
        </div>
    </form>

    <?php if(isset($validation)): ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>
</div>

<?php $this->endSection(); ?>
