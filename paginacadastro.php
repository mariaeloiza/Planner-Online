<!DOCTYPE html>
<html lang="pt" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Cadastro</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
 

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!--<link href="/webjars/bootstrap/css/bootstrap.min.css" rel="stylesheet" />-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom styles for this template -->
    <link href="css/css_login.css" rel="stylesheet" />
</head>
<body>

<center>
      <?php
  
        $conn = mysqli_connect("localhost", "root", "", "planneronline");
          
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
        
        if (isset($_POST["email"]) and !empty($_POST["email"])) {
          if (isset($_POST["nome"]) and !empty($_POST["nome"])) {
           if (isset($_POST["senha"]) and !empty($_POST["senha"])) {
               $email = $_POST["email"];
               $nome = $_POST["nome"];
               $senha = $_POST["senha"];
          
              $senha = password_hash($senha, PASSWORD_BCRYPT);

              $email = $_POST["email"];
              $nome = $_POST["nome"];
              $senha = $_POST["senha"];
              $senha = password_hash($senha, PASSWORD_BCRYPT);
      
              $sql = "INSERT INTO usuario VALUES ('$email', 
                        '$nome','$senha')";


        // $email = $_POST["email"];
        // $nome = $_POST["nome"];
        // $senha = $_POST["senha"];

        // $senha = password_hash($senha, PASSWORD_BCRYPT);
      
        // $sql = "INSERT INTO usuario VALUES ('$email', 
        //     '$nome','$senha')";
          
            if(mysqli_query($conn, $sql)){
              header('Location: http://localhost/PlannerOnline/paginalogin.php');
              die();
            } else{
              // echo "ERROR: Hush! Sorry $sql. " 
              //    . mysqli_error($conn);
            }
          
            mysqli_close($conn);
      
            }
          }
        }

      ?>
</center>

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100" >
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;" id="caixa">
          <div class="card-body p-5 text-center">
      
            <h3 class="mb-5">Cadastro</h3>


            <form action="" method="POST">
              <div class="form-outline mb-4">
                <input type="text"  class="form-control form-control-lg" name="email"/>
                <label class="form-label">E-mail</label>
              </div>

              <div class="form-outline mb-4">
                <input type="text" class="form-control form-control-lg" name="nome"/>
                <label class="form-label">Nome de Usuário</label>
              </div>
      
              <div class="form-outline mb-4">
                <input type="password" class="form-control form-control-lg" name="senha" minlength="4" maxlength="8"/>
                <label class="form-label">Senha (de 4 a 8 caracteres)</label>
              </div>
    
            <button class="btn btn-outline-info" type="submit" value="Submit">Cadastrar</button> 


            </form>
                  
            <hr class="my-4">
      
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div>
    <footer class="layout-footer fixed-bottom" style="text-align: center ;" >
        <div class="container">
          <span class="footer-copy">&copy; 2023 Planner Online</span>
        </div>
      </footer>
</div>




<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




<script type="text/javascript">

    var url='';

    $('button[id*="btn_"]').click(function(){
        url="http://localhost:8080/"+$(this).attr('id').split("_")[1];
    });

    $('#ok_confirm').click(function(){
        document.location.href=url;
    });
    $(function() {
        $('[data-toggle="popover"]').popover();
    });

    $(document).ready(function(){
        $(".navbar-toggle").click(function(){
            $(".sidebar").toggleClass("sidebar-open");
        })
    });

</script>
</body>
</html>