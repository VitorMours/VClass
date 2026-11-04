<?php
    function active(string $rota) : bool {
        return $rota == parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
?>

<nav class="bg-body-secondary">
    <ul class="nav flex-column">
        <li class="nav-item px-3 py-2 sidebar-link <?= active('/dashboard') ? 'active-tab' : '' ?>"><a href="/dashboard" class="nav-link">Dashboard</a></li>
        <li class="nav-item px-3 py-2 sidebar-link <?= active('/alunos') ? 'active-tab' : '' ?>"><a href="/alunos" class="nav-link">Alunos</a></li>
        <li class="nav-item px-3 py-2 sidebar-link <?= active('/relatorios') ? 'active-tab' : '' ?>"><a href="/relatorios" class="nav-link">Relatório</a></li>
    </ul>
</nav>