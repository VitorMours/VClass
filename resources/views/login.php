<body class="d-flex flex-column min-vh-100">

  <?php
  require_once dirname(__DIR__, 2) . '/resources/views/partials/header.php';
  ?>

  <main class="flex-grow-1 d-flex align-items-center justify-content-center">
    <section class="container">
      <div class="row justify-content-center">
        <div class="col-11 col-sm-8 col-md-6 col-lg-4">

          <form method="POST" class="p-4 border rounded bg-white shadow-sm">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32)); ?>">
            <h2 class="text-center mb-4">Login</h2>

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

            <div class="d-flex justify-content-center mt-4">
              
              <button
                type="submit"
                class="btn btn-primary w-50">
                Fazer login
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