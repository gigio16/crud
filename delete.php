<?php
require 'banco.php';

$id = 0;

// Verifica se 'codigo' está definido na URL
if (!empty($_GET['codigo'])) {
    $id = $_GET['codigo']; // Use $_GET em vez de $_REQUEST
}

if (!empty($_POST)) {
    $id = $_POST['codigo'];

    // Deletar do banco:
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM tb_alunos WHERE codigo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Banco::desconectar();
    header("Location: index.php"); // Corrigido 'locatio' para 'Location'
    exit(); // É uma boa prática chamar exit após header
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
                <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($id); ?>" /> <!-- htmlspecialchars para segurança -->
                <div class="alert alert-danger"> Deseja excluir o contato? </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-danger">Sim</button>
                    <a href="index.php" class="btn btn-default">Não</a> <!-- Removido 'type' incorreto -->
                </div>
            </form>
        </div>
    </div>
</body>
</html>
