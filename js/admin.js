// Admin Sidebar
document.addEventListener("DOMContentLoaded", () => {
   // Tab functionality
   const tabs = document.querySelectorAll(".tab");
   tabs.forEach((tab) => {
      tab.addEventListener("click", () => {
         const targetId = tab.getAttribute("data-target");
         document.querySelectorAll(".tab-content").forEach((content) => {
            content.classList.add("hidden");
         });
         document.getElementById(targetId).classList.remove("hidden");

         // Add active class to the clicked tab
         tab.classList.add("text-white", "font-bold", "bg-primary", "hover:bg-gray-50");
         tab.classList.remove("text-gray-600", "font-semibold", "bg-white", "hover:bg-gray-50");
      });
   });

   // Sidebar
   const currentPath = window.location.pathname;
   const menuItems = document.querySelectorAll(".menu-item");

   menuItems.forEach((item) => {
      const href = item.getAttribute("href");

      if (href && (currentPath === `/${href}` || currentPath.includes(href))) {
         item.classList.remove("text-gray-800");
         item.classList.add("text-primary", "font-semibold", "bg-secondary");
      } else {
         item.classList.add("text-gray-800");
         item.classList.remove("text-primary", "font-semibold", "bg-secondary");
      }
   });
});
