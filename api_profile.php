<?php

include_once "header.php";

$data=json_decode(file_get_contents("php://input"));

if($data != null){
    if(isset($data->st_id)){
        $st_id=mysqli_real_escape_string($conn,$data->st_id);
        $query=mysqli_query($conn,"select * from student  where student_Id =$st_id ");
        $row=mysqli_fetch_array($query);

        $arr=array(
            "name"=>$row['name'],
            "enroll_no"=>$row['enroll_no'],
            "class"=>$row['standard'],
            "roll_no"=>$row['student_Id'],
            "dept"=>$row['department'],
            "email"=>$row['email'],
            "con"=>$row['mobile_no'],
            "add"=>$row['address']
        );

        echo json_encode($arr);
    }
}else{
    echo json_encode("No data found");
}

