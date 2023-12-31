<?php
session_start();

if (!isset($_SESSION['usuario_email'])) {
  header("Location: paginalogin.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="pt" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Planner Online</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <link href="css/css_home.css" rel="stylesheet" />
</head>

<body>
  <header>
    <nav class="navbar navbar-inverse navbar navbar-dark bg-white fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="btn navbar-toggle pull-left">
            <i class="oi oi-menu"></i>
          </button>
          <a class="navbar-brand text-dark" href="#">Planner Online</a>
        </div>
      </div>
    </nav>
  </header>

  <div class="layout-main">

    <aside>
      <nav class="sidebar sidebar-open" id="nav">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link " href="home.php">
              <i class="oi oi-home"></i> <span>Home</span>
            </a>
          </li>
        </ul>

        <ul class="nav nav-pills">
          <a class="nav-link" href="lista.php">
            <li class="nav-item "><span class="nav-link active bi bi-layout-text-sidebar-reverse"> Lista</span></li>
          </a>
        </ul>

        <ul class="nav nav-pills">
          <a class="nav-link" href="journal.php">
            <li class="nav-item"><span class="nav-link active bi bi-journal-text"> Journal</span></li>
          </a>
        </ul>

        <ul class="nav nav-pills">
          <a class="nav-link" href="calendario.php">
            <li class="nav-item"><span class="nav-link active bi bi-calendar4-week"> Calendário</span></li>
          </a>
        </ul>

        <ul class="nav nav-pills">
          <a class="nav-link" href="planilha.php">
            <li class="nav-item"><span class="nav-link active bi bi-clipboard-check-fill"> Planilha</span></li>
          </a>
        </ul>

      </nav>
    </aside>

    <section class="layout-content">

      <p id="textoprincipal">Sem organização, não há otimização.</p>

    </section>

  </div>
  <div>
    <footer class="layout-footer">
      <div class="container">
        <span class="footer-copy">&copy; 2023 Planner Online</span>
      </div>
    </footer>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script type="text/javascript">
    var url = '';

    $('button[id*="btn_"]').click(function() {
      url = "http://localhost:8080/" + $(this).attr('id').split("_")[1];
    });

    $('#ok_confirm').click(function() {
      document.location.href = url;
    });
    $(function() {
      $('[data-toggle="popover"]').popover();
    });

    $(document).ready(function() {
      $(".navbar-toggle").click(function() {
        $(".sidebar").toggleClass("sidebar-open");
      })
    });
  </script>
</body>

</html>