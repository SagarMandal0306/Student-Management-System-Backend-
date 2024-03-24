<?php

include "header.php";
$user_data=json_decode(file_get_contents("php://input"));

if($user_data !=null){
    if(isset($user_data->st_id) && isset($user_data->email) && isset($user_data->pass)  ){
        $stid=mysqli_real_escape_string($conn,$user_data->st_id);
        $email=mysqli_real_escape_string($conn,$user_data->email);
        $pass=mysqli_real_escape_string($conn,$user_data->pass);
        

        if($stid != "" || $email != "" || $pass != "" ){
           
            $f_query=mysqli_query($conn,"select * from student where student_id=$stid");
            
            
            if(mysqli_num_rows($f_query)>0){
            $row=mysqli_fetch_array($f_query);
           
            $profile_id=$row['profile_id'];
                $s_query=mysqli_query($conn,"select * from login where profile_id=$profile_id and email='$email'");
                if(mysqli_num_rows($s_query)>0){
                    $t_query=mysqli_query($conn,"select * from login where profile_id=$profile_id and email='$email' and password='$pass'");
                    if(mysqli_num_rows($t_query)>0){

                        echo json_encode(array("status"=>"Successfully Login"));
                    }else{
                        echo json_encode(array("status"=>"Password is incorrect"));
                    }
                }else{
                    echo json_encode(array("status"=>"Email is does not exist"));
                }
            }else{
                echo json_encode(array("status"=>"You Enter Wrong Student Id"));
            }
        }else{
            echo json_encode(array("status"=>"compulsory to write all fields"));   
        }
    }else{
        echo json_encode(array("status"=>"Incomplete data provided"));
    }

}else{
    echo json_encode(array("status"=>"No Data found"));
}