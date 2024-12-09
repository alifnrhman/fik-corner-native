<?php
   session_start();

   if(!isset($_SESSION['nama_penyelenggara'])) {
      header('location: login_penyelenggara');
   }
   
   $title = "Dashboard Penyelenggara";
   include("includes/header.php");
   include("includes/functions.php");
?>

<div class="relative bg-[#f7f6f9] h-full min-h-screen font-[sans-serif]">
   <div class="flex items-start">
      <?php include("includes/sidebar_penyelenggara.php") ?>

      <section class="main-content w-full px-8">
         <header class='z-50 bg-[#f7f6f9] sticky top-0 pt-8'>
            <div class='flex flex-wrap items-center w-full relative tracking-wide'>
               <div class='flex items-center gap-y-6 max-sm:flex-col z-50 w-full pb-2'>
                  <div class='flex items-center w-full px-4 bg-white shadow-sm min-h-[48px] sm:mr-20 rounded-md'>
                     <h1 class="text-gray-600 text-md lg:text-lg font-semibold font-sans">Dashboard Penyelenggara
                     </h1>
                  </div>

                  <div class="flex items-center justify-end gap-6 ml-auto">
                     <div class="w-1 h-10 border-l border-gray-400">
                     </div>
                     <div class="dropdown-menu relative flex shrink-0 group">
                        <div class="flex items-center gap-4">
                           <p class="text-gray-500 text-sm"><?= $_SESSION['nama_penyelenggara']; ?></p>
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
               <h2 class="text-gray-800 text-2xl max-sm:text-2xl font-bold mt-5 mb-10 text-center">
                  Form Pengajuan Kegiatan
               </h2>
               <div>
                  <form class="max-w-full max-md:mx-auto w-full px-24" action="process_pengajuan_kegiatan.php"
                     method="post" enctype="multipart/form-data">
                     <div class="flex flex-row gap-4">
                        <div class="basis-3/5">
                           <label class="text-gray-800 text-[15px] mb-2 block">Nama Kegiatan</label>
                           <input name="nama_kegiatan" type="text" required
                              class="w-full text-sm text-gray-800 bg-white px-4 py-3.5 rounded-md outline-primary border border-gray-300"
                              placeholder="Masukkan nama kegiatan" maxlength="100" />
                        </div>

                        <div class="basis-2/5">
                           <label class="text-gray-800 text-[15px] mb-2 block">Kategori Kegiatan</label>
                           <select name="kategori"
                              class="w-full text-sm text-gray-800 bg-white px-4 py-3.5 rounded-md outline-primary border border-gray-300"
                              required>
                              <option value="" selected disabled>-- Pilih Kategori Kegiatan --</option>
                              <option value="1">Seminar</option>
                              <option value="2">Webinar</option>
                              <option value="3">Lomba</option>
                           </select>
                        </div>
                     </div>

                     <div class="flex flex-row gap-4">

                        <div class="basis-4/12 mt-4">
                           <label class="text-gray-800 text-[15px] mb-2 block">Deskripsi Singkat</label>
                           <textarea name="deskripsi_singkat" rows="3"
                              class="w-full text-sm text-gray-800 bg-white px-4 py-3.5 rounded-md outline-primary border border-gray-300 resize-none"
                              placeholder="Masukkan deskripsi singkat" required></textarea>
                        </div>

                        <div class="basis-8/12 mt-4">
                           <label class="text-gray-800 text-[15px] mb-2 block">Deskripsi Lengkap</label>
                           <textarea name="deskripsi_lengkap" rows="3"
                              class="w-full text-sm text-gray-800 bg-white px-4 py-3.5 rounded-md outline-primary border border-gray-300 resize-y"
                              placeholder="Masukkan deskripsi lengkap" required></textarea>
                        </div>
                     </div>

                     <div class="flex flex-row gap-4">
                        <div class="basis-2/12 mt-4">
                           <label class="text-gray-800 text-[15px] mb-2 block">Tanggal</label>
                           <input name="tanggal" id="tanggal" type="date" required
                              class="w-full text-sm text-gray-800 bg-white px-4 py-3.5 rounded-md outline-primary border border-gray-300"
                              placeholder="Masukkan nama penanggung jawab" />
                        </div>

                        <div class="basis-1/12 mt-4">
                           <label class="text-gray-800 text-[15px] mb-2 block">Waktu</label>
                           <input name="waktu" id="waktu" type="time" required
                              class="w-full text-sm text-gray-800 bg-white px-4 py-3.5 rounded-md outline-primary border border-gray-300"
                              placeholder="Contoh: 081234567890" />
                        </div>

                        <div class="basis-3/12 mt-4">
                           <label class="text-gray-800 text-[15px] mb-2 block">Lokasi</label>
                           <input name="lokasi" id="text" type="text" required
                              class="w-full text-sm text-gray-800 bg-white px-4 py-3.5 rounded-md outline-primary border border-gray-300"
                              placeholder="Masukkan lokasi" />
                        </div>

                        <div class="basis-2/12 mt-4">
                           <label class="text-gray-800 text-[15px] mb-2 block">Biaya</label>
                           <input name="biaya" id="biaya" type="number" required
                              class="w-full text-sm text-gray-800 bg-white px-4 py-3.5 rounded-md outline-primary border border-gray-300"
                              placeholder="Contoh: 25000" />
                        </div>

                        <div class="basis-4/12 mt-4">
                           <label class="text-gray-800 text-[15px] mb-2 block">Foto</label>
                           <input type="file" name="foto" id="foto" required
                              class="w-full text-gray-400 font-semibold text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-white file:hover:bg-gray-200 file:text-gray-500 rounded"
                              accept=".png, .jpg, .jpeg" />
                           <p class="text-xs text-gray-400 mt-2">Format PNG, JPG, atau JPEG (maks. 10MB).</p>
                        </div>
                     </div>

                     <div class="justify-end mt-8 flex w-full gap-x-5">
                        <button type="reset"
                           class="py-3 px-10 text-sm tracking-wide font-semibold rounded-md text-primary bg-[#f7f6f9] hover:bg-primaryHover hover:text-white focus:outline-none transition-all duration-300 border-2 border-primary">
                           Reset
                        </button>
                        <button type="submit"
                           class="shadow-md py-3 px-10 text-sm tracking-wide font-semibold rounded-md text-white bg-primary hover:bg-primaryHover focus:outline-none">
                           Kirim Pengajuan
                        </button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>
   </div>
</div>

<?php include("includes/admin_footer.php") ?>