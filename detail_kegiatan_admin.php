<?php
   session_start();

   include("includes/functions.php");

   $columns = "kegiatan.*, kategori_kegiatan.kategori, penyelenggara.nama_penyelenggara, penyelenggara.logo";
   $table = "kegiatan";
   $join = "
      LEFT JOIN kategori_kegiatan ON kegiatan.id_kategori = kategori_kegiatan.id_kategori 
      LEFT JOIN penyelenggara ON kegiatan.id_penyelenggara = penyelenggara.id_penyelenggara
   ";
   $where = "id_kegiatan = " . $_GET['id'];
   $orderBy = "";
   $limit = "";

   // Mengambil data
   $data = get_data($connection, $columns, $table, $join, $where, $orderBy, $limit);
   
   if($data[0]['biaya'] === null) {
      $data[0]['biaya'] = "Gratis";
   } else {
      $data[0]['biaya'] = "Rp" . number_format($data[0]['biaya'], 2, ',', '.');
   }

   $jam = strtotime($data[0]['waktu']);
   $title = $data[0]['nama_kegiatan'];

   include("includes/header.php");
?>

<div class="relative bg-[#f7f6f9] h-full min-h-screen font-[sans-serif]">
   <div class="flex items-start">
      <?php include("includes/sidebar_admin.php") ?>

      <section class="main-content w-full px-8">
         <header class='z-50 bg-[#f7f6f9] sticky top-0 pt-8'>
            <div class='flex flex-wrap items-center w-full relative tracking-wide'>
               <div class='flex items-center gap-y-6 max-sm:flex-col z-50 w-full pb-2'>
                  <div class='flex items-center w-full px-4 bg-white shadow-sm min-h-[48px] sm:mr-20 rounded-md'>
                     <h1 class="text-gray-600 text-md lg:text-lg font-semibold font-sans">Dashboard Admin
                     </h1>
                  </div>

                  <div class="flex items-center justify-end gap-6 ml-auto">
                     <div class="w-1 h-10 border-l border-gray-400">
                     </div>
                     <div class="dropdown-menu relative flex shrink-0 group">
                        <div class="flex items-center gap-4">
                           <p class="text-gray-500 text-sm"><?= $_SESSION['nama']; ?></p>
                           <img src="assets\default_pfp.svg" alt="profile-pic"
                              class="w-[38px] h-[38px] rounded-full border-2 border-gray-300 cursor-pointer" />
                        </div>

                        <div
                           class="dropdown-content hidden group-hover:block shadow-md p-2 bg-white rounded-md absolute top-[38px] right-0 w-56">
                           <div class="w-full space-y-2">
                              <a href="javascript:void(0)"
                                 class="text-sm text-gray-800 cursor-pointer flex items-center p-2 rounded-md hover:bg-secondary dropdown-item transition duration-300 ease-in-out">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] mr-4 fill-current"
                                    viewBox="0 0 512 512">
                                    <path
                                       d="M437.02 74.98C388.668 26.63 324.379 0 256 0S123.332 26.629 74.98 74.98C26.63 123.332 0 187.621 0 256s26.629 132.668 74.98 181.02C123.332 485.37 187.621 512 256 512s132.668-26.629 181.02-74.98C485.37 388.668 512 324.379 512 256s-26.629-132.668-74.98-181.02zM111.105 429.297c8.454-72.735 70.989-128.89 144.895-128.89 38.96 0 75.598 15.179 103.156 42.734 23.281 23.285 37.965 53.687 41.742 86.152C361.641 462.172 311.094 482 256 482s-105.637-19.824-144.895-52.703zM256 269.507c-42.871 0-77.754-34.882-77.754-77.753C178.246 148.879 213.13 114 256 114s77.754 34.879 77.754 77.754c0 42.871-34.883 77.754-77.754 77.754zm170.719 134.427a175.9 175.9 0 0 0-46.352-82.004c-18.437-18.438-40.25-32.27-64.039-40.938 28.598-19.394 47.426-52.16 47.426-89.238C363.754 132.34 315.414 84 256 84s-107.754 48.34-107.754 107.754c0 37.098 18.844 69.875 47.465 89.266-21.887 7.976-42.14 20.308-59.566 36.542-25.235 23.5-42.758 53.465-50.883 86.348C50.852 364.242 30 312.512 30 256 30 131.383 131.383 30 256 30s226 101.383 226 226c0 56.523-20.86 108.266-55.281 147.934zm0 0"
                                       data-original="#000000"></path>
                                 </svg>
                                 Akun Saya</a>
                              <hr class="my-2 -mx-2" />
                              <a href="process_logout.php"
                                 class="text-sm text-gray-800 cursor-pointer flex items-center p-2 rounded-md hover:bg-secondary dropdown-item transition duration-300 ease-in-out">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] mr-4 fill-current"
                                    viewBox="0 0 6 6">
                                    <path
                                       d="M3.172.53a.265.266 0 0 0-.262.268v2.127a.265.266 0 0 0 .53 0V.798A.265.266 0 0 0 3.172.53zm1.544.532a.265.266 0 0 0-.026 0 .265.266 0 0 0-.147.47c.459.391.749.973.749 1.626 0 1.18-.944 2.131-2.116 2.131A2.12 2.12 0 0 1 1.06 3.16c0-.65.286-1.228.74-1.62a.265.266 0 1 0-.344-.404A2.667 2.667 0 0 0 .53 3.158a2.66 2.66 0 0 0 2.647 2.663 2.657 2.657 0 0 0 2.645-2.663c0-.812-.363-1.542-.936-2.03a.265.266 0 0 0-.17-.066z"
                                       data-original="#000000" />
                                 </svg>
                                 Keluar</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header>

         <div class="bg-gray-100 pt-5 font-sans">
            <div class="max-w-full max-lg:max-w-3xl max-md:max-w-sm mx-auto">
               <div class="mt-8 mb-5 flex items-center gap-x-3">
                  <a href='<?php echo $_SERVER['HTTP_REFERER'] ?>'>
                     <i class='fa-solid fa-arrow-left-long fa-lg cursor-pointer'></i>
                  </a>
                  <h1 class="font-bold text-xl">Kembali</h1>
               </div>
               <div class="container block lg:flex">
                  <div class="mr-10">
                     <img src="<?= $data[0]['foto'] ?>" alt="<?= $data[0]['nama_kegiatan'] ?>" class="w-96">
                  </div>
                  <div>
                     <div class="">
                        <p class="text-lg font-bold text-primary"><?= $data[0]['kategori'] ?></p>
                        <h2 class="text-3xl font-bold"><?= $data[0]['nama_kegiatan'] ?></h2>
                     </div>
                     <div class="mt-4 flex items-center">
                        <i class="fa-solid fa-calendar-days absolute"></i>
                        <p class="font-semibold ms-6"><?= format_tanggal($data[0]['tanggal']) ?></p>
                     </div>
                     <div class="flex items-center">
                        <i class="fa-solid fa-clock absolute"></i>
                        <p class="font-semibold ms-6"><?= date("H:i", $jam) ?></p>
                     </div>
                     <div class="flex items-center">
                        <i class="fa-solid fa-location-dot absolute"></i>
                        <p class="font-semibold ms-6"><?= $data[0]['lokasi'] ?></p>
                     </div>
                     <div class="flex items-center">
                        <i class="fa-solid fa-sack-dollar absolute"></i>
                        <p class="font-semibold ms-6"><?= $data[0]['biaya'] ?></p>
                     </div>
                     <div class="mt-6 items-center">
                        <p class="font-bold">Deskripsi Singkat</p>
                        <p class="text-justify"><?= $data[0]['deskripsi_singkat'] ?></p>
                     </div>
                     <div class="mt-6 items-center">
                        <p class="font-bold">Deskripsi Lengkap</p>
                        <p class="text-justify"><?= $data[0]['deskripsi_lengkap'] ?></p>
                     </div>
                     <div class="mt-6 items-center">
                        <p class="font-bold">Diajukan Pada</p>
                        <p class="text-justify"><?= $data[0]['posted_at'] ?></p>
                     </div>
                     <div class="mt-12 items-center">
                        <p class="font-bold">Penyelenggara</p>
                        <?= 
                           "<div class='flex gap-x-3 items-center mt-2'>" .
                              "<img src='" . $data[0]['logo'] . "' alt='" . $data[0]['nama_penyelenggara'] . "' class='w-6 h-6 rounded-full border border-gray-400 cursor-pointer' />" .
                              "<p class='text-gray-800 line-clamp-4 font-semibold'>" . $data[0]['nama_penyelenggara'] . "</p>" .
                           "</div>";
                        ?>
                     </div>
                     <div class="flex mt-8 gap-x-5">
                        <?php 
                           $data = get_data(
                              $connection,
                              "*",
                              "kegiatan",
                              "",
                              "id_kegiatan = " . $_GET['id'],
                              "kegiatan.posted_at ASC"
                           );
                           
                           if ($data[0]['status'] == "Pending") {
                           echo
                              "<a href='verifikasi_kegiatan.php?id=" . $_GET['id'] . "'>
                                 <button type='submit'
                                    class='w-40 shadow-md py-3 px-6 text-sm tracking-wide font-semibold rounded-md text-white bg-primary hover:bg-primaryHover focus:outline-none'>
                                    <i class='fa-solid fa-check mr-1'></i>
                                    Verifikasi
                                 </button>
                              </a>" .

                              "<a href='tolak_kegiatan.php?id=" . $_GET['id'] . "'>
                                 <button type='submit'
                                    class='w-40 shadow-sm py-3 px-6 text-sm tracking-wide font-semibold rounded-md text-primary bg-white hover:bg-primaryHover hover:text-white focus:outline-none transition-all duration-300'>
                                    <i class='fa-solid fa-xmark mr-1'></i>
                                    Tolak
                                 </button>
                              </a>";
                           }
                        ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</div>

<?php include("includes/admin_footer.php") ?>