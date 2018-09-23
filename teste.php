 <?php include 'header.php'; ?>

           <style>  
           .file_drag_area  
           {  
                width:600px;  
                height:400px;  
                border:2px dashed #ccc;  
                line-height:400px;  
                text-align:center;  
                font-size:24px;  
           }  
           .file_drag_over{  
                color:#000;  
                border-color:#000;  
           }  
           </style>  
      </head>  
      <body>  
           <br />            
           <div class="container" style="width:700px;" align="center">  
                <h3 class="text-center">Drag and drop file upload using JQuery Ajax and PHP</h3><br />  
                <div class="file_drag_area">  
                     Drop Files Here  
                </div>  
                <div id="uploaded_file"></div>  
           </div>  
           <br />  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('.file_drag_area').on('dragover', function(){  
           $(this).addClass('file_drag_over');  
           return false;  
      });  
      $('.file_drag_area').on('dragleave', function(){  
           $(this).removeClass('file_drag_over');  
           return false;  
      });  
      $('.file_drag_area').on('drop', function(e){  
           e.preventDefault();  
           $(this).removeClass('file_drag_over');  
           var formData = new FormData();  
           var files_list = e.originalEvent.dataTransfer.files;  
           //console.log(files_list);  
            formData.append('file', files_list);  
           //console.log(formData);  
           $.ajax({  
                url:"upload.php",  
                method:"POST",  
                data:formData,  
                contentType:false,  
                cache: false,  
                processData: false,  
                success:function(data){  
                     $('#uploaded_file').html(data);  
                }  
           })  
      });  
 });  
 </script>  