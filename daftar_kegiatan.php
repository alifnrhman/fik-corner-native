<?php
   session_start();
   include("includes/functions.php");

   if (!isset($_SESSION['nim'])) {
      echo "<script>alert('Anda harus login terlebih dahulu!');
            window.location.href='login';
            </script>";
   }

   $columns = "kegiatan.*, kategori_kegiatan.kategori, penyelenggara.nama_penyelenggara, penyelenggara.logo";
   $table = "kegiatan";
   $join = "
      LEFT JOIN kategori_kegiatan ON kegiatan.id_kategori = kategori_kegiatan.id_kategori 
      LEFT JOIN penyelenggara ON kegiatan.id_penyelenggara = penyelenggara.id_penyelenggara
   ";
   $where = "status = 'Aktif' AND id_kegiatan = " . $_GET['id'];
   $orderBy = "";
   $limit = "";

   // Mengambil data event
   $dataEvent = get_data($connection, $columns, $table, $join, $where, $orderBy, $limit);
   
   if($dataEvent[0]['biaya'] === null) {
      $dataEvent[0]['biaya'] = "Gratis";
   } else {
      $dataEvent[0]['biaya'] = "Rp" . number_format($dataEvent[0]['biaya'], 2, ',', '.');
   }

   $jam = strtotime($dataEvent[0]['waktu']);

   $columns = "users.*, mahasiswa.email, mahasiswa.prodi";
   $table = "users";
   $join = "
      LEFT JOIN mahasiswa ON users.nim = mahasiswa.nim 
   ";
   $where = "users.nim = " . $_SESSION['nim'];
   $orderBy = "";
   $limit = "";

   // Mengambil data mahasiswa
   $dataMahasiswa = get_data($connection, $columns, $table, $join, $where, $orderBy, $limit);

   $title = "Daftar " . $dataEvent[0]['nama_kegiatan'];
   include("includes/header.php");
   include("includes/navigation_bar.php");
?>

