
    <!-- Bootstrap core JavaScript//Handling Region
if(isset($_POST['region']) && !empty($_POST['region'])){
    $region = $_POST['region'];
} else {
    $region = 'world';
}
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <?php
      switch ($current_page) {
    		case 'aft.php':
    			echo '<script src="js/aft.js"></script>';
    			break;
    		
    		default:
    			# code...
    			break;
    	}
      if($x_type == 'Global Internship'){
        echo generate_multi_select_js('fow');
        if($fow != 'unset'){
          echo generate_multi_select_js('primarysecondary');
          echo generate_multi_select_js('background');
        }
      } elseif ($x_type == 'Global Community Development'){
        echo generate_multi_select_js('masterissue');
        if($master_issue != 'unset'){
          echo generate_multi_select_js('subissue');
        }
      }
      echo generate_multi_select_js('duration');
      echo generate_multi_select_js('region');

    ?>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47333186-2', 'myaiesec.net');
  ga('send', 'pageview');

</script>
  </body>
</html>