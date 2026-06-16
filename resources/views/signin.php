<body class="d-flex flex-column min-vh-100">

  <?php
  require_once dirname(__DIR__, 2) . '/resources/views/partials/header.php';
  ?>

  <main class="flex-grow-1 d-flex align-items-center justify-content-center">
    <section class="container">
      <div class="row justify-content-center">
        <div class="col-11 col-sm-8 col-md-6 col-lg-4">

          <form method="POST" class="p-4 border rounded bg-white shadow-sm">
            <h2 class="text-center mb-4">Sign in</h2>
            <div class="d-flex">
              <div class="mb-3">
                <label for="nameSigninInput" class="form-label">
                  Primeiro Nome
                </label>
                <input
                  type="text"
                  class="form-control"
                  id="nameSigninInput"
                  name="name"
                  required>
              </div>
              <div class="mb-3">
                <label for="surnameSigninInput" class="form-label">
                  Sobrenome
                </label>
                <input
                  type="text"
                  class="form-control"
                  id="surnameSigninInput"
                  name="surname"
                  required>
              </div>
            </div>

            <div class="mb-3">
              <label for="emailLoginInput" class="form-label">
                Email
              </label>
              <input
                type="email"
                class="form-control"
                id="emailLoginInput"
                name="email"
                required>
            </div>

            <div class="mb-3">
              <label for="passwordLoginInput" class="form-label">
                Senha
              </label>
              <input
                type="password"
                class="form-control"
                id="passwordLoginInput"
                name="password"
                required>
            </div>

            <div class="mb-3">
              <label for="retypePasswordLoginInput" class="form-label">
                Repita a Sua Senha
              </label>
              <input
                type="password"
                class="form-control"
                id="retypePasswordLoginInput"
                name="retypePassword"
                required>
            </div>

            <div class="d-flex justify-content-center mt-4">
              <button
                type="submit"
                class="btn btn-primary w-50">
                Criar conta
              </button>
            </div>
          </form>

        </div>
      </div>
    </section>
  </main>

  <footer class="text-center py-3">
    <p class="mb-0">
      &copy; <?= date('Y') ?>
    </p>
  </footer>

</body>