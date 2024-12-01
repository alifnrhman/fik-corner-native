// Toggle password visibility
function togglePassword() {
   var x = document.getElementById("password");
   if (x.type === "password") {
      x.type = "text";
   } else {
      x.type = "password";
   }
}

// Navbar responsive button
var toggleOpen = document.getElementById("toggleOpen");
var toggleClose = document.getElementById("toggleClose");
var collapseMenu = document.getElementById("collapseMenu");

function handleClick() {
   if (collapseMenu.style.display === "block") {
      collapseMenu.style.display = "none";
   } else {
      collapseMenu.style.display = "block";
   }
}
toggleOpen.addEventListener("click", handleClick);
toggleClose.addEventListener("click", handleClick);

// Admin dashboard
document.addEventListener("DOMContentLoaded", () => {
   // Sidebar
   document.querySelectorAll("#sidebar ul > li > .menu-item").forEach((item) => {
      item.addEventListener("click", () => {
         // Remove classes from all menu items
         document.querySelectorAll("#sidebar ul > li > .menu-item").forEach((otherItem) => {
            otherItem.classList.remove("bg-[#d9f3ea]", "text-green-700");
            otherItem.classList.add("text-gray-800");
         });

         // Add classes to the clicked item
         item.classList.add("bg-[#d9f3ea]", "text-green-700");
         item.classList.remove("text-gray-800");
      });
   });

   let sidebarToggleBtn = document.getElementById("toggle-sidebar");
   let sidebarCollapseMenu = document.getElementById("sidebar-collapse-menu");

   sidebarToggleBtn.addEventListener("click", () => {
      if (!sidebarCollapseMenu.classList.contains("open")) {
         sidebarCollapseMenu.classList.add("open");
         sidebarCollapseMenu.style.cssText = "width: 250px; visibility: visible; opacity: 1;";
         sidebarToggleBtn.style.cssText = "left: 236px;";
      } else {
         sidebarCollapseMenu.classList.remove("open");
         sidebarCollapseMenu.style.cssText = "width: 32px; visibility: hidden; opacity: 0;";
         sidebarToggleBtn.style.cssText = "left: 10px;";
      }
   });
});

//Dark mode
let darkMode = localStorage.getItem('dark-mode');

const enableDarkMode = () =>{
   toggleBtn.classList.replace('fa-sun', 'fa-moon');
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   toggleBtn.classList.replace('fa-moon', 'fa-sun');
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enableDarkMode();
}

toggleBtn.onclick = (e) =>{
   darkMode = localStorage.getItem('dark-mode');
   if(darkMode === 'disabled'){
      enableDarkMode();
   }else{
      disableDarkMode();
   }
}