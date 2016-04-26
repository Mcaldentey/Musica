<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registro</title>

</head>

<body id="page-top">

    <?php include('nav.php');?>

    <header>
        <div class="header-content">
            <div class="header-content-inner">        
                <?php echo (isset($error)) ? '<p>Credenciales incorrectas!</p>' : '';?>   
                <div class="container">
                    <div class="col-md-4">
                        <p style="color: white; font-size: 25px">Nombre de usuario: *</p>
                        <p style="color: white; font-size: 25px">Contraseña: *</p>
                    </div>

                    <div class="col-md-4">
                        <?=form_open(base_url().'users/comprobar_login/')?> <!-- Open an input to register an user  -->                    
                        <p><?= form_input('username', '', 'required style="color:black;" pattern=".{5,20}"') ?></p>
                        <p><?=form_password('password', '', 'required style="color:black;" pattern=".{3,15}"')?></p>
                        <?=form_submit('submit', 'Entrar', 'class="btn btn-primary btn-xl page-scroll"')?> <!-- Submit the form -->

                    </div>

                </div>
            </div>
        </div>
    </header>



    <!-- jQuery -->
    <script src="<?=base_url()?>assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?=base_url()?>assets/js/jquery.easing.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.fittext.js"></script>
    <script src="<?=base_url()?>assets/js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>assets/js/creative.js"></script>

</body>
</html>
