<?php
require_once "./conection.php";

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
    $celular = (isset($_POST["celular"]) && $_POST["celular"] != null) ? $_POST["celular"] : NULL;
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $email = NULL;
    $celular = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST['act'] == "save" && $nome != "") {

    try {
        if($id != ""){
            $stmt = Connection::getInstance()->prepare("update contatos set nome=?, email=?,celular=? where id = ?");
            $stmt->bindParam(4, $id);
        }else{
            $stmt = Connection::getInstance()->prepare("insert into contatos (nome, email, celular) values (?,?,?)");
        }


        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $celular);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                $id = null;
                $nome = null;
                $email = null;
                $celular = null;
                header("Location: ". $_SERVER["HTTP_REFERER"]);
            }
        } else {
            throw new Exception("Erro: Não foi possivel executar a declaração");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

    include_once "./upd.php";

    if (isset($_REQUEST['act']) && $_REQUEST['act'] == "del" && $id != "") {
        try {
            $stmt = Connection::getInstance()->prepare("delete from  contatos where id = ?");
            $stmt->bindParam(1, $id);
            if ($stmt->execute()) {
                echo "registro excluido";
                $id = null;
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            } else {
                throw new Exception("Erro ao deletar");
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }