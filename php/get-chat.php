<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
        date_default_timezone_set('Etc/GMT-1');

                if($row['outgoing_msg_id'] === $outgoing_id){


                    



                    if ($row['imageset']) {
                        $output .= '<div class="chat outgoing">
                        <div class="details">

                        <div class="rowimg" style="
                        display: flex;
                        align-items: flex-end;">
                        <a href="php/images/'.$row['imageset'].'">
                        <img src="php/images/'.$row['imageset'].'" alt="" style="min-height: 150px;
                        min-width: 150px;
                        border-radius: 8px; max-height: 325px;max-width: 255px"></a>
                        </div>
                            <div class="moment" style="text-align:end;font-size=10px;">
                        '.$row['moment'].'
                        </div>
                        </div>
                        
                        </div>';
                    }elseif ($row['msg']) {
                    $output .= '<div class="chat outgoing">

                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                <div class="moment">
                                '.$row['moment'].'
                                </div>
                                </div>
                                </div>';
                    }elseif ($row['msg'] ==="") {
                        $output .= '<div class="chat outgoing">
                                
                                <div class="details">
                                <div class="rowimg">
                                <img src="php/images/'.$row['imageset'].'" alt="">
                                </div>
                                    <div class="moment">
                                '.$row['moment'].'
                                </div>
                                </div>
                                
                                </div>';
                    }elseif (empty($row['imageset'])) {
                        $output .= '<div class="chat outgoing">

                                <div class="details">
                                </div>
                                
                                </div>';
                    }
                }else{



                    if ($row['imageset']) {
                        $output .= '<div class="chat incoming">
                        
                                <img src="php/images/'.$row['img'].'" alt="" class="img">
                                <div class="details">
                                <div class="rowimg" style="
                        display: flex;
                        align-items: flex-end;">
                        <a href="php/images/'.$row['imageset'].'" alt="image">
                        <img src="php/images/'.$row['imageset'].'" title="image" style="min-height: 250px;
                        min-width: 225px;
                        border-radius: 8px; max-height: 350px;max-width: 225px"></a>
                        </div>
                                    <div class="moment">
                                '.$row['moment'].'
                                </div>
                                </div>
                                
                                </div>';
                    }else{
                    $output .= '<div class="chat incoming">

                                <img src="php/images/'.$row['img'].'" alt="" class="img">
                                <div class="details">

                                    <p>'. $row['msg'] .'</p>
                                    <div class="moment">
                                '.$row['moment'].'
                                </div>
                                </div>
                                
                                </div>';
                    }
                }
            }
        }else{
            $output .= '<div class="text">Pas de message. Les nouveaux messages envoyés apparaitront ici.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>