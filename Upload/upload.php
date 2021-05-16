<?php
session_start();

$song_name_u = '';
$singer_name_u = '';
$album_name_a_u='';
$singer_name_a_u='';
$album_name = '';
$file_song = '';
$update = false;
$update_album = false;
$id = 0;

$severname = "localhost";
$dbUserName = "root";
$dbPassword = "123456";
$dbName = "nguoi_dung";
$conn = mysqli_connect($severname, $dbUserName, $dbPassword, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} //else
    //echo "Connect suscc";
//tao cac file thanh mang
$sql_album = "select * from Album";
$result_album = mysqli_query($conn, $sql_album);

while ($row_album = mysqli_fetch_array($result_album, MYSQLI_ASSOC)) {
    $image[] = $row_album["image_name"];
}
//echo json_encode($image);

$query = "SELECT * FROM Album";
$result2 = mysqli_query($conn, $query);

$options = "";

while ($row2 = mysqli_fetch_array($result2)) {
    $options = $options . "<option>$row2[1]</option>";
}
// CHO VUI NE`

//tao cac file nhac thanh mang
$sql_song = "select * from song";
$result_song = mysqli_query($conn, $sql_song);

while ($row_song = mysqli_fetch_array($result_song, MYSQLI_ASSOC)) {
    $song[] = $row_song["file_song_name"];
}
//echo json_encode($song);

$query_song = "SELECT * FROM song";
$result_song = mysqli_query($conn, $query_song);

$option_song = "";
while ($row3 = mysqli_fetch_array($result_song)) {
    $option_song = $option_song . "<option>$row3[1]</option>";
}

// nut them album trc
if (isset($_POST['submit_album'])) {
    $album_name = mysqli_real_escape_string($conn, $_REQUEST['album_name_a']);
    $singer_name = mysqli_real_escape_string($conn, $_REQUEST['singer_name_a']);
    $image_name = "img/";
    $image_name = $image_name . mysqli_real_escape_string($conn, $_REQUEST['image_avt_a']);
    $sql_ins_album = "insert into album (album_name, singer_name, image_name) values('$album_name','$singer_name','$image_name')";

    if (mysqli_query($conn, $sql_ins_album)) {
        $_SESSION['message'] = "Album $album_name cua $singer_name da duoc them";
        $_SESSION['msg_type'] = "success";
        header("/upload.php");
    } else {
        echo "ERROR: Khong them duoc $sql_ins_album." . mysqli_error($conn);
    }
}
if(isset($_GET['submit_music'])){
  
    echo json_decode($album_albumID);
}
// nut them nhac sau
if (isset($_POST['submit_music'])) {
    $song_name = mysqli_real_escape_string($conn, $_REQUEST['song_name']);
    $singer_name = mysqli_real_escape_string($conn, $_REQUEST['singer_name']);
    $album_name = mysqli_real_escape_string($conn, $_REQUEST['album_name']);
    $sql_getAlbumID = "select albumID from nguoi_dung.album where album_name='$album_name'";
    $resultAlbumID = mysqli_query($conn,$sql_getAlbumID);
    $row = $resultAlbumID->fetch_assoc();
    $album_albumID = $row["albumID"];
    $file_song = "mp3/";
    $file_song = $file_song . $_FILES['music_name']['name'];
    $sql_ins_song = "insert into song (song_name, singer_name, album_name,file_song_name,album_albumID) values('$song_name','$singer_name','$album_name','$file_song','$album_albumID')";
    if (mysqli_query($conn, $sql_ins_song)) {
        $_SESSION['message'] = "Thong tin bai hat $song_name - $singer_name da duoc them";
        $_SESSION['msg_type'] = "success";
        header("/upload.php");
    } else {
        echo "ERROR: Khong them duoc $sql_ins_song." . mysqli_error($conn);
    }
   
}
//Nut xoa nhac
if (isset($_GET['delete'])) {
    $songID = $_GET['delete'];
    $sql_delete = "delete from nguoi_dung.song where songID=$songID";
    if (mysqli_query($conn, $sql_delete)) {
        $_SESSION['message'] = "Thong tin bai hat da bi xoa";
        $_SESSION['msg_type'] = "danger";
        header("/upload.php");
    } else {
        echo "ERROR: Khong xoa duoc $sql_delete." . mysqli_error($conn);
    }
}
// Nut xoa album
if (isset($_GET['delete_album'])) {
    $albumID = $_GET['delete_album'];
    $sql_delete_album = "delete from nguoi_dung.album where albumID = $albumID";
    if (mysqli_query($conn, $sql_delete_album)) {
        $_SESSION['message'] = "Album da duoc xoa thanh cong";
        $_SESSION['msg_type'] = "danger";
        header("/upload.php");
    } else {
        echo "ERR: Cant delete $sql_delete_album." . mysqli_error($conn);
    }
}
// Cai nay la edit no show ban ghi trong database len ne`
if (isset($_GET['edit'])) {

    $songID = $_GET['edit'];
    $update = true;
    $sql_select_song_update = "select * from nguoi_dung.song where songID = $songID";
    $run = mysqli_query($conn, $sql_select_song_update);
    
    if ($run && count((array)$run) === 1) {
        $row = mysqli_query($conn, $sql_select_song_update)->fetch_array();
        $song_name_u = $row[1];
        $singer_name_u = $row[2];
        $album_name_u = $row[3];
        $file_song_u = $row[4];
    }
    //echo json_encode($run);
}

