<?php 
error_reporting(getenv( 'SOIREE_ERROR_REPORTING' ));
include('talent_header.php');
require APPPATH.'/libraries/class.phpmailer.php'; ?>
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
		  <?php if((isset($_POST)) && (!empty($_POST))) { 
			$email = $_POST['email'];
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$msg = $_POST['message'];
			
			$subject = "Outfit - Need Support";
			$message = "<p>Email: ".$email." <br> First name: ".$fname." <br>Last name: ".$lname." <br> Message: ".$msg."</p>";
			
			$to_email = "car3chan@gmail.com";
			$mail             = new PHPMailer();
    	$body             = $message;
    	$body             = eregi_replace("[\]",'',$body);
    	$mail->IsSMTP(); // telling the class to use SMTP
		$SMTP_HOST = getenv( 'SMTP_HOST' );
		$SMTP_USERNAME = getenv( 'SMTP_USERNAME' );
		$SMTP_PASSWORD = getenv( 'SMTP_PASSWORD' );
		$SMTP_FROM = getenv( 'SMTP_FROM' );
    	$mail->Host       = $SMTP_HOST; // SMTP server
    	//$mail->SMTPDebug  = 2;           // enables SMTP debug information (for testing)
    	                                 // 1 = errors and messages
    	                                 // 2 = messages only
    	$mail->SMTPAuth   = true;        // enable SMTP authentication
    	$mail->Host       = $SMTP_HOST; // sets the SMTP server
    	$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
    	$mail->Username   = $SMTP_USERNAME; // SMTP account username
    	$mail->Password   = $SMTP_PASSWORD;        // SMTP account password
    	$mail->SetFrom($SMTP_FROM, 'outfitstaff');
    	$mail->AddReplyTo($SMTP_FROM,"outfitstaff");
    	$mail->Subject    = $subject;
    	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    	$mail->MsgHTML($body);
    	$address = $to_email;
    	$mail->AddAddress($address, "outfitstaff");
    	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
    	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
    	$mail->Send();
    	/*if(!$mail->Send()) {
    	echo "Mailer Error: " . $mail->ErrorInfo;
    	} else {
    	echo "Message sent!";
    	}*/
			
		  }
		  ?>
            <div class="row narrowrow">
              <div class="col-xs-12 gutter-bottom form-group">
                <label for="" class="required">Email Address
                </label>
                <input class="form-control " name="email" id="" type="text" maxlength="40"> 
              </div>
              <div class="col-xs-12 col-sm-6 gutter-bottom form-group">
                <label for="" class="required">First Name
                </label>
                <input class="form-control " name="fname" id="" type="text" maxlength="40"> 
              </div>
              <div class="col-xs-12 col-sm-6 gutter-bottom form-group">
                <label for="" class="required">Last Name
                </label>
                <input class="form-control" name="lname" id="" type="text" maxlength="100">                    
              </div>       
              <div class="col-xs-12 gutter-bottom form-group">
                <label for="" class="required">Message
                </label>
                <textarea class="form-control" rows="5" id="comment" name="message"></textarea>
              </div>    
              <div class="col-xs-12 gutter-bottom form-group">
                <button type="submit" class="btn btn-danger btn-lg pull-right">Submit
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
</html>
