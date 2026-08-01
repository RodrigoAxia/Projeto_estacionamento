<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("location: login.php");
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
            <h1 class="h3 mb-0 text-gray-800">Estacionamento Senac - <?= $_SESSION["usuario"] ?></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Gerar Relatório</a>
        </div>

        <div class="container mb-5">
            <div class="row justify-content-center gap-2">

                <?php
                include("conn.php");
                $sql = "SELECT id,placa,dt_entrada FROM estacionamento WHERE dt_saida IS NULL";
                $result = $conn->query($sql);
                while ($linha = $result->fetch_assoc()) {
                    $data = new DateTime($linha["dt_entrada"]);


                ?>
                    <div class="card d-flex" style="width: 10rem;">
                        <img src="./img/vermelho.png" style="width: 100px; margin: 0px auto;" 
                        class="card-img-top" alt="...">
                        <div class="card-body p-2">
                            <h5 class="card-title"><?= $linha["placa"] ?></h5>
                            <p class="card-text"><?= $data->format('d/m/y H:i'); ?></p>
                            <a href="./saida_veiculo.php?idVeiculo=<?= $linha["id"] ?>" 
                            class="btn btn-dark">Efetuar saída</a>
                        </div>
                    </div>
                <?php
                }
                ?>


            </div>
        </div>


        <div class="container p-5 d-flex justify-content-end">
            <nav aria-label="...">

            </nav>
        </div>

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
                    <a class="btn btn-dark" href="./sair.php">Sim</a>
                </div>
            </div>
        </div>
    </div>


    <?php include("estrutura/import_js.php") ?>

</body>

</html>