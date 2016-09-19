<?php
class variableconfig {
  function mailurl() {
    return getenv( 'SOIREE_BASE_URL' ) . '/index.php/webservice/verify/';
  }

  function fpassurl() {
    return getenv( 'SOIREE_BASE_URL' ) . '/index.php/reset_password/';
  }

  function from_email() {
    return "support@beta.outfitstaff.com";
  }

  function smsurl() {
    return getenv( 'SOIREE_BASE_URL' ) . '/twilio/Services/sms.php';
  }

  function webserviceurl() {
    return getenv( 'SOIREE_BASE_URL' ) . '/index.php/webservice/';
  }

  function stripeurl() {
    return getenv( 'SOIREE_BASE_URL' ) . '/stripe/';
  }
  
  function imgurl() {
    return getenv( 'SOIREE_BASE_URL' ) . '/nectorimg/';
  }
}
