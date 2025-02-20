document.addEventListener("DOMContentLoaded", function () {

    // Admin Login Handling
    document.querySelector("#adminLoginForm")?.addEventListener("submit", function (event) {
        event.preventDefault();
        
        const adminID = document.querySelector("#adminID").value;
        const adminPassword = document.querySelector("#adminPassword").value;

        // Hardcoded Admin Credentials
        const validAdminID = "admin";
        const validAdminPassword = "password123";

        if (adminID === validAdminID && adminPassword === validAdminPassword) {
            alert("Admin login successful!");
            window.location.href = "admin_dashboard.html"; // Redirect to Admin Dashboard
        } else {
            alert("Invalid Admin ID or Password");
        }
    });

    // Faculty Registration Handling
    document.querySelector("#facultyRegisterForm")?.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch("faculty_register.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "success") {
                alert("Faculty registered successfully!");
                this.reset(); // Clear form after success
            } else {
                alert("Error: " + data);
            }
        })
        .catch(error => console.error("Error:", error));
    });

});
