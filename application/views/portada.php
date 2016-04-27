<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Música Semanal</title>

</head>

<body id="page-top">

    <?php include('nav.php');?>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Recibe la mejor música actual</h1>
                <hr>
                <p style="color:white;">Recibe SMS con las mejores canciones del momento por solo 2€ semanales!</p>
                <a href="<?=base_url()?>users/registrarse" class="btn btn-primary btn-xl page-scroll">Suscribirse</a>
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

    <div id="modalSms" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Enviar SMS</h4>
                </div>
                <div class="modal-body">
                    <?=form_open(base_url().'web_service/web_service_call/')?> <!-- Open an input to register an user  -->                    
                    <p><?= form_input('texto', '', 'required style="color:black;" placeholder="Contenido del SMS"') ?></p>                        
                    <?=form_submit('submit', 'Enviar', 'class="btn btn-primary btn-xl page-scroll"')?> <!-- Submit the form -->
                </div>               
            </div>
        </div>
    </div>   
</body>

</html>
