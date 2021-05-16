<?php
session_start();
$conn = new mysqli("localhost", "root", "123456","nguoi_dung");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
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
    <link href="stsearch.css" rel="stylesheet">
    
    <link rel="shortcut icon" href="https://d29fhpw069ctt2.cloudfront.net/icon/image/37740/preview.svg">
    
</head>

<body id="home" style="overflow-x: hidden;">

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
                            <a class="nav-link active" href="../s_login.php">Home</a>
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
                                href="../Login/login.php">Log-out</a>
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
    <div class="container">
        <h3>Bài hát</h3>
        <div class="list_border">
        <div class="list_item">
                <div class="media">
                    <div class="media-left">
                        <div class="song-thumb">
                            <figure class="image is-40x40" title="Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)">
                            <img src="https://photo-resize-zmp3.zadn.vn/w94_r1x1_jpeg/cover/c/1/6/6/c166d305aa987d8e2f8a638b47bf9cfa.jpg" class="pict" alt="">
                            </figure>
                        <div class="opacity "></div>
                        <div class="zm-actions-container">
                            <div class="zm-box zm-actions">
                                <button class="zm-btn zm-tooltip-btn animation-like is-hidden active is-hover-circle button" tabindex="0">
                                    <i class="icon ic-like"></i>
                                    <i class="icon ic-like-full"></i>
                                </button>
                                <button class="zm-btn action-play  button" tabindex="0">
                                    <i class="far fa-play-circle"></i>
                                </button>
                                <button class="zm-btn zm-tooltip-btn is-hidden is-hover-circle button" tabindex="0">
                                    <i class="icon ic-more"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-info">
                        <div class="title-wrapper">
                            <span class="item-title title" title="Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)">Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)</span>
                        </div>
                        <h3 class="is-one-line subtitle">
                            <a class="" href="/nghe-si/Minh-Vuong-M4U">Minh Vương M4U, </a>
                            <a class="" href="/nghe-si/ACV">ACV</a></h3></div></div><div class="media-content">
                                <div class="song-duration">04:38</div>
                            </div>
                            <div class="media-right">
                                <div class="level">
                                    <div class="level-item"></div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn is-hover-circle button" tabindex="0">
                                            <i class="icon ic-karaoke"></i>
                                        </button>
                                    </div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn animation-like undefined active is-hover-circle button" tabindex="0">
                                            <i class="icon ic-like"></i>
                                            <i class="icon ic-like-full"></i>
                                        </button>
                                    </div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn is-hover-circle button" tabindex="0">
                                            <i class="icon ic-more"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            
            </div>
        <div class="list_item">
                <div class="media">
                    <div class="media-left">
                        <div class="song-thumb">
                            <figure class="image is-40x40" title="Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)"><img src="https://photo-resize-zmp3.zadn.vn/w94_r1x1_jpeg/cover/c/1/6/6/c166d305aa987d8e2f8a638b47bf9cfa.jpg" alt=""></figure>
                        <div class="opacity "></div>
                        <div class="zm-actions-container">
                            <div class="zm-box zm-actions">
                                <button class="zm-btn zm-tooltip-btn animation-like is-hidden active is-hover-circle button" tabindex="0">
                                    <i class="icon ic-like"></i>
                                    <i class="icon ic-like-full"></i>
                                </button>
                                <button class="zm-btn action-play  button" tabindex="0">
                                    <i class="far fa-play-circle"></i>
                                </button>
                                <button class="zm-btn zm-tooltip-btn is-hidden is-hover-circle button" tabindex="0">
                                    <i class="icon ic-more"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-info">
                        <div class="title-wrapper">
                            <span class="item-title title" title="Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)">Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)</span>
                        </div>
                        <h3 class="is-one-line subtitle">
                            <a class="" href="/nghe-si/Minh-Vuong-M4U">Minh Vương M4U, </a>
                            <a class="" href="/nghe-si/ACV">ACV</a></h3></div></div><div class="media-content">
                                <div class="song-duration">04:38</div>
                            </div>
                            <div class="media-right">
                                <div class="level">
                                    <div class="level-item"></div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn is-hover-circle button" tabindex="0">
                                            <i class="icon ic-karaoke"></i>
                                        </button>
                                    </div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn animation-like undefined active is-hover-circle button" tabindex="0">
                                            <i class="icon ic-like"></i>
                                            <i class="icon ic-like-full"></i>
                                        </button>
                                    </div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn is-hover-circle button" tabindex="0">
                                            <i class="icon ic-more"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        <div class="list_item">
                <div class="media">
                    <div class="media-left">
                        <div class="song-thumb">
                            <figure class="image is-40x40" title="Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)"><img src="https://photo-resize-zmp3.zadn.vn/w94_r1x1_jpeg/cover/c/1/6/6/c166d305aa987d8e2f8a638b47bf9cfa.jpg" alt=""></figure>
                        <div class="opacity "></div>
                        <div class="zm-actions-container">
                            <div class="zm-box zm-actions">
                                <button class="zm-btn zm-tooltip-btn animation-like is-hidden active is-hover-circle button" tabindex="0">
                                    <i class="icon ic-like"></i>
                                    <i class="icon ic-like-full"></i>
                                </button>
                                <button class="zm-btn action-play  button" tabindex="0">
                                     <i class="far fa-play-circle"></i>
                                </button>
                                <button class="zm-btn zm-tooltip-btn is-hidden is-hover-circle button" tabindex="0">
                                    <i class="icon ic-more"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-info">
                        <div class="title-wrapper">
                            <span class="item-title title" title="Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)">Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)</span>
                        </div>
                        <h3 class="is-one-line subtitle">
                            <a class="" href="/nghe-si/Minh-Vuong-M4U">Minh Vương M4U, </a>
                            <a class="" href="/nghe-si/ACV">ACV</a></h3></div></div><div class="media-content">
                                <div class="song-duration">04:38</div>
                            </div>
                            <div class="media-right">
                                <div class="level">
                                    <div class="level-item"></div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn is-hover-circle button" tabindex="0">
                                            <i class="icon ic-karaoke"></i>
                                        </button>
                                    </div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn animation-like undefined active is-hover-circle button" tabindex="0">
                                            <i class="icon ic-like"></i>
                                            <i class="icon ic-like-full"></i>
                                        </button>
                                    </div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn is-hover-circle button" tabindex="0">
                                            <i class="icon ic-more"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        <div class="list_item">
                <div class="media">
                    <div class="media-left">
                        <div class="song-thumb">
                            <figure class="image is-40x40" title="Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)"><img src="https://photo-resize-zmp3.zadn.vn/w94_r1x1_jpeg/cover/c/1/6/6/c166d305aa987d8e2f8a638b47bf9cfa.jpg" alt=""></figure>
                        <div class="opacity "></div>
                        <div class="zm-actions-container">
                            <div class="zm-box zm-actions">
                                <button class="zm-btn zm-tooltip-btn animation-like is-hidden active is-hover-circle button" tabindex="0">
                                    <i class="icon ic-like"></i>
                                    <i class="icon ic-like-full"></i>
                                </button>
                                <button class="zm-btn action-play  button" tabindex="0">
                                    <i class="far fa-play-circle"></i>
                                </button>
                                <button class="zm-btn zm-tooltip-btn is-hidden is-hover-circle button" tabindex="0">
                                    <i class="icon ic-more"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-info">
                        <div class="title-wrapper">
                            <span class="item-title title" title="Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)">Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)</span>
                        </div>
                        <h3 class="is-one-line subtitle">
                            <a class="" href="/nghe-si/Minh-Vuong-M4U">Minh Vương M4U, </a>
                            <a class="" href="/nghe-si/ACV">ACV</a></h3></div></div><div class="media-content">
                                <div class="song-duration">04:38</div>
                            </div>
                            <div class="media-right">
                                <div class="level">
                                    <div class="level-item"></div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn is-hover-circle button" tabindex="0">
                                            <i class="icon ic-karaoke"></i>
                                        </button>
                                    </div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn animation-like undefined active is-hover-circle button" tabindex="0">
                                            <i class="icon ic-like"></i>
                                            <i class="icon ic-like-full"></i>
                                        </button>
                                    </div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn is-hover-circle button" tabindex="0">
                                            <i class="icon ic-more"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        <div class="list_item">
                <div class="media">
                    <div class="media-left">
                        <div class="song-thumb">
                            <figure class="image is-40x40" title="Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)"><img src="https://photo-resize-zmp3.zadn.vn/w94_r1x1_jpeg/cover/c/1/6/6/c166d305aa987d8e2f8a638b47bf9cfa.jpg" alt=""></figure>
                        <div class="opacity "></div>
                        <div class="zm-actions-container">
                            <div class="zm-box zm-actions">
                                <button class="zm-btn zm-tooltip-btn animation-like is-hidden active is-hover-circle button" tabindex="0">
                                    <i class="icon ic-like"></i>
                                    <i class="icon ic-like-full"></i>
                                </button>
                                <button class="zm-btn action-play  button" tabindex="0">
                                    <i class="far fa-play-circle"></i>
                                </button>
                                <button class="zm-btn zm-tooltip-btn is-hidden is-hover-circle button" tabindex="0">
                                    <i class="icon ic-more"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-info">
                        <div class="title-wrapper">
                            <span class="item-title title" title="Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)">Nỗi Đau Ai Ngờ (Chỉ Là Câu Hứa)</span>
                        </div>
                        <h3 class="is-one-line subtitle">
                            <a class="" href="/nghe-si/Minh-Vuong-M4U">Minh Vương M4U, </a>
                            <a class="" href="/nghe-si/ACV">ACV</a></h3></div></div><div class="media-content">
                                <div class="song-duration">04:38</div>
                            </div>
                            <div class="media-right">
                                <div class="level">
                                    <div class="level-item"></div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn is-hover-circle button" tabindex="0">
                                            <i class="icon ic-karaoke"></i>
                                        </button>
                                    </div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn animation-like undefined active is-hover-circle button" tabindex="0">
                                            <i class="icon ic-like"></i>
                                            <i class="icon ic-like-full"></i>
                                        </button>
                                    </div>
                                    <div class="level-item">
                                        <button class="zm-btn zm-tooltip-btn is-hover-circle button" tabindex="0">
                                            <i class="icon ic-more"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>

    
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
    <!--/#footer-->
</body>


</html>