<?php
session_start();

$title = "Detail Berita";
include("includes/header.php");
include("includes/functions.php");
include("includes/navigation_bar.php");

// Periksa apakah parameter id tersedia di URL
if (isset($_GET['id'])) {
    $id_berita = $_GET['id'];

    // Validasi parameter id untuk keamanan
    $id_berita = mysqli_real_escape_string($connection, $id_berita);

    // Query data berita beserta penyelenggara berdasarkan id
    $columns = "*";
    $table = "berita";
    $join = "";
    $where = "berita.id_berita = '$id_berita'";
    $news = get_data($connection, $columns, $table, $join, $where, "", "1");

    // Periksa apakah data ditemukan
    if (empty($news)) {
        echo "<p>Berita tidak ditemukan.</p>";
        exit;
    }

    $news = $news[0]; // Ambil data berita yang ditemukan
} else {
    echo "<p>Parameter ID tidak valid.</p>";
    exit;
}
?>

<main class="w-full h-full pt-20 lg:px-28 md:px-14 sm:px-6 flex-grow">
   <div class="mt-8 mb-5 flex items-center gap-x-3">
      <a href='<?php echo $_SERVER['HTTP_REFERER'] ?>'>
         <i class='fa-solid fa-arrow-left-long fa-lg cursor-pointer'></i>
      </a>
      <h1 class="font-bold text-xl">Kembali</h1>
   </div>
   <div class='max-w-auto'>
      <!-- Gambar Berita -->
      <div class="mb-8 flex justify-center">
         <div class="w-full rounded-full">
            <img src="<?= $news['foto'] ?>" alt="<?= $news['judul_berita'] ?>" class="w-80 h-80 object-cover mx-auto">
         </div>
      </div>

      <!-- Detail Berita -->
      <div>
         <!-- Judul Berita -->
         <h2 class="text-3xl font-bold text-gray-800 text-center"><?= $news['judul_berita'] ?></h2>

         <!-- Kategori dan Tanggal -->
         <div class="mt-4 flex justify-center space-x-3 items-center text-gray-700">
            <p class="text-lg font-bold text-primary"><?= $news['kategori'] ?></p>
            <p class="ml-3 flex items-center">
               <i class="fa fa-calendar text-gray-500 mr-4"></i>
               <?= format_tanggal($news['tanggal']) ?>
            </p>
         </div>


         <!-- Deskripsi -->
         <div class="mt-6">
            <p class="font-bold text-gray-700">Detail Acara</p>
            <p class="text-justify text-gray-600"><?= $news['deskripsi'] ?></p>
         </div>

         <!-- Statistik -->
         <div class="mt-8 flex items-center space-x-4">
            <i class="fa-solid fa-chart-bar text-gray-600"></i>
            <p class="font-semibold text-gray-700 ml-3">Post Views: <?= $news['views'] ?? 0 ?></p>
         </div>

         <!-- Ikon Sosial Media -->
         <div class="mt-6">
            <ul class="social-icons flex justify-center space-x-4">
               <li><a href="#" class="fa fa-facebook text-gray-700"></a></li>
               <li><a href="#" class="fa fa-twitter text-gray-700"></a></li>
               <li><a href="#" class="fa fa-pinterest text-gray-700"></a></li>
               <li><a href="#" class="fa fa-linkedin text-gray-700"></a></li>
               <li><a href="#" class="fa fa-instagram text-gray-700"></a></li>
               <li><a href="#" class="fa fa-youtube text-gray-700"></a></li>
            </ul>
         </div>
      </div>
   </div>
</main>


<?php include("includes/footer.php"); ?>