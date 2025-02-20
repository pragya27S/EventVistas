<?php
// Start session if needed (for future authentication features)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <style>
        /* Enhanced Student Portal Styles */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #F8FAFC;
    color: #1E293B;
    transition: all 0.3s ease;
    scroll-behavior: smooth;
}

/* Glassmorphism Header */
header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(135deg, rgba(30, 58, 138, 0.95), rgba(37, 99, 235, 0.9));
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    padding: 15px 20px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
    position: sticky;
    top: 0;
    z-index: 100;
    transition: all 0.4s ease;
    border-bottom: 2px solid rgba(255, 255, 255, 0.1);
}

/* Animated Logo */
.logo {
    width: 40px;
    height: 40px;
    background-color: white;
    border-radius: 50%;
    margin-right: 20px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
    animation: pulse 3s infinite alternate;
}

@keyframes pulse {
    0% { transform: scale(1); }
    100% { transform: scale(1.1); }
}

/* Navigation */
nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}



.nav-links {
    display: flex;
    gap: 30px;
    align-items: center;
    list-style: none;

}

.nav-btn {
    text-decoration: none;
    padding: 10px 16px;
    background: linear-gradient(135deg, #3B82F6, #2563EB);
    color: white;
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    font-weight: 500;
    font-size: 15px;
    display: inline-block;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.nav-btn:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 15px rgba(37, 99, 235, 0.4);
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, rgba(30, 41, 59, 0.95), rgba(15, 23, 42, 0.98));
    padding: 60px 20px;
    text-align: center;
    position: relative;
    overflow: hidden;
    border-radius: 0 0 30px 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    color: white;
}

.stats-container {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-top: 2rem;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.stat-item {
    text-align: center;
    padding: 1rem 2rem;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 700;
    color: #FACC15;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    color: #E2E8F0;
    text-transform: uppercase;
}

/* News Ticker */
.news-ticker {
    background: linear-gradient(90deg, #1E293B, #334155, #1E293B);
    padding: 12px;
    margin: 20px 0;
    overflow: hidden;
    position: relative;
}

.ticker-content {
    white-space: nowrap;
    animation: ticker 20s linear infinite;
    display: inline-block;
}

@keyframes ticker {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}

/* Event Cards */
.events-section {
    padding: 40px 20px;
}

.event-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin-top: 30px;
}

.event-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 300px;
    transition: transform 0.3s ease;
    margin: auto;
    margin-top: 20px;
    margin-right: 20px;
    display: inline-block;
    text-align: center;
}

.event-card:hover {
    transform: translateY(-10px);
}

.event-date {
    background: linear-gradient(135deg, #3B82F6, #2563EB);
    color: white;
    padding: 15px;
    text-align: center;
}

.event-details {
    padding: 20px;
}

/* Gallery Slider Styles */
.gallery-section {
    text-align: center;
    padding: 40px 20px;
}

.slider-container {
    position: relative;
    max-width: 600px; /* Adjust width as needed */
    margin: auto;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.slider {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.slider img {
    width: 100%;
    height: 350px; /* Adjust height as needed */
    object-fit: cover;
    border-radius: 12px;
}

/* Navigation Buttons */
.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    cursor: pointer;
    padding: 10px 15px;
    font-size: 18px;
    border-radius: 50%;
}

.prev { left: 10px; }
.next { right: 10px; }

.prev:hover, .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

/* Responsive */
@media (max-width: 768px) {
    .slider-container {
        max-width: 90%;
    }

    .slider img {
        height: 250px;
    }
}

/* Footer */
footer {
    background: linear-gradient(to right, #0F172A, #1E293B, #0F172A);
    color: white;
    text-align: center;
    padding: 20px 0;
    margin-top: 40px;
    position: relative;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stats-container {
        flex-direction: column;
        gap: 1rem;
    }
    
    .event-card {
        width: 100%;
        max-width: 300px;
    }
}

    </style>
    <script>
        // Initialize animations when document is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Animate statistics numbers
    const stats = document.querySelectorAll('.stat-value');
    stats.forEach(stat => {
        const targetValue = parseInt(stat.getAttribute('data-value'));
        animateNumber(stat, targetValue);
    });

    // Initialize news ticker spacing
    initNewsTicker();
});

// Animate numbers function
function animateNumber(element, target) {
    let current = 0;
    const duration = 2000; // 2 seconds
    const stepTime = 20; // Update every 20ms
    const steps = duration / stepTime;
    const increment = target / steps;

    const timer = setInterval(() => {
        current += increment;
        element.textContent = Math.round(current);

        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        }
    }, stepTime);
}

