<?php

$conn= mysqli_connect('localhost','root',"",'ajax_crud');

extract($_POST); //extract function import variables from an array into the current symbol table

if (isset($_POST['readrecord'])){

    $data='<table class="table table-bordered table-striped">
            <tr>
                <th>No.</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Edit Action</th>
                <th>Delete Action</th>
               
            </tr>';

        $display_query = "SELECT * FROM `crud_table`";
        $result= mysqli_query($conn, $display_query);

        if(mysqli_num_rows($result)> 0){
            $number=1;
            while($row = mysqli_fetch_array($result)){

                $data .='<tr>
                            <td>'.$number.'</td>
                            <td>'.$row['firstname'].'</td>
                            <td>'.$row['lastname'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['mobile'].'</td>
                            <td>
                                <button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning">Edit<button> 
                            </td>
                            <td><button onclick="DeleteUser('.$row['id'].')" class="btn btn-warning">Delete<button></td>
                        </tr>';
                        $number++;
                }

            }
            $data.='</table>';
            echo $data;
        }
            

if(isset($_POST['firstname'] ) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile'])){

  echo  $query="INSERT INTO `crud_table`( `firstname`, `lastname`, `mobile`, `email`) VALUES ('$firstname','$lastname','$mobile','$email')";
    mysqli_query($conn,$query);
}

//delete user records 

if (isset($_POST['deleteid'])){

    $userid = $_POST['deleteid'];
    $deletequery="DELETE FROM `crud_table` WHERE id=$userid";
    mysqli_query($conn,$deletequery);
}

//get user id for update


if(isset($_POST['id']) &&  isset($_POST['id'])!="")
{
    $user_id = $_POST['id'];
    $query= "SELECT * FROM crud_table WHERE id = '$user_id'";
    if(!$result= mysqli_query($conn, $query)){
        exit(mysqli_error());
    }

    $response = array();

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $response = $row;
        }
    }else{
        $response['status'] = 200;
        $response['message'] = "Data not found";

    }
    echo json_encode($response);
} else{
    $response['status'] = 200;
    $response['message'] = "Invalid";

}

/////update table

if(isset($_POST['hidden_user_idupd'])){

    $hidden_user_idupd=$_POST['hidden_user_idupd'];
    $firstnameupd=$_POST['firstnameupd'];
    $lastnameupd=$_POST['lastnameupd'];
    $emailupd=$_POST['emailupd'];
    $mobileupd=$_POST['mobileupd'];

    $query="UPDATE `crud_table` SET `firstname`='$firstnameupd',`lastname`='$lastnameupd',`email`='$emailupd',`mobile`='$mobileupd' WHERE id='$hidden_user_idupd'";
    mysqli_query($conn,$query);

}

?>