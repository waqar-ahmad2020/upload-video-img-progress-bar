<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
    /* Container */
    .container{
       margin: 0 auto;
       border: 0px solid black;
       width: 50%;
       height: 250px;
       border-radius: 3px;
       background-color: ghostwhite;
       text-align: center;
    }
    /* Preview */
    .preview{
       width: 400px;
       height: 400px;
       border: 1px solid black;
       margin: 0 auto;
       background: white;
       margin-top: 60px;
    }

    .preview img{
       display: none;
    }
    /* Button */
    .button{
       border: 0px;
       background-color: deepskyblue;
       color: white;
       padding: 5px 15px;
       margin-left: 10px;
    } .myprogress{background-color: #000; color: #fff;} video { width: 400px; height: 400px; }
  </style>
</head>
<body>
<div class="container"><div class="progress">
                            <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                        </div>
    <form method="post" action="" enctype="multipart/form-data" id="myform">
                <div >
            <input type="file" id="file" name="file" />
            <input type="button" class="button" value="Upload" id="but_upload">
        </div>
    </form> <div class='preview' width="300" height="300">
            
        </div>

</div>
<script src="jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $("#but_upload").click(function(){

        var fd = new FormData();
        var files = $('#file')[0].files;
        
        // Check file selected or not
        if(files.length > 0 ){
           fd.append('file',files[0]);

           $.ajax({
              url: 'upload-video.php',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              xhr: function () {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function (evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;
                                    percentComplete = parseInt(percentComplete * 100);
                                    $('.myprogress').text(percentComplete + '%');
                                    $('.myprogress').css('width', percentComplete + '%');
                                }
                            }, false);
                            return xhr;
                        },
              success: function(response){
                 if(response != 0){
                    var video = document.createElement('video'); video.src=response; $(".preview").html(video); video.play();
                 }else{
                    alert('file not uploaded');
                 }
              },
           });
        }else{
           alert("Please select a file.");
        }
    });
});

</script>
</body>
</html>