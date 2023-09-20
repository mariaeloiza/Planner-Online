<?php
require_once __DIR__ . "/../configs/BancoDados.php";

class Usuario
{

    public static function getUsuario()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM Usuario");
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function cadastrar($email, $nome, $senha)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("INSERT INTO Usuario(email, nome, senha) VALUES (?,?,?)");

            $senha = password_hash($senha, PASSWORD_BCRYPT);
            $stmt->execute([$email, $nome, $senha]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeUserNome($nome)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT COUNT(*) FROM Usuario WHERE nome = ?");
            $stmt->execute([$nome]);

            if ($stmt->fetchColumn() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeUsuario($email)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT COUNT(*) FROM Usuario WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->fetchColumn() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function login($email, $nome, $senha)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM Usuario WHERE email = ?");
            $stmt->execute([$nome]);
            $resultado = $stmt->fetchAll();

            if (count($resultado) != 1) {
                return false;
            }

            if (password_verify($senha, $resultado[0]["senha"])) {
                return $resultado[0]["email"];
            } else {
                return False;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
