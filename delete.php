<?php
require 'banco.php';
$id = 0;

if(!empty($_GET['rm']))
{
    $id = $_REQUEST['rm'];
}
echo($id);

if(!empty($_POST))
{
    $id = $_POST['rm'];

    //Delete do banco:

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "delete from tb_alunos where rm = ?";
    $q = $pdo->prepare($sql);

    $q->execute(array($id));
    Banco::desconectar();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU90FeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Deletar Contato</title>
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3 class="well">Excluir Contato</h3>
            </div>
                <form class="form-horizontal" action="delete.php" method="POST">
                    <input type="hidden" name="rm" value="<?php echo $id;?>" />
                    <div class="alert alert-danger"> Deseja excluir o contato? </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger">Sim</button>
                        <a href="index.php" type="btn" class="btn btn-default">Não</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>