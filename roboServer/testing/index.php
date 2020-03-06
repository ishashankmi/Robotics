<?php 
    $con=mysqli_connect('localhost','sammy','hellow','test_db');
    if($con){
        $qu=mysqli_query($con,"SELECT * FROM icrc");
        if(mysqli_num_rows($qu)>0){
            $fet=mysqli_fetch_assoc($qu);
            $res=$fet['lights'];
            $auto=$fet['automation'];
            if($res==0){
                $val="<div id='light' value='1' class='uns btn'>LIGHT OFF</div>";
            }else if($res==1){
                $val="<div id='light' value='0' class='uns btn'>LIGHT ON</div>";
            };

            if($auto==0){
                $divAuto="<div id='auto' class='uns btn' value='1'>AUTO OFF</div>";
            }else if($auto==1){
                $divAuto="<div id='auto' class='uns btn' value='0'>AUTO ON</div>";
            }

        }
    }
?>
<!doctype html>
<html>
<head>
    <title>HEY</title>
    <style>
    *{margin:0;padding:0;font-size:23px}
.uns{-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}
#bod{height:50px}
div{display:inline-block}
.btn{border:1px solid #000;padding:5px;border-radius:5px 5px 5px 5px}
#everything{position:relative;top:65px;left:80px}
#inright{position:relative;left:150px}
#lights{position:relative;top:110px;left:170px}
#automation{position:relative;top:70px;left:500px}
#testing{position:relative;top:8px;left:210px;font-size:14px;padding:1px;color:red;border-radius:3px 3px 3px 3px}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body id='bod'>
    <div id='testing' class='uns'>PLEASE ROTATE YOUR PHONE FOR THE BEST CONTROLLER UI</div>
    <div id='everything'>
        <div id='forward' class='uns btn'>FORWARD</div>
        <span>&nbsp;&nbsp;</span>
        <div id='backward' class='uns btn'>BACKWARD</div>
        <div id='inright'>
            <div id='left' class='uns btn'>LEFT</div>
            <span>&nbsp;&nbsp;</span>
            <div id='right' class='uns btn'>RIGHT</div>
        </div>
    </div>
    <br/><br/><br/>
    <div id='lights'>
        <?php 
            echo $val;
        ?>
    </div>
    <br/>
    <div id='automation'>
        <?php 
            echo $divAuto;
        ?>
    </div>
    <script>
        'use strict';

        var res=0;
        var xa;
        function ajax(){
            var xhr;
            if(window.XMLHttpRequest){
                xhr=new window.XMLHttpRequest();
            }else{
                xhr=new window.ActiveXObject('MicrosoftXMLHttp');
            }
            return xhr;
        };

        function sending(val){
            var xhr=ajax();
            xhr.onreadystatechange=function(){
                if(this.readyState==4 && this.status==200){
                    //document.getElementById('testing').innerHTML=this.responseText;
                    console.log('working!!');
                };
            };
            xhr.open('post','fet.php');
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhr.send("btn=btn&value="+val);
        };


        function lianauto(type,stype,value){
            var xhr=ajax();
            xhr.onreadystatechange=function(){
                if(this.readyState==4 && this.status==200){
                    //document.getElementById('testing').innerHTML=this.responseText;
                    location.reload();
                };
            };
            xhr.open('post','fet.php');
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhr.send(type+"="+type+"&"+stype+"="+value);
        };


        var every=document.getElementById('everything').getElementsByTagName('div');

        for(var x=0;x<every.length;x++){
            every[x].ontouchstart=function(event){
                var senval=0;
                event.stopPropagation();
                if(this.getAttribute('id')=='forward'){
                    senval=1;
                }else if(this.getAttribute('id')=='backward'){
                    senval=2;
                }else if(this.getAttribute('id')=='left'){
                    senval=3;
                }else if(this.getAttribute('id')=='right'){
                    senval=4;
                };
                sending(senval);
            };

            every[x].ontouchend=function(event){
                event.stopPropagation();
                sending(0);
            };
        };
        document.getElementById('light').onclick=function(){
            var val=this.getAttribute('value');
            lianauto('lights','light',val);
        }
        document.getElementById('auto').onclick=function(){
            var val=this.getAttribute('value');
            lianauto('automation','autox',val);
        }
    </script>
</body>
</html>