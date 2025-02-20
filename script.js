document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("container");
    const registerBtn = document.getElementById("register");
    const loginBtn = document.getElementById("login");
    const adminBtn = document.getElementById("adminBtn");
    const signupForm = document.getElementById("signup-form");
    const loginForm = document.getElementById("login-form");

    // Toggle Sign-up / Sign-in form
    registerBtn.addEventListener("click", () => container.classList.add("active"));
    loginBtn.addEventListener("click", () => container.classList.remove("active"));

    // Admin Button Click - Redirect to Admin Login Page
    if (adminBtn) {
        adminBtn.addEventListener("click", () => {
            console.log("Admin Login Clicked! Redirecting...");
            window.location.href = "admin_login.html"; // Ensure this file exists
        });
    }

    // Handle Sign-Up Form Submission
    if (signupForm) {
        signupForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const name = document.getElementById("signup-name").value.trim();
            const email = document.getElementById("signup-email").value.trim();
            const password = document.getElementById("signup-password").value.trim();

            if (!name || !email || !password) {
                alert("All fields are required.");
                return;
            }

            // Creating form data for signup
            const formData = new FormData();
            formData.append("name", name);
            formData.append("email", email);
            formData.append("password", password);

            fetch("signup.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert("Sign-up successful! You can now log in.");
                    container.classList.remove("active"); // Switch to login form
                    signupForm.reset(); // Clear the form
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred during sign-up. Please try again.");
            });
        });
    }

    // Handle Login Form Submission
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const email = document.getElementById("login-email").value.trim();
            const password = document.getElementById("login-password").value.trim();

            if (!email || !password) {
                alert("Email and Password are required.");
                return;
            }

            // Creating form data for login
            const formData = new FormData();
            formData.append("email", email);
            formData.append("password", password);

            fetch("login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "faculty") {
                    window.location.href = "faculty.html"; // Faculty Page
                } else if (data.trim() === "student") {
                    window.location.href = "studentnew.php"; // Student Page
                } else {
                    alert("Invalid Email or Password.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred during login. Please try again.");
            });
        });
    }
});