<footer>
  <?php echo $baseInfo->bas->sidfot ?>
  <?php echo $settings[0]->value15 == "1" ? "" : "<!--"; ?>
  <br>
  <p align="right"><small><a href="<?php echo $settings[0]->string21 . '/' . $settings[0]->value21; ?>" target="_blank">Teamplay <?php echo S_ADMIN ?></a></small></p>
  <?php echo $settings[0]->value15 == "1" ? "" : "-->"; ?>
</footer>

</div>
</div>

<!-- Core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="assets/js/offcanvas.js"></script>
</body>

</html>