<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/css/adminlte.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Horarios login</title>
</head>

<body>
    <header>
        <div class="d-flex flex-row-reverse">
            <img class="img" src="img/cenigraf.png">
        </div>
    </header>
    <div class="container">
        <div class="wrapper">
            <form method="POST" action="recuperar.php">
                <input type="hidden" name="token" value="<?php if (isset($_GET['token'])) {
                                                                echo $_GET['token'];
                                                            } ?>">
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="text" name="email" value="<?php if (isset($_GET['email'])) {
                                                                echo $_GET['email'];
                                                            } ?>" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Nueva contraseña</label>
                    <input type="password" name="new_password" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Confirme la nueva contraseña</label>
                    <input type="password" name="confirm_password" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <button type="submit" name="password_update" class="btn btn-dark">Cambiar contraseña</button>
                </div>
            </form>
        </div>
        <?php
        if (isset($_SESSION['status'])) {
        ?>
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?= $_SESSION['status']; ?></strong>
                <br>
                <a href="index.php">Regrese al login dando click aquí</a>
            </div>
    </div>
<?php
            unset($_SESSION['status']);
        } ?>
</div>
</div>
<footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="https://comunicaciongraficasena.blogspot.com">Cenigraf</a>.</strong> Todos los derechos reservados.
</footer>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>