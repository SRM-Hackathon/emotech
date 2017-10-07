<?php
ini_set( 'session.use_only_cookies', TRUE );				
ini_set( 'session.use_trans_sid', FALSE );
session_start();
session_regenerate_id();
if(isset($_SESSION['id'])){
	header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chatbot</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        
        <style>
        	div.scrollmenu {
			    overflow: auto;
			    white-space: nowrap;
			    width: 500px;
			}
			img{width: 100px;}
			.room{cursor: pointer;height: 180px;
			    background-color: #fff;}
        </style>
        <link href="style.css" rel="stylesheet">
    </head>
	<body>
        <div class="background-color: rgb(255,0,255);">
            <div class="panel panel-info" style="border: none;">
                <div class="panel-body fixed-panel" id="response_cont">
                	<div id="chat"></div>
                					        
	                    <div class="col-md-12 col-sm-12 col-xs-12">
	                    		<div class="modal fade in" id="loginn" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" style="margin-top: 50px; display: block; padding-right: 17px;">
							    <div class="modal-dialog modal-md">
							        <div class="modal-content">
							            <div class="modal-header">
							                <h4 class="modal-title" id="myModalLabel" style="color: #565656;"> Login Your Account</h4>
							            </div>
							            <div class="modal-body">
							                <div class="row">
							                    <div class="col-md-12" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;">
							                        <div class="tab-content" id="login_verification">
							                            <form role="form" id="login" method="post" class="form-horizontal">
							                                <div class="form-group">
							                                    <label for="email" class="col-sm-2 control-label" style="color: #565656;"> Email</label>
							                                    <div class="col-sm-10">
							                                        <input type="text" id="email" class="form-control" placeholder="Email" required="">
							                                    </div>
							                                </div>
							                                <div class="form-group">
							                                    <label for="exampleInputPassword1" class="col-sm-2 control-label" style="color: #565656;"> Password</label>
							                                    <div class="col-sm-10">
							                                        <input type="password" id="password" class="form-control" placeholder="password" required="">
							                                    </div>
							                                </div>
							                                <div class="row">
							                                    <div class="col-sm-2">
							                                    </div>
							                                    <div class="col-sm-10">
							                                        <button type="submit" class="btn btn-primary btn-sm">
							                                            Submit</button>
							                                        <a href="javascript:;">Forgot your password?</a>
							                                    </div>
							                                </div>
							                                <div id="error1"></div>
							                                </form>
							                        </div>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
							</div>
	                    </div>
	               
                </div>
            </div>
        </div>
        <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script>

	$("#login").submit(function( event ){
	var email = $("#email").val();
	var password = $("#password").val();
	$.ajax({
   	type:'POST',
   	url :'function.php',
   	data:{
      'email'	 	: email,
      'password' 	: password
   	},
   	success:function(result)
   	{
			console.info(result);

			if(result=="success")
			{
				window.location.href = "index.php";
			}
			else
			{
				$("#error1").html('You have entered wrong Information.');
			}
   	},
   	error: function (exception) {
    	console.log(exception);
  	} 	
  });
  event.preventDefault();	
  });
</script>
    </body>
</html>