// Initialize news ticker
function initNewsTicker() {
    const ticker = document.querySelector('.ticker-content');
    const spans = ticker.getElementsByTagName('span');
    
    // Add spacing between ticker items
    Array.from(spans).forEach(span => {
        span.style.marginRight = '50px';
    });

    // Clone ticker content for smooth infinite scroll
    ticker.innerHTML += ticker.innerHTML;
}

// Smooth scroll for navigation
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Event card hover effects
const eventCards = document.querySelectorAll('.event-card');
eventCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px)';
    });

    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});

// Register button click handler
const registerButtons = document.querySelectorAll('.register-btn');
registerButtons.forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const eventTitle = this.closest('.event-card').querySelector('h3').textContent;
        alert(`Registration processing for: ${eventTitle}`);
        // Here you would typically handle the registration process
    });
});

// Header scroll effect
let lastScroll = 0;
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    const currentScroll = window.pageYOffset;

    if (currentScroll > lastScroll && currentScroll > 100) {
        header.style.transform = 'translateY(-100%)';
    } else {
        header.style.transform = 'translateY(0)';
    }

    lastScroll = currentScroll;
});

// Initialize dropdown functionality
document.addEventListener('click', function(e) {
    const dropdowns = document.querySelectorAll('.dropdown-content');
    dropdowns.forEach(dropdown => {
        if (!e.target.closest('.dropdown')) {
            dropdown.style.display = 'none';
        }
    });
});

// Gallery Slider Script
let currentIndex = 0;
const slides = document.querySelectorAll(".slider img");
const totalSlides = slides.length;

function showSlide(index) {
    if (index >= totalSlides) currentIndex = 0;
    else if (index < 0) currentIndex = totalSlides - 1;
    else currentIndex = index;

    const newTransformValue = -currentIndex * 100 + "%";
    document.querySelector(".slider").style.transform = "translateX(" + newTransformValue + ")";
}

function nextSlide() {
    showSlide(currentIndex + 1);
}

function prevSlide() {
    showSlide(currentIndex - 1);
}

// Auto-slide every 5 seconds
setInterval(nextSlide, 5000);


document.querySelectorAll('.dropbtn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.stopPropagation();
        const content = this.nextElementSibling;
        document.querySelectorAll('.dropdown-content').forEach(dropdown => {
    </script>
</head>
<body>
<header>
  <nav style="display: flex; align-items: center; justify-content: space-between; padding: 10px 20px; background-color: rgb(49, 119, 230);">
    <!-- Logo inside a circular frame -->
    <div class="logo" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; background-color: white;">
      <img src="eventvista--logo.png" alt="Logo" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    
    <!-- Header title -->
    <h2 style="margin-left: 120px; color: white;">Student Portal</h2>
    
    <!-- Navigation links -->
    <ul class="nav-links" style="list-style: none; display: flex; gap: 20px; margin: 0; padding: 0;">
      <li><a href="#home" style="text-decoration: none; color: white; font-weight: bold;">Home</a></li>
      <li><a href="#events" style="text-decoration: none; color: white; font-weight: bold;">Events</a></li>
      <li><a href="#gallery" style="text-decoration: none; color: white; font-weight: bold;">Gallery</a></li>
      <li><a href="contact.html" style="text-decoration: none; color: white; font-weight: bold;">Contact</a></li>
    </ul>
  </nav>
</header>



    <main>
        <section id="home" class="welcome-section">
            <h1 style="margin-left:620px;" >Welcome, Student</h1>
            <p style="margin-left:500px;">Access your academic information and campus updates here.</p>
        </section>

        <section id="events" class="events-section">
            <h2>Upcoming Events</h2>
            <?php include 'student_fetch_events.php'; ?>
        </section>

        <section id="gallery" class="gallery-section">
    <h2>Campus Gallery</h2>
    <div class="slider-container">
        <div class="slider">
            <img src="image.png" alt="Main Building">
            <img src="background.png" alt="Library">
            <img src="image.png" alt="Sports Complex">
            <img src="image.png" alt="Auditorium">
        </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
    </div>
</section>
    </main>

    <footer>
        <p>Student Portal - Your Academic Gateway</p>
        <p>&copy; 2025 All rights reserved</p>
    </footer>
</body>
</html>