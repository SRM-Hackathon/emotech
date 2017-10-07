<?php
session_start();
if(!isset($_SESSION['id'])){
	header('location: login.php');
}
include("module.php");
$admin=new Admin();
$page = $_SERVER['PHP_SELF'];
$sec = "1";
?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
	       <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
        <title>Chatbot</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">  
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
                <div class="panel-heading" style="">
	               	<div class="row">
	               		<div class="col-md-6 col-sm-6 col-xs-6">
	                   		<div style=" text-align: left; font-weight: 800; padding-left: 10px;margin-top: 8px; ">EMOTECH (ONLINE)</div>
	                   	</div>
	                   	<div class="col-md-6 col-sm-6 col-xs-6 settings" style="text-align: center;">
	                   		<i class="fa fa-volume-up" aria-hidden="true" style="padding: 4px;font-size: 18px;float: right;"></i>
                    		<i class="material-icons" id="video_call" style="padding: 4px;font-size: 18px;float: right;">video_call</i>
	                   		<?php
	                   		$result = $admin->view_profile($_SESSION['id']);
	                   		?>
	                   		Welcome, <?=$result['name']?>
	                   		<a href="logout.php"><button type="submit" class="btn btn-success">LogOut</button></a>
	                   	</div>
	               	</div>
				</div>

                <div class="col-md-9 col-sm-9 col-xs-9" style="padding: 0px;">
                    <div class="panel-body fixed-panel" id="response_cont">
                        <div id="chat"></div>
                        <?php 
                        $isCalling = $admin->isCalling();
                        ?>

                        <button onclick="myopn(<?=$isCalling['patient_mobile']?>)">Join to Patient</button>
                        <!--iframe marginwidth="0" marginheight="0" width="240" height="80" scrolling="no" frameborder=0 src="https://appr.tc/r/<?=$isCalling['patient_mobile']?>"></iframe--> 
                    </div>
                    <div class="panel-footer">
                        <form method="post" id="chatbot-form">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter Message" name="messageText" id="messageText" autofocus style="border-radius: 35px;padding: 22px;"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" id="chatbot-form-btn"><i class="fa fa-microphone" aria-hidden="true" id="microphone"></i>  <i class="fa fa-paper-plane" aria-hidden="true" id="send"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0px;">
                    <div class="room" style="height: 500px;line-height: 35px;">
                        <div class="col-sm-12" style="color: #000;border-bottom: 1px solid #fbf8f8;">
                            <div class="col-md-7 col-sm-7 col-xs-7"> <i class="fa fa-user" aria-hidden="true"></i> Ashu Mohanty</div>
                            <div class="col-md-5 col-sm-5 col-xs-5" style="text-align: right;">Available <i class="fa fa-circle" aria-hidden="true" style="color: #5cb85c;font-size: 9px;"></i></div>
                        </div>
                        <div class="col-sm-12" style="color: #000;border-bottom: 1px solid #fbf8f8;">
                            <div class="col-md-7 col-sm-7 col-xs-7"> <i class="fa fa-user" aria-hidden="true"></i> Rama Muduli</div>
                            <div class="col-md-5 col-sm-5 col-xs-5" style="text-align: right;">Available <i class="fa fa-circle" aria-hidden="true" style="color: #5cb85c;font-size: 9px;"></i></div>
                        </div>
                        <div class="col-sm-12" style="color: #000;border-bottom: 1px solid #fbf8f8;">
                            <div class="col-md-7 col-sm-7 col-xs-7"> <i class="fa fa-user" aria-hidden="true"></i> Trilochan Parida</div>
                            <div class="col-md-5 col-sm-5 col-xs-5" style="text-align: right;">Available <i class="fa fa-circle" aria-hidden="true" style="color: #5cb85c;font-size: 9px;"></i></div>
                        </div>
                        <div class="col-sm-12" style="color: #000;border-bottom: 1px solid #fbf8f8;">
                            <div class="col-md-7 col-sm-7 col-xs-7"> <i class="fa fa-user" aria-hidden="true"></i> Bibhuti Sahoo</div>
                            <div class="col-md-5 col-sm-5 col-xs-5" style="text-align: right;">Available <i class="fa fa-circle" aria-hidden="true" style="color: #5cb85c;font-size: 9px;"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script>
        $(function() {
            $('#chatbot-form-btn').click(function(e) {
                e.preventDefault();
                $('#chatbot-form').submit();
            });

            $('#chatbot-form').submit(function(e) {
                e.preventDefault();                
                var message = $('#messageText').val();
                $("#chat").append('<div class="req"><img src="img/chat-img.jpg"><div class="query">' + message + '</div></div></div>');
                $("#response_cont").animate({
            		scrollTop: $("#response_cont")[0].scrollHeight
            	}, "fast");
            	$('#messageText').val('');
            	
                $.ajax({
                    type: "POST",
                    url: "ask.php",
                    data: $(this).serialize(),
                    success: function(response)
                    {                        
                        //var answer = response.answer;
                        //const chatPanel = document.getElementById("chatPanel");
                        $("#chat").append('<div class="res"><img src="img/jini.png"><div class="response">' + response + '</div></div>');
						$("#response_cont").animate({
		            		scrollTop: $("#response_cont")[0].scrollHeight
		            	}, "fast");
		            	$('#messageText').val('');
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
        </script>
<script>
  $( function() {
    // run the currently selected effect
    $( "#effect" ).hide();
    $( "#button" ).click(function() {
		  $( "#effect" ).toggle( "blind", 500 );
		});
  } );
 </script>
  <script>
  	$(document).ready(function() {
  		$("#send").hide();
		$("#messageText").keyup(function()
		{
			if($("#messageText").val()=='')
			{
				$("#send").hide();
				$("#microphone").show();
			}
			else
			{
				$("#microphone").hide();
				$("#send").show();
			}
		});
	});
  </script>
    <script>
        function myopn(mobile)
        {
            window.open('https://appr.tc/r/'+mobile, 'Video Confrence', 'width=820,height=800,toolbar=0,location=0, directories=0, status=0, menubar=0');
        }
        </script>
    </body>
</html>