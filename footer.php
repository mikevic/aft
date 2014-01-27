
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php
    	switch ($current_page) {
    		case 'aft.php':
    			echo '<script src="js/aft.js"></script>';
    			break;
    		
    		default:
    			# code...
    			break;
    	}

    ?>
  </body>
</html>