<?php 
error_reporting(getenv( 'SOIREE_ERROR_REPORTING' ));
include('talent_header.php');
		require APPPATH.'/libraries/variableconfig.php';
		$variableconfig = new variableconfig();
		$webserviceurl = $variableconfig->webserviceurl(); 
 ?>
  <body>
    <div class="orangehead">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <div class="dashboard_tab_wrapper">
              <div class="dashboard_tab bring-forward clicked">
                <a href="">Get Support
                </a>
              </div>
              <div class="dashboard_tab bring-forward">
                <a href="<?php echo base_url();?>index.php/talent_how_outfit_works">How Outfit Works
                </a>
              </div>
              <div class="dashboard_tab bring-forward">
                <a href="<?php echo base_url();?>index.php/talent_faq">F.A.Q.
                </a>
              </div>
              <div class="dashboard_tab bring-forward">
                <a href="<?php echo base_url();?>index.php/talent_fee_charges">Fees & Charges
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="jumbotron supportheader" id="supportImg">
      <div class="container">
        <h1 class="centerText">How may we help you?
        </h1>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 whiteBG invitebox supportBody">
          <h1>let us help you
          </h1>
          <hr>
          <form action="" method="POST" role="form">
			<h5 id="alertmessage" class="text-danger"></h5>
            <div class="row narrowrow">
              <div class="col-xs-12 gutter-bottom form-group">
                <label for="" class="required">Email Address
                </label>
                <input class="form-control " name="email" id="email" type="text" maxlength="40"> 
              </div>
              <div class="col-xs-12 col-sm-6 gutter-bottom form-group">
                <label for="" class="required">First Name
                </label>
                <input class="form-control " name="fname" id="fname" type="text" maxlength="40"> 
              </div>
              <div class="col-xs-12 col-sm-6 gutter-bottom form-group">
                <label for="" class="required">Last Name
                </label>
                <input class="form-control" name="lname" id="lname" type="text" maxlength="100">                    
              </div>       
              <div class="col-xs-12 gutter-bottom form-group">
                <label for="" class="required">Message
                </label>
                <textarea class="form-control" rows="5" id="comment" name="message"></textarea>
              </div>    
              <div class="col-xs-12 gutter-bottom form-group">
                <button type="button" onclick="sendmail();" class="btn btn-danger btn-lg pull-right">Submit
                </button>
              </div>  
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php 
	error_reporting(getenv( 'SOIREE_ERROR_REPORTING' ));
	include('talent_footer.php'); ?>
  </body>
  <script>
	  function addagent(){
			var email = $("#email").val();
			var fname = $("#fname").val();
			var lname = $("#lname").val();
			var message = $("#comment").val();
			
				var url = '<?php echo $webserviceurl; ?>support';
				
				$.ajax({
					'type' : 'POST',
					'url': url,
					'data': {'email':email,'fname':fname,'lname':lname,'message':message},
					//'dataType': 'json',
					success: function(data) {
						
						var message = JSON.stringify(data['StatusCode']);
						var message = message.replace(/\"/g, "");
						
						if(message == "1") {													
							window.location.reload();												
						}
						else {
							var alertmessage = JSON.stringify(data['message']);
							var alertmessage = alertmessage.replace(/\"/g, "");
							$("#alertmsgs").text(alertmessage);
						}
					}
				
				});

		}
  </script>
</html>
