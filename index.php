<?php
// filepath: /c:/xampp/htdocs/railsystemNexRail/seat_selection_next.php
include 'auth.php';
checkLogin();

$userId = $_SESSION['userId']; // Retrieve user ID from session
?>

<!DOCTYPE html>
<div class="header">
  <div class="sides">
    <a href="#" class="logo">NexRail</a>
  </div>
  <div class="sides"> <a href="#" class="menu" id="openMenu"> </a></div>
  <div class="info">
  <h4><a href="#category">NexRail</a></h4>
    <h1>New Era of Transport system</h1>
</div>
<section class="content">
</section>

<dialog>
    <a href="schedule.php">Train Schedule</a>
    <a href="notification.php">Notification</a>
    <a href="arrival_depart.php">Arrival/Depart</a>
    <a href="seat_selection.php">Seat Selection</a>
    <a href="customersupport.php">Customer Support</a>
    <a href="logout.php">Logout</a>
</dialog>

<style>
    html,body{
  margin:0;
  height:120%;
   font-family: "Montserrat", sans-serif;

}
a{
  text-decoration:none
}
.header{
  position:relative;
  overflow:hidden;
  display:flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: flex-start;
  align-content: flex-start;
  height:70vw;
  min-height:400px;
  max-height:750px;
  min-width:300px;
  color:#eee;
  border-radius: 0 0 20px 20px;
  text-shadow:0 2px 6px #000a
}
.header:after{
  content:"";
  width:100%;
  height:100%;
  position:absolute;
  bottom:0;
  left:0;
  z-index:-1;
 background: linear-gradient(to bottom, rgba(0,0,0,0.12) 40%,rgba(27,32,48,1) 100%);
}
.header:before{
  content:"";
  width:100%;
  height:200%;
  position:absolute;
  top:0;
  left:0;
    -webkit-backface-visibility: hidden;
    -webkit-transform: translateZ(0); backface-visibility: hidden;
  scale(1.0, 1.0);
    transform: translateZ(0);
  background:#1B2030 url(https://images.squarespace-cdn.com/content/v1/5bcfc8c07a1fbd730b2ba933/1569493443301-VO7YMDYEDVDHA50HSTTB/DSC_0085_1.jpg) 50% 0 no-repeat;
  background-size:100%;
  background-attachment:fixed;
  animation: grow 360s  linear 10ms infinite;
  transition:all 0.4s ease-in-out;
  z-index:-2
}
.header a{
  color:#eee
}
.menu{
  display:block;
  width:40px;
  height:30px;
  border:2px solid #fff;
  border-radius:3px;
  position:absolute;
  right:20px;
  top:20px;
  text-decoration:none
}
.menu:after{
  content:"";
  display:block;
  width:20px;
  height:3px;
  background:#fff;
  position:absolute;
  margin:0 auto;
  top:5px;
  left:0;
  right:0;
  box-shadow:0 8px, 0 16px
}
.logo{
  border:2px solid #fff;
  border-radius:3px;
  text-decoration:none;
  display:inline-flex;
  align-items:center;
  align-content:center;
  margin:20px;
  padding:0px 10px;
  font-weight:900;
  font-size:1.1em;
  line-height:1;
  box-sizing:border-box;
  height:40px
}
.sides, .info{
  flex: 0 0 auto;
  width:50%
}
.info{
  width:100%;
  padding:15% 10% 0 10%;
  text-align:center; 
}
.author{
  display:inline-block;
  width:50px;
  height:50px;
  border-radius:50%;
  background:url(https://i.imgur.com/6DLCsZcb.jpg) center no-repeat;
  background-size:cover;
  box-shadow:0 2px 3px rgba(0,0,0,0.3);
  margin-bottom:3px
}
.info h4, .meta{
  font-size:0.7em
}
.meta{
  font-style:italic;
}
@keyframes grow{
  0% { transform: scale(1) translateY(0px)}
  50% { transform: scale(1.2) translateY(-400px)}
}
.content{  
  padding:5% 10%;
  text-align:justify
}
.btn{
  color:#333;
  border:2px solid;
  border-radius:3px;
  text-decoration:none;
  display:inline-block;
  padding:5px 10px;
  font-weight:600
}

dialog {
    display: block;
    inset: 0;    
    transition: opacity .5s;
     border-radius:3px;
    padding:20px; 
    box-shadow: 0 0 10px 0 #000a;
  background:#fffd;
  border:0;
  min-width:60vw
}
 
dialog:not([open]) {
    pointer-events: none;
    opacity: 0;
}

dialog::backdrop {
  backdrop-filter: blur(0.25rem);
}
 
dialog a {
   font-size:1.4em;
  display:block;
  text-align:center;
  margin:10px 15px;
  padding:5px;
  font-weight:600;
  color:#333;
  &:hover{
    text-decoration:underline;
    color:#000
  }
}

.content{
    background:#1B2030 url(https://www.lowyat.net/wp-content/uploads/2023/01/rapid-kl-ampang-line-lrt.jpg) 50% 0 no-repeat;
    background-size:100%;
}
</style>
    <script>
        let userId = <?php echo json_encode($userId); ?>;
        console.log('User ID: ', userId);
        const openButton = document.querySelector("#openMenu");
 
        const dialog = document.querySelector("dialog");

        openButton.addEventListener("click", () => {
            dialog.showModal();
        });
        
        dialog.addEventListener("click", ({ target: dialog }) => {
            if (dialog.nodeName === "DIALOG") {
                dialog.close("dismiss");
            }
        });
    </script>
</body>
</html>
