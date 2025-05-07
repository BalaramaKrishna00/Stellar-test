<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body class="dark">
  <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <svg class="h-10 w-10 text-indigo-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <a href="https://dev-krishnaprojects.pantheonsite.io/" class="ml-3 text-xl font-bold">Nexus Digital</a>

            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="https://dev-krishnaprojects.pantheonsite.io/#Introtext" class="hover:text-indigo-500 transition-colors">Home</a>
                <a href="https://dev-krishnaprojects.pantheonsite.io/#projects" class="hover:text-indigo-500 transition-colors">Projects</a>
                <a href="https://dev-krishnaprojects.pantheonsite.io/#services" class="hover:text-indigo-500 transition-colors">Services</a>
                <a href="https://dev-krishnaprojects.pantheonsite.io/#Clients" class="hover:text-indigo-500 transition-colors">About</a>
                <a href="https://dev-krishnaprojects.pantheonsite.io/#Contact" class="hover:text-indigo-500 transition-colors">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
            <div class="theme-toggle" id="themeToggle">
                    <i class="fas fa-moon text-xl"></i>
                </div>
                <button class="hidden md:block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-full transition-colors">
                    Get in Touch
                </button>
                <div class="md:hidden">
                    <button id="mobileMenuButton" class="text-2xl">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="mobileMenu" class="hidden md:hidden absolute w-full bg-dark-card dark:bg-dark-card light:bg-light-card">
            <div class="container mx-auto px-4 py-4 flex flex-col space-y-4">
                <a href="https://dev-krishnaprojects.pantheonsite.io/#Introtext" class="hover:text-indigo-500 transition-colors py-2">Home</a>
                <a href="https://dev-krishnaprojects.pantheonsite.io/#projects" class="hover:text-indigo-500 transition-colors py-2">Projects</a>
                <a href="https://dev-krishnaprojects.pantheonsite.io/#services" class="hover:text-indigo-500 transition-colors py-2">Services</a>
                <a href="https://dev-krishnaprojects.pantheonsite.io/#Clients" class="hover:text-indigo-500 transition-colors py-2">About</a>
                <a href="https://dev-krishnaprojects.pantheonsite.io/#Contact" class="hover:text-indigo-500 transition-colors py-2">Contact</a>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-full transition-colors">
                    Get in Touch
                </button>
            </div>
        </div>
    </nav>
    <script>
function initThemeToggle() {
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;
    const icon = themeToggle.querySelector('i');
    const savedTheme = localStorage.getItem('theme') || 'dark';
    body.className = savedTheme;
    updateThemeIcon(savedTheme === 'dark');
    
    themeToggle.addEventListener('click', () => {
        const isDark = body.classList.contains('dark');
        body.className = isDark ? 'light' : 'dark';
        updateThemeIcon(!isDark);
        localStorage.setItem('theme', isDark ? 'light' : 'dark');
    });
    
    function updateThemeIcon(isDark) {
        icon.className = isDark ? 'fas fa-moon text-xl' : 'fas fa-sun text-xl';
    }
}

function initMobileMenu() {
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    const icon = mobileMenuButton.querySelector('i');
    
    mobileMenuButton.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.contains('block');
        mobileMenu.classList.toggle('hidden', isOpen);
        mobileMenu.classList.toggle('block', !isOpen);
        icon.className = isOpen ? 'fas fa-bars' : 'fas fa-times';
    });
}

function initNavbarScroll() {
    const navbar = document.getElementById('navbar');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('bg-opacity-90', 'backdrop-blur-md', 'shadow-md');
            navbar.classList.add('dark:bg-dark-bg', 'light:bg-light-bg');
        } else {
            navbar.classList.remove('bg-opacity-90', 'backdrop-blur-md', 'shadow-md');
            navbar.classList.remove('dark:bg-dark-bg', 'light:bg-light-bg');
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initThemeToggle();
    initMobileMenu();
    initNavbarScroll();

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });

                const mobileMenu = document.getElementById('mobileMenu');
                if (mobileMenu.classList.contains('block')) {
                    mobileMenu.classList.remove('block');
                    mobileMenu.classList.add('hidden');
                    document.getElementById('mobileMenuButton').querySelector('i').className = 'fas fa-bars';
                }
            }
        });
    });
});

    </script>
    <style>
        :root {
    --primary: #6366f1;
    --primary-dark: #4f46e5;
    --secondary: #10b981;
    --dark-bg: #0f172a;
    --dark-card: #1e293b;
    --light-bg: #f8fafc;
    --light-card: #ffffff;
    --dark-text: #f8fafc;
    --light-text: #1e293b;
}
.dark {
    background-color: var(--dark-bg);
    color: var(--dark-text);
}

.light {
    background-color: var(--light-bg);
    color: var(--light-text);
}

.card-dark {
    background-color: var(--dark-card);
}

.card-light {
    background-color: var(--light-card);
}
    </style>