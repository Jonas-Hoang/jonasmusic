<?php
session_start();
$conn = new mysqli("localhost", "root", "123456","nguoi_dung");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "<br/>Connected successfully<br/>";
// Song
$sql = "select * from Song";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $song[] = $row["file_song_name"];
}
//echo json_encode($song); //cai nay test thu de chay data o duoi
//Song Name
$sql = "select * from Song";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $name[] = $row["song_name"];
}
//echo json_encode($name);

//Album
$sql_album = "select * from Album";
$result_album = mysqli_query($conn,$sql_album);

while($row_album = mysqli_fetch_array($result_album, MYSQLI_ASSOC)){
    $image[] = $row_album["image_name"];
}

// echo json_encode($image);
if(empty($_SESSION)){
    header("Location: /connection/Login/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">    

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>JonasMusic</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link href="style1.css" rel="stylesheet">
    
    <link rel="shortcut icon" href="https://d29fhpw069ctt2.cloudfront.net/icon/image/37740/preview.svg">
    
</head>

<body id="home" style="overflow-x: hidden;">
<button id="myBtn" title="Go to top" >Back To Top</button>
    <header id="header" class="sticky-top">
        <nav class="navbar navbar-expand-md navbar-light bg-light justify-content-start sticky-top">
            <div class="container-fluid">
                <a class="navbar-branch" href="#">
                    <img src="https://d29fhpw069ctt2.cloudfront.net/icon/image/37740/preview.svg" height="30px">
                    <a class="navbar-brand" href="s_login.php">Jonas<b>MUSIC</b></a>
                    <div id="search_container">
                        <input id="search_bar" type="text" placeholder="Tìm thông tin bài hát">
                        <button id="search_btn" type="submit" onclick="showAlert()"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                   
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="Upload/upload.php"><img id="upload" style="cursor: pointer; margin: 8px;" src="logo/upload.png"  style="margin-top: 10px;"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="s_login.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#playing-music">Music</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/connection/Chart/chart.php">Jonas chart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#hot-album">Top album</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" 
                                href="Login/login.php">Log-out</a>
                        </li>
                        <li>
                            <label style="padding-top: 10px;padding-left: 5px;">Hello <?php echo $_SESSION['user_name']; ?> ! </label>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--/header-->

<div class="main">
<div id="slides" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#slides" data-slide-to="0" class="active"></li>
            <li data-target="#slides" data-slide-to="1"></li>
            <li data-target="#slides" data-slide-to="2"></li>
            <li data-target="#slides" data-slide-to="3"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img
                    src="https://images.unsplash.com/photo-1581974944026-5d6ed762f617?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80">
                <div class="carousel-caption">
                    <h2 class="display-2">JonasMusic</h2>
                    <h3>Play music, free your soul</h3>
                    <hr>
                    <a href="m_player/m_player.php">
                    <button type="button" class="btn bZtn-outline-light btn-lg">
                        Play music
                    </button>
                    </a>
                    <button type="button" class="btn btn-primary btn-lg">More information</button>
                    <hr>
                </div>
            </div>
            <div class="carousel-item">
                <img
                    src="https://images.unsplash.com/photo-1567020992371-bcc7c617a372?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80">
            </div>
            <div class="carousel-item">
                <img
                    src="https://images.unsplash.com/photo-1501527459-2d5409f8cf9f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80">
            </div>
            <div class="carousel-item">
                <img
                    src="https://images.unsplash.com/photo-1583681716866-c0d24d132420?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2000&q=80">
            </div>
        </div>
    </div>
    
    <section id="playing-music" class="audio-main">
        <div class="container">
            <div class="poster" id="poster">
                <img src="img/st.jpg" />
                
            </div>
            <div class="song-title" id="song_title">
                Hellivator
            </div>
            
            <div class="btn-audio-player">
                <button id="pre" onclick="pre()">
                    <i class="fa fa-step-backward" aria-hidden="true"></i>
                </button>
                <button id="play" onclick="playPauseSong()">
                    <i class="fa fa-play" aria-hidden="true"></i>
                </button>
                <button id="next" onclick="next()">
                    <i class="fa fa-step-forward" aria-hidden="true"></i>
                </button>

            </div>
            <div class="seek-bar">
                <div id="fill" class="fill" ></div>
                <div id="handle" class="handle"></div>
            </div>
            <div id="currentTime">
                00:00 / 00:00
            </div>
            <div id="repeatBtn">
                <button id="repeat_ne" onclick="thu_cai()">
                    <img src="logo/repeat.png">
                </button>
            </div>
        </div>
    </section>
    <!--/#Playing-music-->
    <!--Hot album-->
    <div id="hot-album" class="label-hot-album">
        <h3>Hot album 100</h3>
        <div class="border"></div>
    </div>
    <div class="hot-album">
        <div>
            <img src="img/bp.png" alt="" id="bp">
        </div>
        <div>
            <img src="img/bb.jpg" id="bb">
        </div>
        <div>
            <img src="img/niziu.jpg" alt="">
        </div>
        <div>
            <img src="img/bts.jpg" alt="">
        </div>
        <div>
            <img src="img/rv.png" alt="">
        </div>
        <div>
            <img src="img/tw.jpg" alt="">
        </div>
        <div>
            <img src="img/exo.jpg" alt="">
        </div>
        <div>
            <img src="img/st.jpg" alt="">
        </div>
        <div>
            <img src="img/bbag.jpg" alt="">
        </div>
        <div>
            <img src="img/mm.jpg" alt="">
        </div>
        <div>
            <img src="img/iu.jpg" alt="">
        </div>
        <div>
            <img src="img/itzy.jpg" alt="">
        </div>


    </div>
    

    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2020 JonasMusic. Template by <a target="_blank" href="idk.html">JonasMusic</a>
                </div>
                <div class="social-media">
                    <span>
                        <a href="https://facebook.com/JonasMuzik-107294897717104"><img src="logo/facebook.png"></a>
                        <a href="https://twitter.com"><img src="logo/twitter.png"></i></a>
                        <a href="https://google.com"><img src="logo/google.png"></i></a>
                        <a href="https://linkedin.com"><img src="logo/linkedin.png"></i></a>
                        <a href="https://youtube.com"><img src="logo/youtube.png"></i></a>
                        <a href="https://github.com"><img src="logo/github.png"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </footer>
</div>
    <!--/#footer-->
    <script src="btt.js"></script>
    <script>    
    let input = document.getElementById('search_bar');
    
    input.addEventListener("keyup",(event) => {
        if(event.keyCode === 13){
            event.preventDefault();
            document.getElementById('search_btn').click();
            const inputValue = input.value;
            alert(inputValue);
        }
    })
    function showAlert(){
        const inputValue = input.value;
        alert(inputValue);
    }
    document.getElementById('Noite');
    var songs = <?php echo json_encode($song); ?>;
    var poster = <?php echo json_encode($image); ?>;
    var namesong = <?php echo json_encode($name); ?>;
    var songTitle = document.getElementById("songTitle");
    var fillBar =document.getElementById("fill");
    var handleDot = document.getElementById("handle");
    var buttonLogin = document.getElementById("login");
    
    var song = new Audio();
    var currentSong = 0;
    //
    function playSong(){
        song.src = songs[currentSong];
        //songTitle.text = songs[currentSong];
        song.play();
        window.onload = playSong;
        $("#play i").attr("class","fa fa-pause");
    }
    
    function playPauseSong()
    {        
            if(song.paused){
                song.play();
                $("#play i").attr("class","fa fa-pause");
                
            }
            else{
                song.pause();
                $("#play i").attr("class","fa fa-play");
                
            }
    }
    song.addEventListener('timeupdate',function(){ 
            
            var position = song.currentTime / song.duration;
            
            fillBar.style.width = position * 100 +'%';
            handleDot.style.left = position * 100 +'%';
            convertTime(Math.round(song.currentTime));
            
            if(song.ended)
                next();
        });
   
    function convertTime(seconds ){
        var min = Math.floor(seconds/60);
        var sec  = seconds % 60;
        min = (min<10)?"0"+min : min;
        sec = (sec <10)?"0"+sec:sec;
        currentTime.textContent =  min +":" +sec;

        totalTime(Math.round(song.duration));
    }
    function totalTime(seconds)
    {
        var min = Math.floor(seconds/60);
        var sec  = seconds % 60;
        min = (min<10)?"0"+min : min;
        sec = (sec <10)?"0"+sec:sec;
        
        currentTime.textContent +=" / " + min +":" +sec;
    }  
    function next(){
        currentSong+=1;
        if(currentSong >= songs.length){
            currentSong = 0;
        }
        $("#song_title").text(namesong[currentSong]);
        $("#poster img").attr("src",poster[currentSong]);
        playSong();
    }
    function pre(){
        
        currentSong-=1;
        if(currentSong < 0){
            currentSong = songs.length;
        } 
        
        $("#song_title").text(namesong[currentSong]);
        $("#poster img").attr("src",poster[currentSong]);
        playSong();
        
        
    }
    function thu_cai(){
        if(song.loop == false){
            song.loop = true;
            song.load();
            $("#repeat_ne img").attr("src","logo/repeat1.png");
        }
        else if(song.loop == true){
            song.loop = false;
            song.load();
            $("#repeat_ne img").attr("src","logo/repeat.png");
        }
    }
  
   
    
</script>
</body>


</html>
