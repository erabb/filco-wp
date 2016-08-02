<?php

 //collect info from ajax
  $admin_email = "p_child99@hotmail.com";
  $name = $_REQUEST['contact-name'];
  $email = $_REQUEST['contact-email'];
  $subject = 'Website contact form'.$_REQUEST['contact-reason'];

  $msg = 'Name: '.$name. '\r\n'.'Email: '.$email. '\r\n Details: '. $_REQUEST['contact-details'];
  $comment = $_REQUEST['contact-details'];
  
  //send email
  if(mail($admin_email, "$subject", $comment, "From:" . $email)){

  	$response = array('response' => 'Your message was successful sent.<br/>We will get back with you soon!');

  }else{

  	$response = array('response' =>  'There was an error sending your email, please try again later.');

  }

	echo json_encode($response);

?>