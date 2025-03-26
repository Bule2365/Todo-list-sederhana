// Show loader on form submission
document.addEventListener("DOMContentLoaded", function () {
  const forms = document.querySelectorAll("form");
  forms.forEach((form) => {
    form.addEventListener("submit", function () {
      const button = this.querySelector('button[type="submit"]');
      const loader = document.createElement("span");
      loader.classList.add("loader");
      button.disabled = true;
      button.appendChild(loader);

      // Simulasi proses async (ganti dengan fetch jika ada API)
      setTimeout(() => {
        button.removeChild(loader);
        button.disabled = false;
      }, 3000); // Sesuaikan waktu timeout dengan kebutuhan
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  let completeModal = document.getElementById("confirmCompleteModal");
  completeModal.addEventListener("show.bs.modal", function (event) {
    let button = event.relatedTarget;
    let taskId = button.getAttribute("data-id");
    let taskText = button.getAttribute("data-task");

    document.getElementById("completeTaskId").value = taskId;
    document.getElementById("completeTaskText").value = taskText;
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const toggle = document.getElementById("darkModeToggle");
  const body = document.body;

  // Cek local storage
  if (localStorage.getItem("darkMode") === "enabled") {
    body.classList.add("dark-mode");
    toggle.checked = true;
  } else {
    body.classList.remove("dark-mode");
    toggle.checked = false;
  }

  // Tambahkan event listener untuk toggle
  toggle.addEventListener("change", function () {
    if (toggle.checked) {
      body.classList.add("dark-mode");
      localStorage.setItem("darkMode", "enabled");
    } else {
      body.classList.remove("dark-mode");
      localStorage.setItem("darkMode", "disabled");
    }
  });
});
