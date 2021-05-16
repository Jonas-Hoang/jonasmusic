<?php
$conn=mysqli_connect("localhost","root","123456","nguoi_dung");
if(!$conn){
   die("Connection failed: ".mysqli_connect_error());
}
$sql = "Select * from nguoi_dung.song order by songID ASC";
$query = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
   $path[] = $row["file_song_name"];
}


//echo json_encode($path);
$sql_a = "select song.album_albumID, album.image_name FROM song INNER JOIN album ON song.album_albumID = album.albumID";
$query_a = mysqli_query($conn,$sql_a);
while($row = mysqli_fetch_array($query_a,MYSQLI_ASSOC)){
   $img[] = $row["image_name"];
}
// echo json_encode($img)
$sql_name = "Select * from nguoi_dung.song ";
$query_name = mysqli_query($conn,$sql_name);
while($row = mysqli_fetch_array($query_name,MYSQLI_ASSOC)){
   $song[] = $row["song_name"];
}
$sql_singer = "Select * from nguoi_dung.song";
$query_singer = mysqli_query($conn,$sql_singer);
while($row = mysqli_fetch_array($query_singer, MYSQLI_ASSOC)){
   $singer[] = $row["singer_name"];
}
//echo json_encode($singer)
?>
<!DOCTYPE html>
<html>

