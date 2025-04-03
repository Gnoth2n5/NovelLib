import "./bootstrap";

const toggle = document.getElementById("theme-toggle");
const html = document.documentElement;

// Khôi phục theme từ localStorage (nếu có)
const savedTheme = localStorage.getItem("theme") || "light";
html.setAttribute("data-theme", savedTheme);
if (savedTheme === "dark") toggle.checked = true;

// Xử lý sự kiện chuyển đổi
toggle.addEventListener("change", () => {
    const newTheme = toggle.checked ? "dark" : "light";
    html.setAttribute("data-theme", newTheme);
    localStorage.setItem("theme", newTheme);
}); 
