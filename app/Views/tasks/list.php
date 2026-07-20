<?php $this->extend('layouts/default') ?>
<?php $this->section('content') ?>

<div class="container">

        <?php if(session()->getFlashdata('status')):?>
         <div class="alert alert-success mt-3" role="alert">
            <?= session()->getFlashdata('status') ?>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?> 

