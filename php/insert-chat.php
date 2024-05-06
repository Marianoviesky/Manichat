<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        date_default_timezone_set('Etc/GMT-1');
        $time = date('H:i');
        $toda = date("d M Y");
        $today = strtotime($toda);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, moment, msg,date_field)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$time}', '{$message}', '{$today}')") or die();
        }
        elseif(!empty($_FILES['file'])){
            $file = $_FILES['file']['name'];
            $file_name = $_FILES['file']['tmp_name'];
            $tim = time();
            $file_send = $tim.$file;
            move_uploaded_file($file_name,"images/".$file_send);
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, moment, imageset,date_field)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$time}', '{$file_send}', '{$today}')") or die();
            
        } elseif(!empty($message) && !empty($file)){ 
            $file = $_FILES['file']['name'];
            $file_name = $_FILES['file']['tmp_name'];
            $tim = time();
            $file_send = $tim.$file;
            move_uploaded_file($file_name,"images/".$file_send);
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, moment, msg, imageset, date_field)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$time}','{$message}','{$file_send}', '{$today}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>