<main class="w-full h-full pt-20 lg:px-28 md:px-14 sm:px-6 flex-grow">
   <div class="mt-8 mb-5 flex items-center gap-x-3">
      <?php
         $url_kegiatan = "detail_kegiatan.php?id=" . $_GET['id'];
         
         echo "<a href='" . $url_kegiatan . "'>" . 
            "<i class='fa-solid fa-arrow-left-long fa-lg cursor-pointer'></i>" .
         "</a>";
      ?>
      <h1 class="font-bold text-xl">Kembali</h1>
   </div>
   <p class="font-bold text-2xl">Daftar <?= $dataEvent[0]['kategori']; ?></p>
   <?php 
         if ($dataEvent[0]['biaya'] == "Gratis") {
            echo
               "<div class='flex lg:flex'>" .
                     "<div class='mr-10 w-7/12'>" .
                        "<div class='mt-4 flex flex-row gap-4'>" .
                           "<div class='basis-6/12'>" .
                              "<label class='text-gray-800 text-[15px] mb-2 block'>Nama Lengkap</label>" .
                              "<input name='nama_lengkap' id='nama_lengkap' type='text' disabled class='w-full text-sm text-gray-800 bg-gray-100 focus:bg-transparent px-4 py-3.5 rounded-md outline-blue-600' value='" . $dataMahasiswa[0]['nama_lengkap'] . "'/>" .
                           "</div>" .
                           "<div class='basis-3/12'>" .
                              "<label class='text-gray-800 text-[15px] mb-2 block'>NIM</label>" .
                              "<input name='nim' id='nim' type='text' disabled class='w-full text-sm text-gray-800 bg-gray-100 focus:bg-transparent px-4 py-3.5 rounded-md outline-blue-600' value='" . $dataMahasiswa[0]['nim'] . "'/>" .
                           "</div>" .
                           "<div class='basis-3/12'>" .
                              "<label class='text-gray-800 text-[15px] mb-2 block'>Program Studi</label>" .
                              "<input name='prodi' id='prodi' type='text' disabled class='w-full text-sm text-gray-800 bg-gray-100 focus:bg-transparent px-4 py-3.5 rounded-md outline-blue-600' value='" . $dataMahasiswa[0]['prodi'] . "'/>" .
                           "</div>" .
                        "</div>" .
                        
                        "<div class='flex flex-row gap-4'>" .
                           "<div class='basis-6/12 mt-4'>" .
                              "<label class='text-gray-800 text-[15px] mb-2 block'>Email</label>" .
                              "<input name='email' id='email' type='email' disabled class='w-full text-sm text-gray-800 bg-gray-100 focus:bg-transparent px-4 py-3.5 rounded-md outline-blue-600' value='" . $dataMahasiswa[0]['email'] . "'/>" .
                           "</div>" .
                           "<div class='basis-6/12 mt-4'>" .
                              "<label class='text-gray-800 text-[15px] mb-2 block'>Nomor Telepon</label>" .
                              "<input name='nomor_telepon' id='nomor_telepon' type='text' disabled class='w-full text-sm text-gray-800 bg-gray-100 focus:bg-transparent px-4 py-3.5 rounded-md outline-blue-600' value='" . $dataMahasiswa[0]['nomor_telepon'] . "'/>" .
                           "</div>" .
                        "</div>" .
                              "<a href='process_daftar_kegiatan.php?id=" . $_GET['id'] . "'>" .
                                 "<button type='submit'
                                 class='w-40 shadow-md mt-8 py-3 px-6 text-sm tracking-wide font-semibold rounded-md text-white bg-primary hover:bg-primaryHover focus:outline-none'>
                                 Daftar Sekarang
                                 </button>" .
                              "</a>" .
                        "</div>" .
                     "<div class='mr-10 w-3/12'>" .
                        "<div class=''>" .
                           "<p class='text-lg font-bold text-primary'>" . $dataEvent[0]['kategori'] . "</p>" .
                           "<h2 class='text-3xl font-bold'>" . $dataEvent[0]['nama_kegiatan'] . "</h2>" .
                        "</div>" .
                        "<div class='mt-4 flex items-center'>" .
                           "<i class='fa-solid fa-calendar-days absolute'></i>" .
                           "<p class='font-semibold ms-6'>" . format_tanggal($dataEvent[0]['tanggal']) . "</p>" .
                        "</div>" .
                        "<div class='flex items-center'>" .
                           "<i class='fa-solid fa-clock absolute'></i>" .
                           "<p class='font-semibold ms-6'>" . date('H:i', $jam) . "</p>" .
                        "</div>" .
                        "<div class='flex items-center'>" .
                           "<i class='fa-solid fa-location-dot absolute'></i>" .
                           "<p class='font-semibold ms-6'>" . $dataEvent[0]['lokasi'] . "</p>" .
                        "</div>" .
                        "<div class='flex items-center'>" .
                           "<i class='fa-solid fa-sack-dollar absolute'></i>" .
                           "<p class='font-semibold ms-6'>" . $dataEvent[0]['biaya'] . "</p>" .
                        "</div>" .
                        "<div class='flex items-center'>" .
                           "<i class='fa-solid fa-user-group fa-sm absolute'></i>" .
                           "<span class='font-semibold ms-6'>" .
                              $dataEvent[0]['jumlah_peserta'] . " peserta</span>" .
                        "</div>" .
                        "<div class='mt-6 items-center'>
                           <p class='font-bold'>Deskripsi</p>
                           <p class='text-justify'>" . $dataEvent[0]['deskripsi_lengkap'] . "</p>" .
                        "</div>" .
                        "<div class='mt-12 items-center'>" .
                           "<p class='font-bold'>Penyelenggara</p>" .
                           "<div class='flex gap-x-3 items-center mt-2'>" .
                              "<img src='" . $dataEvent[0]['logo'] . "' alt='" . $dataEvent[0]['nama_penyelenggara'] . "'
                                 class='w-6 h-6 rounded-full border border-gray-400 cursor-pointer' />" .
                              "<p class='text-gray-800 line-clamp-4 font-semibold'>" . $dataEvent[0]['nama_penyelenggara'] . "</p>" .
                              "</div>" .
                        "</div>" .
                     "</div>" .
                     
                     "<div class='w-2/12'>" .
                        "<img src='" . $dataEvent[0]['foto'] . "' alt='" . $dataEvent[0]['nama_kegiatan'] . "' class='w-full'>" .
                     "</div>" .
               "</div>";
         } else {
            echo
            "<div class='flex lg:flex'>" .
                  "<div class='mr-10 w-7/12'>" .
                     "<div class='mt-4 flex flex-row gap-4'>" .
                        "<div class='basis-6/12'>" .
                           "<label class='text-gray-800 text-[15px] mb-2 block'>Nama Lengkap</label>" .
                           "<input name='nama_lengkap' id='nama_lengkap' type='text' disabled class='w-full text-sm text-gray-800 bg-gray-100 focus:bg-transparent px-4 py-3.5 rounded-md outline-blue-600' value='" . $dataMahasiswa[0]['nama_lengkap'] . "'/>" .
                        "</div>" .
                        "<div class='basis-3/12'>" .
                           "<label class='text-gray-800 text-[15px] mb-2 block'>NIM</label>" .
                           "<input name='nim' id='nim' type='text' disabled class='w-full text-sm text-gray-800 bg-gray-100 focus:bg-transparent px-4 py-3.5 rounded-md outline-blue-600' value='" . $dataMahasiswa[0]['nim'] . "'/>" .
                        "</div>" .
                        "<div class='basis-3/12'>" .
                           "<label class='text-gray-800 text-[15px] mb-2 block'>Program Studi</label>" .
                           "<input name='prodi' id='prodi' type='text' disabled class='w-full text-sm text-gray-800 bg-gray-100 focus:bg-transparent px-4 py-3.5 rounded-md outline-blue-600' value='" . $dataMahasiswa[0]['prodi'] . "'/>" .
                        "</div>" .
                     "</div>" .
                     
                     "<div class='flex flex-row gap-4'>" .
                        "<div class='basis-6/12 mt-4'>" .
                           "<label class='text-gray-800 text-[15px] mb-2 block'>Email</label>" .
                           "<input name='email' id='email' type='email' disabled class='w-full text-sm text-gray-800 bg-gray-100 focus:bg-transparent px-4 py-3.5 rounded-md outline-blue-600' value='" . $dataMahasiswa[0]['email'] . "'/>" .
                        "</div>" .
                        "<div class='basis-6/12 mt-4'>" .
                           "<label class='text-gray-800 text-[15px] mb-2 block'>Nomor Telepon</label>" .
                           "<input name='nomor_telepon' id='nomor_telepon' type='text' disabled class='w-full text-sm text-gray-800 bg-gray-100 focus:bg-transparent px-4 py-3.5 rounded-md outline-blue-600' value='" . $dataMahasiswa[0]['nomor_telepon'] . "'/>" .
                        "</div>" .
                     "</div>" .
                     
                     "<div class='flex flex-col mt-8 gap-y-4'>" .
                        "<div class=''>" .
                           "<p class='text-lg font-bold'>Total Bayar</p>" .
                           "<p class='font-semibold'>" . $dataEvent[0]['biaya'] . "</p>" .
                        "</div>" .
                        "<div class=''>" .
                           "<p class='text-lg font-bold'>Metode Pembayaran</p>" .
                           "<p class='font-semibold'>QRIS</p>" .
                        "</div>" .
                     "</div>" .
                     
                     "<a href='pembayaran.php?id=" . $_GET['id'] . "'>" .
                        "<button type='submit'
                        class='w-36 shadow-md mt-8 py-3 px-6 text-sm tracking-wide font-semibold rounded-md text-white bg-primary hover:bg-primaryHover focus:outline-none'>
                        Bayar
                        </button>" .
                     "</a>" .
                  "</div>" .
                  "<div class='mr-10 w-3/12'>" .
                     "<div class=''>" .
                        "<p class='text-lg font-bold text-primary'>" . $dataEvent[0]['kategori'] . "</p>" .
                        "<h2 class='text-3xl font-bold'>" . $dataEvent[0]['nama_kegiatan'] . "</h2>" .
                     "</div>" .
                     "<div class='mt-4 flex items-center'>" .
                        "<i class='fa-solid fa-calendar-days absolute'></i>" .
                        "<p class='font-semibold ms-6'>" . format_tanggal($dataEvent[0]['tanggal']) . "</p>" .
                     "</div>" .
                     "<div class='flex items-center'>" .
                        "<i class='fa-solid fa-clock absolute'></i>" .
                        "<p class='font-semibold ms-6'>" . date('H:i', $jam) . "</p>" .
                     "</div>" .
                     "<div class='flex items-center'>" .
                        "<i class='fa-solid fa-location-dot absolute'></i>" .
                        "<p class='font-semibold ms-6'>" . $dataEvent[0]['lokasi'] . "</p>" .
                     "</div>" .
                     "<div class='flex items-center'>" .
                        "<i class='fa-solid fa-sack-dollar absolute'></i>" .
                        "<p class='font-semibold ms-6'>" . $dataEvent[0]['biaya'] . "</p>" .
                     "</div>" .
                     "<div class='flex items-center'>" .
                        "<i class='fa-solid fa-user-group fa-sm absolute'></i>" .
                        "<span class='font-semibold ms-6'>" .
                           $dataEvent[0]['jumlah_peserta'] . " peserta</span>" .
                     "</div>" .
                     "<div class='mt-6 items-center'>
                        <p class='font-bold'>Deskripsi</p>
                        <p class='text-justify'>" . $dataEvent[0]['deskripsi_lengkap'] . "</p>" .
                     "</div>" .
                     "<div class='mt-12 items-center'>" .
                        "<p class='font-bold'>Penyelenggara</p>" .
                        "<div class='flex gap-x-3 items-center mt-2'>" .
                           "<img src='" . $dataEvent[0]['logo'] . "' alt='" . $dataEvent[0]['nama_penyelenggara'] . "'
                              class='w-6 h-6 rounded-full border border-gray-400 cursor-pointer' />" .
                           "<p class='text-gray-800 line-clamp-4 font-semibold'>" . $dataEvent[0]['nama_penyelenggara'] . "</p>" .
                           "</div>" .
                     "</div>" .
                  "</div>" .
                  
                  "<div class='w-2/12'>" .
                     "<img src='" . $dataEvent[0]['foto'] . "' alt='" . $dataEvent[0]['nama_kegiatan'] . "' class='w-full'>" .
                  "</div>" .
            "</div>";
         }

      ?>
</main>
<?php include("includes/footer.php") ?>