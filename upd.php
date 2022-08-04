<?php
require_once "./conection.php";
if (isset($_REQUEST['act']) && $_REQUEST['act'] == "upd" && $id != "") {
    try {
        $stmt = Connection::getInstance()->prepare("select * from contatos where id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->id;
            $nome = $rs->nome;
            $email = $rs->email;
            $celular = $rs->celular;
        } else {
            throw new Exception("Erro ao carregar dados");
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Erro: Não foi encontrado dados";
}