<head>
   <title>Jonas music player</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="style.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

   <div class="main">
      <p id="logo"><i class="fa fa-music"></i>JonasMusic</p>

      <!--- left part --->
      <div class="left">

         <!--- song img --->
         <img id="track_image" src="img/st.jpg">
         <div class="volume">
            <p id="volume_show">90</p>
            <i class="fa fa-volume-up" aria-hidden="true" onclick="mute_sound()" id="volume_icon"></i>
            <input type="range" min="0" max="100" value="90" onchange="volume_change()" id="volume">
         </div>

      </div>


      <!--- right part --->
      <div class="right">

         <div class="show_song_no">
            <p id="present">1</p>
            <p>/</p>
            <p id="total"></p>
         </div>

         <!--- song title & artist name --->
         <p id="title">Miroh</p>
         <p id="artist">Stray Kids</p>

         <!--- middle part --->
         <div class="middle">
            <button onclick="previous_song()" id="pre"><i class="fa fa-step-backward" aria-hidden="true"></i></button>
            <button onclick="playPauseSong()" id="play"><i class="fa fa-play" aria-hidden="true"></i></button>
            <button onclick="next_song()" id="next"><i class="fa fa-step-forward" aria-hidden="true"></i></button>
         </div>

         <!--- song duration part --->
         <div class="duration">
            <input type="range" min="0" max="100" value="0" id="duration_slider" onchange="change_duration()">
         </div>
         <button id="auto" onclick="autoplay_switch()">Auto play <i class="fa fa-circle-o-notch"
               aria-hidden="true"></i></button>
         <div class="backToHomePage">
               <button id="back" type="button" onclick="sw()" style="color: white; background-color: cadetblue; border-radius: 10px;">Back</button>
         </div>
      </div>
  
      
   </div>
   <div class="comment">
      <div class="row">
               <div class="col-md-12">
                  <textarea class="form-control" id="mainComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
                  <button class="btn-primary btn" id="addComment">Add Comment</button>
               </div>
      </div>
        <div class="row">
            <div class="col-md-12">
                <h2><b>335 Comments</b></h2>
                <div class="userComments">
                    <div class="comment">
                        <div class="user">Senaid B 
                           <span class="time">2019-07-15</span>
                        </div>
                        <div class="userComment">this is my comment</div>
                        <div class="replies">
                            <div class="comment">
                                <div class="user">Senaid B <span class="time">2019-07-15</span></div>
                                <div class="userComment">this is my comment</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
   </div>
   <!--- Add javascript file --->
   <script>
   let previous = document.querySelector('#pre');
   let play = document.querySelector('#play');
   let next = document.querySelector('#next');
   let title = document.querySelector('#title');
   let recent_volume = document.querySelector('#volume');
   let volume_show = document.querySelector('#volume_show');
   let slider = document.querySelector('#duration_slider');
   let show_duration = document.querySelector('#show_duration');
   let track_image = document.querySelector('#track_image');
   let auto_play = document.querySelector('#auto');
   let present = document.querySelector('#present');
   let total = document.querySelector('#total');
   let artist = document.querySelector('#artist');
   

   let songs = <?php echo json_encode($path); ?>;
   let image = <?php echo json_encode($img); ?>;
 

   let song = new Audio();
   let currentSong = -1;
   function playSong(){
        song.src = songs[currentSong];
        //songTitle.text = songs[currentSong];
        song.play();
        window.onload = playSong;
        play.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
        
   }
   // play song
   function playsong() {
      songs.play();
      Playing_song = true;
      play.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
   }
   function pausesong() {
      song.pause();
      // Playing_song = false;
      
   }
   function playPauseSong()
    {        
            if(song.paused){
                song.play();
                play.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
                
            }
            else{
                song.pause();
                
                play.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';
            }
    }
   let timer;
   let autoplay = 0;

   // let index_no = 0;
   // let Playing_song = false;

   // //create a audio Element
   // let track = document.createElement('audio');


   // //All songs list
   // let All_song = [
   //    {
   //       name: "Dope",
   //       path: "../mp3/Dope.mp3",
   //       img: "../img/BTS.jpg",
   //       singer: "BTS"
   //    },
   //    {
   //       name: "How you like that",
   //       path: "../mp3/HYLT.mp3",
   //       img: "../img/bp.png",
   //       singer: "BlackPink"
   //    },
   //    {
   //       name: "Gogo bebe",
   //       path: "../mp3/Gogobebe.mp3",
   //       img: "../img/mm.jpg",
   //       singer: "Mamamoo"
   //    },
   //    {
   //       name: "ICY",
   //       path: "../mp3/Icy.mp3",
   //       img: "../img/itzy.jpg",
   //       singer: "Itzy"
   //    },
   //    {
   //       name: "BF",
   //       path: "../mp3/bestfriend.mp3",
   //       img: "../img/ikon.jpg",
   //       singer: "iKon"
   //    },
   //    {
   //       name: "Lion Heart",
   //       path: "../mp3/LionHeart.mp3",
   //       img: "../img/snsd.jpg",
   //       singer: "SNSD"
   //    },
   //    {
   //       name: "Red Flavor",
   //       path: "../mp3/RF.mp3",
   //       img: "../img/rv.png",
   //       singer: "RedVelvet"
   //    }

   // ];


   // All functions


   // function load the track
   // function load_track(index_no) {
   //    clearInterval(timer);
   //    reset_slider();

   //    track.src = All_song[index_no].path;
   //    title.innerHTML = All_song[index_no].name;
         // track_image.src = songs[currentSong].image;
   //    artist.innerHTML = All_song[index_no].singer;
   //    track.load();

      timer = setInterval(range_slider, 1000);
      total.innerHTML = songs.length;
   // }

   //load_track(index_no);


   //mute sound function
   function mute_sound() {
      song.volume = 0;
      volume.value = 0;
      volume_show.innerHTML = 0;
   }


   // checking.. the song is playing or not
   function justplay() {
      if (Playing_song == false) {
         playsong();

      } else {
         pausesong();
      }
   }


   // reset song slider
   function reset_slider() {
      slider.value = 0;
   }

   

   //pause song
   

   // next song
   function next_song() {
      // if (index_no < All_song.length - 1) {
      //    index_no += 1;
      //    load_track(index_no);
      //    playsong();
      // } else {
      //    index_no = 0;
      //    load_track(index_no);
      //    playsong();

      // }
      
        if(currentSong < songs.length -1){
         currentSong +=1;
         playSong();
         present.innerHTML = currentSong + 1;
         track_image.src = image[currentSong];
        }
        else{
           currentSong = 0;
           playSong();
           present.innerHTML = 1
        }
   }


   // previous song
   function previous_song() {
      if(currentSong <= -1){
         currentSong = songs.length;
      }else{
         currentSong -= 1;
         playSong();
         track_image.src = image[currentSong];
         present.innerHTML = currentSong + 1;
      }
   }


   // change volume
   function volume_change() {
      volume_show.innerHTML = recent_volume.value;
      // track.volume = recent_volume.value / 100;
      song.volume = recent_volume.value / 100;
   }

   // change slider position 
   function change_duration() {
      // slider_position = track.duration * (slider.value / 100);
      slider_position = song.duration * (slider.value / 100);
      // track.currentTime = slider_position;
      song.currentTime = slider_position;
   }

   // autoplay function
   function autoplay_switch() {
      if (autoplay == 1) {
         autoplay = 0;
         auto_play.style.background = "rgba(255,255,255,0.2)";
      } else {
         autoplay = 1;
         auto_play.style.background = "#FF8A65";
      }
   }


   function range_slider() {
      let position = 0;

      // update slider position
      if (!isNaN(song.duration)) {
         position = song.currentTime * (100 / song.duration);
         slider.value = position;
      }


      // function will run when the song is over
      if (song.ended) {
         play.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';
         if (autoplay == 1) {
            next_song();
         }
      }
   }
   //chuyen sang page khacs
   function sw() {
      location.replace("http://localhost:8080/Connection/s_login.php#");
     
   }
   </script>

</body>

</html>