// Tuong tu show ban ghi trong database len nhung ma o trong album
if (isset($_GET['edit_album'])) {

    $albumID = $_GET['edit_album'];
    $update_album = true;
    $sql_select_album_update = "select * from nguoi_dung.album where albumID = $albumID";
    $run_album = mysqli_query($conn, $sql_select_album_update);
    if ($run_album && count((array)$run_album) === 1) {
        $row = mysqli_query($conn, $sql_select_album_update)->fetch_array();
        $album_name_a_u = $row['album_name'];
        $singer_name_a_u = $row[2];
        $image_name_a_u = $row[3];
    }
}
// cai nay la update music function 
if (isset($_POST['update_music'])) {
    $song_name_u_r = $_POST['song_name'];
    $singer_name_u_r = $_POST['singer_name'];
    $album_name_u_r = $_POST['album_name'];
    $file_song_u_r = "mp3/";
    $file_song_u_r = $file_song_u_r . $_FILES['music_name']['name'];

    $sql_s_e = "update nguoi_dung.song set song_name = '$song_name_u_r', singer_name ='$singer_name_u_r', album_name = '$album_name_u_r', file_song_name = '$file_song_u_r' where songID = $songID ";
    if (mysqli_query($conn, $sql_s_e)) {
        $_SESSION['message'] = "Bai hat da duoc sua thanh $song_name_u_r";
        $_SESSION['msg_type'] = "warning";
        header("/upload.php");
    } else {
        echo "ERror : Cant edit $sql_s_e." . mysqli_error($conn);
    }
}
// update album 
if (isset($_POST['update_album'])) {
    $album_name_u_r = $_POST['album_name_a'];
    $singer_name_u_r = $_POST['singer_name_a'];
    $image_name_u_r = "img/";
    $image_name_u_r = $image_name_u_r . mysqli_real_escape_string($conn, $_REQUEST['image_avt_a']);

    $sql_a_e = "update nguoi_dung.album set album_name = '$album_name_u_r', singer_name ='$singer_name_u_r', image_name = '$image_name_u_r' where albumID = $albumID ";
    if (mysqli_query($conn, $sql_a_e)) {
        $_SESSION['message'] = "Album da duoc sua thanh $album_name_u_r cua $singer_name_u_r";
        $_SESSION['msg_type'] = "warning";
        header("/upload.php");
    } else {
        echo "ERror : Cant edit $sql_a_e." . mysqli_error($conn);
    }
}

// if(isset($_GET['image_name'])){
//     $image_name = $_GET['image_name'];
//     $sql = "Select * from Album where image_name = $image_name";
//     $result = mysqli_query($conn,$sql);

//     $options = "";

