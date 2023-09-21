<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KrazyKars 2.0</title>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
<body>
<?php
        require_once "configs/pessoas.php";

        if (isset($_GET["deletarPessoa"]) and !empty($_GET["deletarPessoa"])){
            $id = $_GET["deletarPessoa"];
            if (Pessoa::existeId($id)) {
                //Carro::deletarDono($idPessoa);
                $resultado = Pessoa::deletar($id);
                if ($resultado) {
                    echo "<p>O usuário foi deletado com sucesso!</p>";   
                } else {
                    echo "<p>Houve erro para deletar a pessoa</p>";
                }
            } else {
                echo "<p>Essa pessoa não existe!</p>";
            
            }
        } 

        
    if (isset($_POST["nome"]) and !empty($_POST["nome"])) {
        if (isset($_POST["login"]) and !empty($_POST["login"])) {
            if (isset($_POST["senha"]) and !empty($_POST["senha"])) {
                $nome = $_POST["nome"];
                $login = $_POST["login"];
                $senha = $_POST["senha"];

                if (!Pessoa::existe($login)) {
                    $resultado = Pessoa::cadastrar($nome, $login, $senha);
                    if ($resultado) {
                        echo "<p>O usuário $nome foi cadastrado com sucesso!</p>";
                    } else {
                        echo "<p>Houve erro no cadastro do $nome</p>";
                    }
                } else {
                    echo "<p>Essa pessoa já existe!</p>";
                }
            }
        }
    }
    ?>

    <h2>Cadastre a pessoa:</h2>
    <form method="POST">
        <p>Digite seu nome:</p>
        <input type="text" name="nome" required>
        <p>Digite seu login:</p>
        <input type="email" name="login" required>
        <p>Digite sua senha:</p>
        <input type="password" name="senha" required minlength="3">
        <br>
        <button>Cadastrar</button>
    </form>

    <?php
        
        require_once "configs/marca.php";

        if (isset($_GET["deletarMarca"]) and !empty($_GET["deletarMarca"])){
            $id_marca = $_GET["deletarMarca"];
            if (Marca::existeId($id_marca)) {
                Marca::deletar($id_marca);
                $resultado = Marca::deletar($id_marca);
                if ($resultado) {
                    echo "<p>A marca foi deletada com sucesso!</p>";   
                } else {
                    echo "<p>Houve erro para deletar a marca!</p>";
                }
            } else {
                echo "<p>Essa marca não existe!</p>";
            
            }
        }

    if (isset($_POST["nomeMarca"]) and !empty($_POST["nomeMarca"])) {
        $nomeMarca = $_POST["nomeMarca"];

        if (!Marca::existe($nomeMarca)) {
            $resultado = Marca::cadastrar($nomeMarca);
            if ($resultado) {
                echo "<p>A marca $nomeMarca foi cadastrada com sucesso!</p>";
            } else {
                echo "<p>Houve erro no cadastro da marca $nomeMarca</p>";
            }
        } else {
            echo "<p>Essa marca já existe!</p>";
        }
    }
    ?>

    <h2>Cadastre a marca de carro:</h2>
    <form method="POST">
        <p>Digite o nome marca:</p>
        <input type="text" name="nomeMarca" required>
        <br>
        <button>Cadastrar</button>
    </form>

    <?php
        require_once "configs/carros.php";

        if (isset($_GET["deletarCarro"]) and !empty($_GET["deletarCarro"])){
            $id_carro = $_GET["deletarCarro"];
            if (Carro::existeId($id_carro)) {
                $resultado = Carro::deletar($id_carro);
                if ($resultado) {
                    echo "<p>O carro foi deletado com sucesso!</p>";   
                } else {
                    echo "<p>Houve erro para deletar o carro!</p>";
                }
            } else {
                echo "<p>Essa carro não existe!</p>";
            
            }
        } 

    if (isset($_POST["nomeCarro"]) and !empty($_POST["nomeCarro"])) {
            if (isset($_POST["ano"]) and !empty($_POST["ano"])) {
                if (isset($_POST["placa"]) and !empty($_POST["placa"])) {
                    if (isset($_POST["datacadastro"]) and !empty($_POST["datacadastro"])) {
                        if (isset($_POST["idMarca"]) and !empty($_POST["idMarca"])) {
                    if (isset($_POST["idPessoa"]) and !empty($_POST["idPessoa"])) {
                    $nomeCarro = $_POST["nomeCarro"];
                    $ano = $_POST["ano"];
                    $placa = $_POST["placa"];
                    $datacadastro = $_POST["datacadastro"];
                    $idMarca = $_POST["idMarca"];
                    $idPessoa = $_POST["idPessoa"];

                    if (Pessoa::existeId($idPessoa)) {
                        $resultado = Carro::cadastrar($nomeCarro, $ano, $placa,$datacadastro, $idMarca, $idPessoa);
                        if ($resultado) {
                            echo "<p>O carro $nomeCarro foi cadastrado com sucesso!</p>";
                        } else {
                            echo "<p>Houve erro no cadastro do $nomeCarro</p>";
                        }
                    } else {
                        echo "<p>Essa pessoa não existe!</p>";
                    }
                
                }
                }
                }
                }
            }
    }
    ?>

    <h2>Cadastre o carro:</h2>
    <form method="POST">
        <p>Digite nome do carro:</p>
        <input type="text" name="nomeCarro" required>
        <p>Digite ano do carro:</p>
        <input type="number" name="ano" required>
        <p>Digite a placa do carro:</p>
        <input type="text" name="placa" required maxlength="7">
        <p>Digite a data de cadastro:</p>
        <input type="date" name="datacadastro" required>
        <p>Selecione a marca:</p>
        <select name="idMarca" required>
            <option value=""></option>
            <?php
            $listaMarcas = Marca::listar();
    foreach ($listaMarcas as $marca) {
        $nomeMarca = $marca["nomeMarca"];
        $id_marca = $marca["id_marca"];

        echo "<option value='$id_marca'>$nomeMarca</option>";
    }

    ?>

        </select>
        <p>Selecione o dono:</p>
        <select name="idPessoa" required>
            <option value=""></option>
            <?php
            $listaPessoas = Pessoa::listar();
    foreach ($listaPessoas as $pessoa) {
        $nome = $pessoa["nome"];
        $id = $pessoa["id"];

        echo "<option value='$id'>$nome</option>";
    }

    ?>
        </select>
        <br>
        <button>Cadastrar</button>
    </form>

    <h3 class="pessoa">Lista de pessoas cadastrados</h3>
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Login</td>
                <td>Senha</td>
            </tr>
        </thead>
        <tbody>
            <?php
        require_once "configs/pessoas.php";

    $listaPessoas = Pessoa::listar();
    foreach ($listaPessoas as $pessoa) {
        echo "<tr>";
                    
        echo "<td>" . $pessoa["id"] ."</td>";
        echo "<td>" . $pessoa["nome"] ."</td>";
        echo "<td>" . $pessoa["login"] ."</td>";
        echo "<td>" . $pessoa["senha"] ."</td>";
        $id=$pessoa["id"];
        echo "<td>
                <a href='editarPessoa.php?id=$id'>Editar</a>
                <a href='index.php?deletarPessoa=$id'>Deletar</a> 
            </td>";
        echo "</tr>";
    }
    ?>
        </tbody>
    </table>

    <h3 class="marca">Lista de marcas cadastrados</h3>
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
            </tr>
        </thead>
        <tbody>
            <?php
        require_once "configs/marca.php";

    $listaMarcas = Marca::listar();
    foreach ($listaMarcas as $marca) {
        echo "<tr>";
                    
        echo "<td>" . $marca["id_marca"] ."</td>";
        echo "<td>" . $marca["nomeMarca"] ."</td>";
        $id_marca=$marca["id_marca"];
        echo "<td>
                <a href='editarMarca.php?id=$id_marca'>Editar</a>
                <a href='index.php?deletarMarca=$id_marca'>Deletar</a> 
            </td>";
        echo "</tr>";
    
    }
    ?>
        </tbody>
    </table>

    <h3 class="carro">Lista de carros cadastrados</h3>
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Ano</td>
                <td>Placa</td>
                <td>Data Cadastro</td>
                <td>Marca</td>
                <td>Dono</td>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once "configs/carros.php";

    $listaCarros = Carro::listar();
    foreach ($listaCarros as $carro) {
        echo "<tr>";
                    
        echo "<td>" . $carro["id_carro"] ."</td>";
        echo "<td>" . $carro["nomeCarro"] ."</td>";
        echo "<td>" . $carro["ano"] ."</td>";
        echo "<td>" . $carro["placa"] ."</td>";
        echo "<td>" . $carro["datacadastro"] ."</td>";
        echo "<td>" . $carro["idMarca"] ."</td>";
        echo "<td>" . $carro["idPessoa"] ."</td>";
        echo "<td>
                <a href='editarCarro.php?id=$id>Editar</a>
                <a href='index.php?deletarCarro=$id'>Deletar</a>
            </td>";
        echo "</tr>";

    }
    ?>
        </tbody>
    </table>
</body>
</body>
</html>