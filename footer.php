        <!-- *** GET IT ***
_________________________________________________________ -->
        
         <div id="get-it">
            <div class="container">
                <div class="col-md-8 col-sm-12">
                    <h3>Do you want cool website to promote your business & ideas?</h3>
                </div>
                <div class="col-md-4 col-sm-12">
                    <a href="contact.php" class="btn btn-template-transparent-primary">Make A Request now</a>
                </div>
            </div>
        </div>


        <!-- *** GET IT END *** -->
        
        
       <!-- *** FOOTER ***
_________________________________________________________ -->

        <footer id="footer">
            <div class="container">
                <div class="col-md-6 col-sm-6">
                    <h4>About us</h4>

                    <p>Busnurd Technologies Promotes Businesses and Schools with Awesome Websites. High technological expertise makes us a specialist in delivering dynamic, interactive & responsive websites with 100% success rate with our clients. Our teams of dedicated employees spend endless amount of time in meeting our customer requirements with creative technologies give us the competitive edge in the market.</p>

                </div>
                <!-- /.col-md-6 -->

               

                <div class="col-md-6 col-sm-6">

                    <h4>Contact</h4>

                    <p><strong>Busnurd Technologies</strong>
						<br>85, Abiodun Atiba Road
                        <br>Kosobo Layout, Kosobo, Oyo
                        <br>Oyo State,
                        <strong> Nigeria</strong>
						<br>+234(0) 806 278 0933
                    </p>

                    <a href="contact.php" class="btn btn-small btn-template-main">Contact Us</a>

                    <hr class="hidden-md hidden-lg hidden-sm">

                </div>
                <!-- /.col-md-6 -->
                
            </div>
            <!-- /.container -->
        </footer>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->

        <!-- *** COPYRIGHT ***
_________________________________________________________ -->

        <div id="copyright">
            <div class="container">
                <div class="col-md-12">
                    <p class="text-center">Copyright &#169; 2015 - <?php echo date('Y'); ?> Busnurd Technologies | All rights reserved</p>
                </div>
            </div>
        </div>
        <!-- /#copyright -->

        <!-- *** COPYRIGHT END *** -->



    </div>
    <!-- /#all -->

    <!-- #### JAVASCRIPT FILES ### -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')
    </script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/front.js"></script>

    

    <!-- owl carousel -->
    <script src="js/owl.carousel.min.js"></script>
	<!-- Bootstrap Date-Picker Plugin -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  <script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      // var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        // container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
<!-- Use the commented script for a menu that has its active class on <a>
<script>
	$(document).ready(function(){
		$('ul li a').click(function(){
			$('li a').removeClass("active");
			$(this).addClass("active");
});
});
</script>
-->
<script>
	$('li').each(function(){
    if(window.location.href.indexOf($(this).find('a:first').attr('href'))>-1)
    {
    $(this).addClass('active').siblings().removeClass('active');
    }
});
</script>

</body>

</html>