<?php
session_start();
require 'connection.php';
require 'vendor/autoload.php';

//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
if(isset($_POST['submit'])){
    $file_extensions = ['xls','csv','xlsx'];
    $file_name = $_FILES['import_file']['name'];
    
    //$file_name = strval($file_name);
    
    $check = explode(".",$file_name);
    $file_ext = end($check);
    if(in_array($file_ext,$file_extensions)){
        $targetPath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach($data as $row){
            $name = $row[0];
            $email = $row[1];
            $age = $row[2];
            $phone = $row[3];
            $check_query = "select email from student where email='$email'";
            $res = mysqli_query($con,$check_query);
            if(mysqli_num_rows($res)){
                $update = "update student set
                 name='$name',email='$email',age='$age',phone='$phone' where email='$email'";
                if(mysqli_query($con,$update)){
                    $_SESSION['status'] = "Updated Successfully !";
                    header("Location: index.php");
                }
                
            }
            else{
              
                $insert = "INSERT INTO student(name,email,age,phone) VALUES ('$name','$email','$age','$phone')";
                    if(mysqli_query($con,$insert)){
                        $_SESSION['status'] = "Inserted Sucessfully !";
                        header(("Location: index.php"));
                    }
            }
        }
        
    }

    else{
        $_SESSION['status'] = "invalid file extension";
        header("Location: index.php");
        exit(0);
    }
}

?>