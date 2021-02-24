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
       width: 100px;
       height: 100px;
       border: 1px solid black;
       margin: 0 auto;
       background: white;
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
    } .myprogress{background-color: #000; color: #fff;}
  </style>
</head>
<body>
<div class="container"><div class="progress">
                            <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                        </div>
    <form method="post" action="" enctype="multipart/form-data" id="myform">
        <div class='preview'>
            <img src="" id="img" width="100" height="100">
        </div>
        <div >
            <input type="file" id="file" name="file" />
            <input type="button" class="button" value="Upload" id="but_upload">
        </div>
    </form>
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
              url: 'img-upload.php',
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
                    $("#img").attr("src",response); 
                    $(".preview img").show(); // Display image element
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