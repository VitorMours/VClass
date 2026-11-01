<body class="d-flex flex-column min-vh-100 bg-body-primary">
    <?php
    require_once dirname(__DIR__, 3) . '/resources/views/partials/header.php';
    ?>
    <div class="d-flex flex-row flex-grow-1">
        <?php
        require_once dirname(__DIR__, 3) . '/resources/views/partials/nav.php';
        ?>

        <main class="flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-dark fw-bold">Bem-vindo, professor!</h1>
                <button class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2 shadow-sm">
                    <span class="material-icons fs-5">qr_code</span>
                    <span>Gerar QR Code</span>
                </button>
            </div>

            <!-- Seção de Cards (Linha 1) com Grid e Espaçamento -->
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm bg-body-tertiary h-100">
                        <div class="card-body">
                            <h5 class="card-title text-muted fs-6 mb-2">Alunos Matriculados</h5>
                            <p class="card-text fs-4 fw-bold text-dark mb-0">28</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm bg-body-tertiary h-100">
                        <div class="card-body">
                            <h5 class="card-title text-muted fs-6 mb-2">Presenças Hoje</h5>
                            <p class="card-text fs-4 fw-bold text-success mb-0">14</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm bg-body-tertiary h-100">
                        <div class="card-body">
                            <h5 class="card-title text-muted fs-6 mb-2">Aulas no Mês</h5>
                            <p class="card-text fs-4 fw-bold text-primary mb-0">12</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção de Cards (Linha 2) -->
            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm bg-body-tertiary h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Últimas Chamadas</h5>
                            <p class="text-muted mb-0">Nenhuma chamada registrada recentemente.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm bg-body-tertiary h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Próximas Turmas</h5>
                            <p class="text-muted mb-0">Nenhuma aula agendada para hoje.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>