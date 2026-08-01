<?php
include("conn.php");
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
            <h1 class="h3 mb-0 text-gray-800">Estacionamento Senac - Entrada de veiculos</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Gerar Relatório</a>
        </div>


        <form action="./registro_veiculo.php" class="p-5" method="get">
            <div class="d-flex flex-column flex-lg-row gap-4 ">
                <div class="mb-3 flex-grow-1">
                    <label for="" class="form-label">Placa</label>
                    <input type="text" class="form-control" name="placa">
                </div>
                <div class="mb-3 flex-grow-1">
                    <label for="" class="form-label">Cor</label>
                    <Select class="form-select" name="cor">
                        <?php
                        $result_cores = $conn->query("SELECT * FROM cores");
                        while ($linha = $result_cores->fetch_assoc()) {
                        ?>
                            <option value="<?= $linha["id"] ?>"> <?= $linha["cor"] ?></option>
                        <?php } ?>
                    </Select>
                </div>

                <div class="mb-3 flex-grow-1">
                    <label for="" class="form-label">Observações</label>
                    <textarea name="observacoes" id="" cols="30" rows="10"
                        class="form-control"></textarea>
                </div>
            </div>

            <div class="d-flex gap-4 flex-row-reverse mt-3 ">
                <button type="submit" class="btn btn-warning">Cadastrar</button>
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