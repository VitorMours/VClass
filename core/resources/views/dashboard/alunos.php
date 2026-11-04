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
            <h1 class="h3 mb-0 text-dark fw-bold">Alunos Ativamente Matriculados</h1>
            <button class="btn btn-primary d-flex align-items-center  gap-2 px-3 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#createStudentModal">
                <span class="material-icons">add</span>
                <span>Cadastrar Aluno</span>
            </button>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">Matricula</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Email</th>
                  <th scope="col">Status</th>
                  <th scope="col"> </th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </main>
    </div>

    <!-- Modal para cadastro de alunos -->
    <div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
    </div>
</body>