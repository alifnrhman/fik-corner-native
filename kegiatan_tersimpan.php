<?php
   session_start();

   if(!isset($_SESSION['nim'])) {
      header('location: login');
   }
   
   $title = "Kegiatan Tersimpan";
   include("includes/header.php");
   include("includes/navigation_bar.php");
?>

<h1>
   Kegiatan Tersimpan
</h1>

<?php include("includes/footer.php") ?>