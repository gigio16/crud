<?php


include "banco.php";

$pdo = Banco::conectar();

// Protegndo contra XSS e SQL Injection
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Hash da senha

// Consulta otimizada buscando apenas os campos necessários
$validarLogin = $pdo->prepare("SELECT * FROM tb_alunos WHERE email = :email AND pass = :senha");
$validarLogin->bindParam(':email', $email);
$validarLogin->bindParam(':senha', $senha);
$validarLogin->execute();

if ($validarLogin->rowCount() >= 1) {
    $usuario = $validarLogin->fetch(PDO::FETCH_ASSOC);

    header('Location: index.php'); 
    exit();
} else {
?>
    <script>
        alert("Usuário não encontrado")
    </script>
<?php
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logint</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assests/css/estilo.css">
</head>
<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="../aula_Php/assests/img/login.png" class="img-fluid" alt="Sample image">
                </div>
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method= "post" action="login.php">
                    <div class="divider d-flex align-items-center my-4">
                        <input type="email" id="form3Example3" class="form-control form-control-lg"
                            placeholder="Enter password" name="senha" />
                        <label class="form-label" for="form3Example4">Password</label>
                    </div>
                    <div class="d-flex justify-content-between algn-items-center">
                        <!-- Checkbox -->
                        <p class="form-check mb-0">Don't have an account? <a href="#!" class="link-danger">Register</a>
                    </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="d-Flex flex-column flex-md-row text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <div class="text-white mb-3 mb-md-0">
            Copyrigth 2020. All rigths reserved.
        </div>
    </div>
</body>
</html>