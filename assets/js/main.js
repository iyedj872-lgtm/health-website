document.addEventListener("DOMContentLoaded", function () {

    // ===========================
    // Navbar toggle for mobile
    // ===========================
    const navToggle = document.getElementById("navToggle");
    const navMenu = document.getElementById("navMenu");
    /*const redirect=addEventListener("")*/

    if (navToggle && navMenu) {
        navToggle.addEventListener("click", function () {
            navMenu.classList.toggle("show");
        });
    }

    // ===========================
    // Smooth scrolling for anchors
    // ===========================
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth" });
            }
        });
    });

    // ===========================
    // Global alert/toast function
    // ===========================
    window.showAlert = function(message, type = "success") {
        const alertDiv = document.createElement("div");
        alertDiv.className = `alert alert-${type}`;
        alertDiv.textContent = message;
        alertDiv.style.position = "fixed";
        alertDiv.style.top = "20px";
        alertDiv.style.right = "20px";
        alertDiv.style.zIndex = "1000";
        alertDiv.style.padding = "10px 20px";
        alertDiv.style.borderRadius = "10px";
        alertDiv.style.boxShadow = "0 4px 10px rgba(0,0,0,0.2)";
        document.body.appendChild(alertDiv);

        setTimeout(() => {
            alertDiv.remove();
        }, 3000);
    };

    // ===========================
    // Example usage of showAlert
    // ===========================
    // showAlert("Welcome to your Health Tracker!", "success");

    // ===========================
    // Add more global functions here
    // ===========================

});