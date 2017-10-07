<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chatbot</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <link href="bot.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <style>
			img{width: 100px;}
			.room{cursor: pointer;height: 500px;
			    background-color: #fff;}
            .form-control {border-radius: 15px;}
            .response_text li{
                list-style: none;
            }
            .btn-warning {
                color: #fff;
                background-color: #f0ad4e;
                border-color: #09c1b2;
            }
        </style>
        <link href="style.css" rel="stylesheet">
    </head>
	<body>
        <div class="background-color: rgb(255,0,255);">
            <div>
                <img src="emotech.png" style="width: 40%; margin: 2% 20%;">
            </div>
            <div id="chat">
                <div id="chat_head">  
                    <img src="1.png" style="width: 25px;"> EmoTech (Online)
                    <span id="button" title="Setting"><i class="fa fa-cog" aria-hidden="true" style="padding: 4px;font-size: 18px;float: right;"></i>
                    <ul><li><a href="#">English</a></li>
                    <li><a href="#">Hindi</a></li></ul>
                    </span>
                    <i class="material-icons" title="Wallet" style="padding: 4px;font-size: 18px;float: right;">account_balance_wallet</i>
                    <i onclick="myopn()" class="material-icons" style="padding: 4px;font-size: 18px;float: right;">video_call</i>
                    <a href="tel: +919040660463" style="color: #fff;"><i class="fa fa-phone" aria-hidden="true" style="padding: 4px;font-size: 18px;float: right;"></i></a>
                </div>
                <div id="response_cont">
                    <div id="intro">Please enter below details for future assistance 
                        <form method="post" onsubmit="return checkCookie(this)">
                            <input type="text" class="textd" name="username" id="username" required placeholder="Enter Name">
                            <input type="text" class="textd" name="mobile" id="mobile" required placeholder="Enter Mobile No."> 
                            <input type="text" class="textd" name="age" id="age" required placeholder="Enter Age">
                            <button type="submit" class="btn">Submit</button>
                        </form>
                    </div>
                    <div id="response"></div>
                </div>
                <div id="input_con">
                    <div style="float: left;">
                    <input id="input" type="text" placeholder="Chat here..." style="width: 220px;">
                    </div>
                    <div>
                        <form method="post" id="upload_form" enctype="multipart/form-data">
                            <button class="rec" id="upload_file" type="button"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
                            <input type="file" name="my_files" id="my_file" style="display: none;" />          
                            <button id="rec" type="button"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="bot.js"></script>

        <script>
        function myopn()
        {
            videoCalling();
            var mobile=getCookie("mobile");
            window.open('https://appr.tc/r/'+mobile, 'Video Confrence', 'width=820,height=800,toolbar=0,location=0, directories=0, status=0, menubar=0');
        }
        </script>
        <script>
        $("#upload_file").click(function() {
          $("#my_file").click();
        });
        
        $("#my_file").change(function(){
            var file_data = $(this).prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            $.ajax({
                url: "upload_preception.php",
                dataType: 'script',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(){
                }
            });                     
           readURL(this);
        });

        function readURL(input)
        {
            if(input.files && input.files[0]) 
            {
                var reader = new FileReader();
                reader.onload = function (e)
                {
                    var image = e.target.result;
                    $('#response').append('<div class="response_text" style="padding: 2px;"><img id="blah" src="'+image+'" /><div>');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        </script>
</html>