<body class="d-flex flex-column min-vh-100">
    <?php
        require_once dirname(__DIR__, 3) . '/resources/views/partials/header.php';
    ?>
  
    <div class="d-flex flex-row flex-grow-1">
        <nav class="bg-body-secondary">
            <ul class="nav flex-column">
                <li class="nav-item px-3 py-2 sidebar-link"><a href="#" class="nav-link">Dashboard</a></li>
                <li class="nav-item px-3 py-2 sidebar-link"><a href="#" class="nav-link">Cursos</a></li>
                <li class="nav-item px-3 py-2 sidebar-link"><a href="#" class="nav-link">Configurações</a></li>
            </ul>
        </nav>

        <main class="flex-grow-1 p-4">
            <h1>Conteúdo da Página</h1>
            <p>Aqui vai o conteúdo dinâmico da sua view...</p>
        </main>
    </div>

</body>