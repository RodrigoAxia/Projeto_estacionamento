<?php
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"] ?? null;
    $senha = $_POST["senha"] ?? null;
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios(usuario,senha) VALUES(?,?) ");
    $stmt->bind_param("ss", $usuario, $senha_hash);
    if ($stmt->execute()) {
        header("location:cadastro_usuarios.php?cadastro=ok");
    } else {
        header("location:cadastro_usuarios.php?cadastro=erro");
    }
}






?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Estacionamento Senac</title>
    <?php include("estrutura/import_css.php") ?>

</head>

<body id="page-top">

    <?php include_once("./estrutura/menu.php"); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cadastro de usuarios</h1>

            <?php if (isset($_GET["cadastro"]) && $_GET["cadastro"] == "ok") {  ?>

                <div class='alert alert-success'>Cadastro efetuado!!!</div>

            <?php  } ?>

            <?php
            if (isset($_GET["cadastro"]) && $_GET["cadastro"] == "erro") {
                echo "<div class='alert alert-danger'>Erro ao cadastrar</div>";
            }
            ?>
        </div>


        <form class="p-5" method="post">
            <div class="d-flex flex-column flex-lg-row gap-4 ">
                <div class="mb-3 flex-grow-1">
                    <label class="form-label">Usuario</label>
                    <input type="email" class="form-control" name="usuario">
                </div>
                <div class="mb-3 flex-grow-1">
                    <label class="form-label">Senha</label>
                    <input type="text" class="form-control" name="senha">
                </div>
            </div>
            <div class="d-flex gap-4 flex-row-reverse mt-3 ">
                <button type="submit" class="btn btn-warning">Cadastrar Usuario</button>
            </div>
        </form>



    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php include_once("./estrutura/footer.php"); ?>

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sair</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Sair do sistema?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
                    <a class="btn btn-dark" href="login.html">Sim</a>
                </div>
            </div>
        </div>
    </div>


    <?php include("estrutura/import_js.php") ?>
</body>

</html>