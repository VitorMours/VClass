<?php ob_start(); ?>

<h1>Usuários</h1>

<a href="/users/create">Novo usuário</a>


<?php $content = ob_get_clean(); ?>

<?php require base_path('resources/views/layouts/main.php'); ?>