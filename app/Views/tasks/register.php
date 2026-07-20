<?php $this->extend('layouts/default'); ?>
<?php $this->section('content'); ?>

<div class="container mt-4 w-50">
    <h1 class="text-center display-5">Cadastrar Tarefa</h1>
    <hr>
        <div class="form-group mb-3">
            <label for="">Título</label>
            <input type="text" name="title" class="form-control border-secondary">
        </div>

        <div class="form-group mb-3">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control border-secondary">
        </div>

        <div class="form-group mb-3">
            <label>Status</label>
            <select name="status" class="form-control border-secondary">
                <option value="pendente">Pendente</option>
                <option value="em_andamento">Em Andamento</option>
                <option value="concluida">Concluída</option>
            </select>
        </div>


       
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-50">Registrar</button>
        </div>
    </form>

    <?php if(isset($validation)): ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>
</div>

<?php $this->endSection(); ?>