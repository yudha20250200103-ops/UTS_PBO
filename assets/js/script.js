document.addEventListener("DOMContentLoaded", () => {
  const passwordInput = document.querySelector("#password");
  const passwordToggle = document.querySelector("#togglePassword");

  if (passwordInput && passwordToggle) {
    passwordToggle.addEventListener("click", () => {
      const shouldShow = passwordInput.type === "password";
      passwordInput.type = shouldShow ? "text" : "password";
      passwordToggle.setAttribute("aria-pressed", String(shouldShow));
      passwordToggle.setAttribute(
        "aria-label",
        shouldShow ? "Sembunyikan password" : "Tampilkan password",
      );
      passwordToggle.innerHTML = shouldShow
        ? '<i class="fa-regular fa-eye-slash"></i>'
        : '<i class="fa-regular fa-eye"></i>';
    });
  }

  const sidebar = document.querySelector("#sidebar");
  const sidebarToggle = document.querySelector("#sidebarToggle");
  const sidebarOverlay = document.querySelector("#sidebarOverlay");

  if (sidebar && sidebarToggle && sidebarOverlay) {
    const closeSidebar = () => {
      sidebar.classList.remove("sidebar-open");
      sidebarOverlay.classList.remove("overlay-visible");
      document.body.classList.remove("sidebar-visible");
    };

    sidebarToggle.addEventListener("click", () => {
      const isOpen = sidebar.classList.toggle("sidebar-open");
      sidebarOverlay.classList.toggle("overlay-visible", isOpen);
      document.body.classList.toggle("sidebar-visible", isOpen);
    });

    sidebarOverlay.addEventListener("click", closeSidebar);
    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") closeSidebar();
    });
  }
});
