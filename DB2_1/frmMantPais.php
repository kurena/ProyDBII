<?php include("header.php");?>
<head>
    <link href="assets/css/jquery.dataTables.css" rel="stylesheet">
</head>
<h3><i class="fa fa-angle-right"></i>Países</h3>
<div class="col-md-12 panel-body">
    <div class="content-panel">
        <hr>
        <table class="table" id="PaisesTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Cod. Telefónico</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div><! --/content-panel -->
</div><!-- /col-md-12 -->

<?php include("footer.php"); ?>
<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery.dataTables.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>

<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>

<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="assets/js/gritter-conf.js"></script>
<script src="assets/js/controllers/pais_controller.js"></script>
<!--script for this page-->
<script type="application/javascript">
    initControls.init();
</script>