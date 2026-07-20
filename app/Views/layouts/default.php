<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2B3035">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('/') ?>">Gerenciador de Tarefas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="<?= site_url('/') ?>">Listagem</a>
                <a class="nav-link" href="<?= site_url('create') ?>">Nova Tarefa</a>
            </div>
        </div>
    </div>
</nav>
    
<?= $this->renderSection('content')?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-kK98qOMZ90P210sV7jW6e4d5d5d5d5d5d5d5d5d5d5d5d5d5d5d5d5d5d5d5d5d5d5" crossorigin="anonymous"></script>
</body>
</html>