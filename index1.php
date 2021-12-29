<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
</head>
<body>
    <div class="container">
        <h1 class="text-primary text-uppercase text-center">AJAX CRUD OPERATION</h1>


        <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Sign- Up</button>
        </div>
        <h2 class="text-danger">All Records</h2>
        <div id="records_contant">
        </div>
                    <!-- The Modal -->
            <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ajax Crud Operation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Firstname:</label>
                        <input type="text" name="" id="firstname" class="form-control" placeholder="Enter Firstname">
                    </div>
                    <div class="form-group">
                        <label>Lastname:</label>
                        <input type="text" name="" id="lastname" class="form-control" placeholder="Enter lastname">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="" id="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Mobile No:</label>
                        <input type="number" name="" id="mobile" class="form-control" placeholder="Enter mobile no">
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="addRecord()" data-dismiss="modal">Save</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
            </div>

            <!--update modal-->
            <div class="modal" id="update_user_modal">
            <div class="modal-dialog">
                <div class="modal-content">

            
            <div class="modal-body">
                    <div class="form-group">
                        <label>Firstname:</label>
                        <input type="text" name="" id="update_firstname" class="form-control" placeholder="Enter Firstname">
                    </div>
                    <div class="form-group">
                        <label>Lastname:</label>
                        <input type="text" name="" id="update_lastname" class="form-control" placeholder="Enter lastname">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="" id="update_email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Mobile No:</label>
                        <input type="number" name="" id="update_mobile" class="form-control" placeholder="Enter mobile no">
                    </div>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="updateuserdetail()" data-dismiss="modal">Update</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="hidden" name="" id="hidden_user_id">
                </div>
        </div>
    </div>
</div>

</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script type="text/javascript">

            $(document).ready(function(){
                readRecords();

            });

            function readRecords(){
                var readrecord= "readrecord";
                $.ajax({
                    url: "backend1.php",
                    type:"post",
                    data:{ readrecord: readrecord },
                    success: function(data, status){
                        $('#records_contant').html(data);
                    }

                });
            }

            function addRecord(){
                var firstname  = $('#firstname').val();
                var lastname  = $('#lastname').val();
                var email  = $('#email').val();
                var mobile  = $('#mobile').val();

           
            $.ajax({
                url: "backend1.php",
                type:'post',
                data:{ firstname: firstname,
                        lastname: lastname,
                        email: email,
                        mobile: mobile

                
                },
                success: function(data,status){
                    readRecords();
                }
            });
        }


        //Delete records function getting called

        function DeleteUser(deleteid){
            var conf = confirm("Are you sure you want to delete");
            
            if(conf== true){

            $.ajax({
                url:"backend1.php",
                type:"post",
                data: {deleteid:deleteid},
                success: function(data,status){
                    readRecords();

                }
            });
         }
        }
        // edit details function

        //in post -> 3 parameter url,data,callback

        function GetUserDetails(id){

            $('#hidden_user_id').val(id);

            $.post("backend1.php",{
                id:id
            },function(data,status){
                var user = JSON.parse(data);

                var user= JSON.parse(data);
                $('#update_firstname').val(user.firstname);
                $('#update_lastname').val(user.lastname);
                $('#update_email').val(user.email);
                $('#update_mobile').val(user.mobile);
                

            }
            
            );

            $('#update_user_modal').modal("show");


        }


        function updateuserdetail(){
            var firstnameupd = $('#update_firstname').val();
            var lastnameupd = $('#update_lastname').val(); 
            var emailupd = $('#update_email').val();
            var mobileupd = $('#update_mobile').val();

            var hidden_user_idupd = $('#hidden_user_id').val();

            $.post("backend1.php",{
                hidden_user_idupd:hidden_user_idupd,
                firstnameupd:firstnameupd,
                lastnameupd:lastnameupd,
                emailupd:emailupd,
                mobileupd:mobileupd,
            },

            //to hide after save
            function(data,status){
                $('#update_user_modal'.modal("hide"));
                readRecords();
               
            });
        }


        </script>
</body>
    </html>