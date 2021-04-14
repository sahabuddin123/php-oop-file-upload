<?php
include_once('./config/db.php');
include_once('./config/fileupload.php');
if($dbh){
    $sql = "INSERT INTO `student`(`name`, `email`, `phone`, `password`, `image`) VALUES (?,?,?,?,?)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $_REQUEST['name']);
    $stmt->bindParam(2, $_REQUEST['email']);
    $stmt->bindParam(3, $_REQUEST['phone']);
    $password = md5($_REQUEST['password']);
    $stmt->bindParam(4, $password);
    $uploadFiles = new upload();
    $uploadFiles->setFunctionVal();
    $stmt->bindParam(5, $uploadFiles->uploadfile);
    if($uploadFiles->uploadFile()){
        if($stmt->execute()){
            echo "Insert Success";
        }
        else{
            echo "Inset Fail";
        }
    }
    else{
        echo "File Upload Fail";
    }
    
}
else{
    echo "Database Connectionn Fail";
}