//     while($row = mysqli_fetch_array($result))
//     {
//         $options = $options."<option>$row[1]</option>";
//     }
//     if($result = mysqli_query($conn,$sql)){
//         if(mysqli_num_rows($result)>0){
//             while($row = mysqli_fetch_array($result)){
//                 $dbSelected = $row["image_name"];
//             }
//         }
//         else{
//             echo"Error and die link";
//         }
//     }
//     else{
//         echo"ERROR: Could not execute $sql." .mysql_error($conn); 
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        table {
            width: 100%;
            background-color: #FFFFFF;
            border: solid 2px #6D7B8D;
            padding: 5px;
            table-layout: fixed;
        }

        .banner {
            height: 30px;
            background-color: #476444;
            color: #FFFFFF;
            border: solid 1px #659EC7;
        }

        .info_song {
            border: solid 1px #659EC7;
            padding: 5px;
            table-layout: fixed;
            color: #9F000F;
            text-align: center;
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php
    $song_name = '';
    $singer_name = '';
    $album_name = '';
    $music_name = '';
    if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">

            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>

        </div>
    <?php endif ?>
    <div id="uploadMusic">
        <table id="tblContainer">
            <form method="POST" enctype="multipart/form-data">
                <tr>
                    <td colspan="2">
                        <table id="table1" cellpadding="2" cellspacing="2" style="width: 100%;">
                            <tr style="height: 30px; background-color:#6cb137 ; color:#FFFFFF ;border: solid 1px #659EC7;">
                                <td>
                                    <h3 style="text-align: center;"> Add music, Upload Music</h3>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <form>
                                        <table style="color:#9F000F;font-size:large" cellpadding="4" cellspacing="6" style="width: 100%;">
                                            <tr>
                                                <td>
                                                    <b>Song Name : </b>
                                                </td>
                                                <td>
                                                    <input type="text" name="song_name" value="<?php echo $song_name_u ?>" placeholder="Song Name" required />
                                                    <br />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Singer Name : </b>
                                                </td>
                                                <td>
                                                    <input type="text" name="singer_name" value="<?php echo $singer_name_u ?>" placeholder="Singer Name" required />
                                                    <br />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b> Album Name: </b>
                                                </td>
                                                <td>
                                                    <select name="album_name" id="" value="<?php echo $album_name_u ?>">
                                                        <?php echo $options; ?>
                                                    </select>
                                                    <br />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Music file upload : </b>
                                                </td>

                                                <td>
                                                    <input type="file" name="music_name" value="<?php echo $file_song_u ?>" required>
                                                    <br />
                                                </td>
                                            <tr>
                                            <tr>
                                                <td colspan="2">
                                                    <?php
                                                    if ($update == true) :
                                                    ?>
                                                        <input type="submit" name="update_music" value="Update Musics" style="background-color:#1be959;color:#4d4444;margin: 10px 0px 10px 650px;height: 60px;" name="update_music" required />
                                                    <?php else : ?>
                                                        <input type="submit" name="submit_music" value="Save Musics" style="background-color:#e20952;color:#FFFFFF;margin: 10px 0px 10px 650px;height: 60px;" name="save_music" required />
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </form>
            <tr>
                <td colspan="2">

                    <table style="width: 100%; background-color:#FFFFFF; border: solid 2px #6D7B8D; padding: 5px;table-layout:fixed;" cellpadding="2" cellspacing="2">

                        <tr style="height: 30px; background-color:#476444 ; color:#FFFFFF ;border: solid 1px #659EC7;">
                            <td width="40" align="center"><b>Edit</b></td>
                            <td width="40" align="center"><b>Delete</b></td>
                            <td width="100" align="center"><b>Song Name</b></td>
                            <td width="100" align="center"><b>Singer Name </b></td>
                            <td width="120" align="center"><b>Album Name</b></td>
                            <td width="120" align="center"><b>Song File</b></td>
                        </tr>
                        <?php

                        $conn = mysqli_connect("localhost", "root", "123456", "nguoi_dung");
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }



                        $sql_select_song = "select * from nguoi_dung.song";
                        $result_select_song = $conn->query($sql_select_song);
                        if ($result_select_song->num_rows > 0) {
                            while ($row = $result_select_song->fetch_assoc()) {
                                echo "<tr class=\"info_song\"><td><a href=\"upload.php?edit=" . $row["songID"] . "\"><img src=\"edit.png\" alt=\"Edit\" width = \"24px\" height=\"24px\"></a></td><td><a href=\"upload.php?delete=" . $row["songID"] . "\"><img src=\"del.png\" alt=\"Delete\" width = \"24px\" height=\"24px\"></a></td><td>" . $row["song_name"] . "</td><td>" . $row["singer_name"] . "</td><td>" . $row["album_name"] . "</td><td>" . $row["file_song_name"] . "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "0 result";
                        }
                        $query = "SELECT * FROM Album";
                        $result2 = mysqli_query($conn, $query);

                        $options = "";

                        while ($row2 = mysqli_fetch_array($result2)) {
                            $options = $options . "<option>$row2[1]</option>";
                        }

                        $conn->close();

                        ?>

                    </table>

                </td>
            </tr>

        </table>
       
        <table style='width: 99%;table-layout:fixed;' method="POST">
            <tr>
                <td colspan="2">
                    <table style="width: 100%; background-color:#FFFFFF; border: dashed 3px #6D7B8D; padding: 5px;table-layout:fixed;" cellpadding="2" cellspacing="2">
                        <tr style="height: 30px; background-color:#e20952 ; color:#FFFFFF ;border: solid 1px #659EC7;">
                            <td>
                                <h3 style="text-align: center;"> Manage Album Details</h3>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="40%" valign="top">
                    <form novalidate name="f1" method="POST">
                        <table style="color:#9F000F;font-size:large;width:1515px;" cellpadding="4" cellspacing="6">
                            <input type="hidden" name="id" value="<?php $id ?>">
                            <tr>
                                <td>
                                    <b> Album Name : </b>
                                </td>
                                <td>
                                    <input type="text" name="album_name_a" value="<?php echo $album_name_a_u ?>" placeholder="Album Name" required />
                                    <br />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b> Singer Name : </b>
                                </td>
                                <td>
                                    <input type="text" name="singer_name_a" value="<?php echo $singer_name_a_u ?>" placeholder="Singer Name" required />
                                    <br />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Select Album Image File : </b>
                                </td>

                                <td>
                                    <input type="file" id="avatar" value="<?php echo $image_name_a_u ?>" name="image_avt_a" required>
                                    <br />
                                </td>
                            <tr>

                                <td colspan="2">
                                    <?php
                                    if ($update_album == true) :
                                    ?>
                                        <input type="submit" name="update_album" value="Update Album" style="background-color:#1be959;color:#4d4444;margin: 10px 0px 10px 250px;height: 60px;" name="update_album" required />
                                    <?php else : ?>
                                        <input type="submit" name="submit_album" value="Save Album" style="background-color:#407531;color:#FFFFFF;margin: 10px 0px 10px 250px;height: 60px;" required />
                                    <?php endif; ?>
                                    
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
                <button type="button" onclick="sw()" id="back" style="height :40px; width:200px;margin:10px 10px 10px 600px;background-color:#6D7B8D;color:#FFFFFF;">Click here to back
                    <script>
                        function sw() {
                            location.replace("http://localhost:8080/Connection/s_login.php#")
                        }
                    </script>
                </button>
            <tr>
                <table style="width: 100%; background-color:#FFFFFF;border :solid 2px #6D7B8D; padding: 5px;table-layout:fixed;" cellpadding="2" cellspacing="2">

                    <tr style="height: 30px; background-color:#5e2f50 ; color:#FFFFFF ;border: solid 1px #659EC7;">
                        <td width="30" align="center"><b>Edit</b></td>
                        <td width="30" align="center"><b>Delete</b></td>
                        <td width="30" align="center"><b>ID </b></td>
                        <td width="150" align="center"><b>Album Name</b></td>
                        <td width="150" align="center"><b>Image</b></td>

                    </tr>
                    <tbody>
                        <tr>
                            <?php

                            $conn = mysqli_connect("localhost", "root", "123456", "nguoi_dung");
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }
                            $sql_select_album    = "select * from nguoi_dung.album";
                            $result_select_album = $conn->query($sql_select_album);
                            if ($result_select_album->num_rows > 0) {
                                while ($row = $result_select_album->fetch_assoc()) {
                                    echo "<tr class=\"info_song\"><td><a href=\"upload.php?edit_album=" . $row["albumID"] . "\"><img src=\"edit.png\" alt=\"Edit\" width = \"24px\" height=\"24px\"></a></td><td><a href=\"upload.php?delete_album=" . $row["albumID"] . "\"><img src=\"del.png\" alt=\"Delete\" width = \"24px\" height=\"24px\"></a></td><td>" . $row["albumID"] . "</td><td>" . $row["album_name"] . "</td><td>" . $row["image_name"] . "</td></tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "0 result";
                            }
                            $query = "SELECT * FROM Album";
                            $result2 = mysqli_query($conn, $query);

                            $options = "";

                            while ($row2 = mysqli_fetch_array($result2)) {
                                $options = $options . "<option>$row2[1]</option>";
                            }

                            $conn->close();

                            ?>
                        </tr>

                    </tbody>
                </table>
            </tr>
            <button type="button" onclick="sw()" id="back" style="height :40px; width:200px;margin:10px 10px 10px 600px;background-color:#6D7B8D;color:#FFFFFF;">Click here to back