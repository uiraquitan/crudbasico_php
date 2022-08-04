<!DOCTYPE html>
<?php
include_once "./save.php";

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de contatos</title>
</head>

<body>

    <form action="?act=save" method="POST" name="form1">
        <h1>Agenda de contatos</h1>
        <hr>
        <input type="hidden" name="id" <?php
                                        // Preenche o id no campo id com um valor "value"
                                        if (isset($id) && $id != null || $id != "") {
                                            echo "value=\"{$id}\"";
                                        }
                                        ?> />
        Nome:
        <input type="text" name="nome" <?php
                                        // Preenche o nome no campo nome com um valor "value"
                                        if (isset($nome) && $nome != null || $nome != "") {
                                            echo "value=\"{$nome}\"";
                                        }
                                        ?> />
        E-mail:
        <input type="text" name="email" <?php
                                        // Preenche o email no campo email com um valor "value"
                                        if (isset($email) && $email != null || $email != "") {
                                            echo "value=\"{$email}\"";
                                        }
                                        ?> />
        Celular:
        <input type="text" name="celular" <?php
                                            // Preenche o celular no campo celular com um valor "value"
                                            if (isset($celular) && $celular != null || $celular != "") {
                                                echo "value=\"{$celular}\"";
                                            }
                                            ?> />
        <input type="submit" value="salvar" />
        <input type="reset" value="Novo" />
        <hr>
    </form>
    <table border="1" width="100%">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Celular</th>
            <th>Ações</th>
        </tr>
        <?php

        try {
            $stmt = Connection::getInstance()->prepare("select * from contatos");
            if ($stmt->execute()) {
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    echo "<tr>";
                    echo "<td>" . $rs->nome . "</td>";
                    echo "<td>" . $rs->email . "</td>";
                    echo "<td>" . $rs->celular . "</td>";
                    echo "<td> <center><a href=\"?act=upd&id=" . $rs->id . "\" title='alterar'>Alterar</a>"
                        . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                        . "<a href=\"?act=del&id=" . $rs->id . "\">[Excluir]</a></center></td>";;
                    echo "</tr>";
                }
            } else {
                echo "Não foi possível recuperar dados";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

        
        ?>
    </table>
</body>

</html>