<header>
  <!-- Adicioanr dentro do header, verificacao de sessao para a partir dela determianr 
   qoque deve ser mostrado, e oque nao deve ser msotrado-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid d-flex justify-content-between align-items-center w-100">
      <a class="navbar-brand" href="/">VClass</a>


      <ul class="navbar-nav d-flex flex-row gap-3 mb-0">
        <?php if (isset($_SESSION["user_id"])): ?>
          <li class="nav-item">
            <a href="/logout" class="nav-link">Log out</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a href="/signin" class="nav-link">Sign in</a>
          </li>
          <li class="nav-item">
            <a href="/login" class="nav-link">Log in</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</header>   