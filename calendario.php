<!DOCTYPE html>
<html lang="pt" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Calendário</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <link href="css/css_indexnew.css" rel="stylesheet" />
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

      <div class="container">

        <div id='calendario'>

          <?php
          session_start();

          $mes = isset($_GET['mes']) ? $_GET['mes'] : date('m');
          $ano = isset($_GET['ano']) ? $_GET['ano'] : date('Y');

          $primeiro_dia = mktime(0, 0, 0, $mes, 1, $ano);

          $numero_dias = date('t', $primeiro_dia);

          $dia_semana = date('w', $primeiro_dia);

          $espacos_em_branco = $dia_semana;

          $numero_dias += $dia_semana;

          echo '<p class="h3" align="center">Mês atual</p>';
          echo '<table border="2" align="center">';
          echo '<tr><th>Dom</th><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sab</th></tr>';
          echo '<tr>';

          for ($i = 0; $i < $numero_dias; $i++) {
            // Adicionar espaços em branco antes do primeiro dia do mês
            if ($i < $espacos_em_branco) {
              echo '<td></td>';
            } else {
              $dia = $i - $espacos_em_branco + 1;
              echo "<td>$dia</td>";
            }

            // Quando alcançar o fim da semana, iniciar uma nova linha
            if (($i + 1) % 7 == 0) {
              echo '</tr><tr>';
            }
          }

          // Fechar a tabela
          echo '</tr>';
          echo '</table>';
          ?>

          <br />

          <form id="novo_evento" action="" method="post">
            Nome do Evento: <input type="text" name="nome" id="nome" class="form-control" required><br>
            Descrição do Evento: <input type="text" name="descricao" id="descricao" class="form-control" required><br>
            Data do Evento: <input type="date" name="data" id="data" class="form-control" required><br>
            <button type="submit" class="btn btn-outline-info">Cadastrar</button>
          </form>

          <br>
          <?php
          // session_start();

          function conectarBanco()
          {
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $banco = "planneronline";


            $conexao = new mysqli("localhost", "root", "", "planneronline");

            if ($conexao->connect_error) {
              die("Erro ao conectar ao banco de dados: " . $conexao->connect_error);
            }

            return $conexao;
          }

          function consultarUsuarioPorEmail($email)
          {
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $banco = "planneronline";

            $conexao = new mysqli("localhost", "root", "", "planneronline");

            if ($conexao->connect_error) {
              die("Erro ao conectar ao banco de dados: " . $conexao->connect_error);
            }

            $resultado = $conexao->query("SELECT * FROM usuario WHERE email = '$email'");

            if ($resultado->num_rows > 0) {
              return $resultado->fetch_assoc();
            } else {
              return null;
            }

            $conexao->close();
          }

          function autenticarUsuario($email, $senha)
          {

            $usuario = consultarUsuarioPorEmail($email);

            if ($usuario) {
              if ($senha === $usuario['senha']) {
                session_start();
                $_SESSION['usuario_email'] = $email;

                return true;
              }
            }

            return false;
          }

          if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $emailAutenticado = $_SESSION['usuario_email'];


            $data = $_POST["data"];
            $nome = $_POST["nome"];
            $descricao = $_POST["descricao"];
            $conteudo = "Data: $data<br> Nome do Evento: $nome <br> Mais informações: $descricao";

            $conexao = conectarBanco();

            $sql = "INSERT INTO evento (data, nome, descricao, email) VALUES (?, ?, ?, ?)";
            $stmt = $conexao->prepare($sql);

            if ($stmt) {
              $stmt->bind_param("ssss", $data, $nome, $descricao, $emailAutenticado);

              $stmt->execute();

              $stmt->close();
            } else {
            }
            $conexao->close();

            echo "<div id='conteudo' style='background-color: white;
                                 color: #333;
                                     padding: 10px;
                                     border: 2px solid #ccc;
                                   border-radius: 10px'>$conteudo</div>";
          } else {
          }

          ?>
        </div>

      </div>

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