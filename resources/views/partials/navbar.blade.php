<nav class="relative w-full">
    <!-- Hamburger menu button -->
    <div class="block sm:hidden z-20 fixed top-0 right-0 m-4">
        <button id="hamburger-btn" class="focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16m-16 6h16"></path>
            </svg>
        </button>
    </div>

    <!-- Regular Navbar -->
    <ul class="flex navbar p-5 justify-center lg:gap-32 sm:gap-14 gap-3 lg:text-base text-sm text-center hidden sm:flex fixed top-0 left-0 right-0 bg-white shadow-lg z-10">
        <li class="flex justify-center items-center"><a href="">INICIO</a></li>
        <li class="flex justify-center items-center"><a class="scroll-anchor" data-to="#wedding-day">WEDDING DAY</a></li>
        <li class="flex justify-center items-center"><a class="scroll-anchor" data-to="#our-story">NUESTRA HISTORIA</a></li>
        <li class="flex justify-center items-center"><a class="scroll-anchor" data-to="#confirm">CONFIRMAR ASISTENCIA</a></li>
    </ul>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="fixed top-0 left-0 right-0 max-h-0 overflow-hidden bg-white shadow-lg transition-all duration-300 ease-in-out z-10">
        <ul class="flex flex-col items-center py-4">
            <li class="flex justify-center items-center py-2"><a href="">INICIO</a></li>
            <li class="flex justify-center items-center py-2"><a class="scroll-anchor" data-to="#wedding-day">WEDDING DAY</a></li>
            <li class="flex justify-center items-center py-2"><a class="scroll-anchor" data-to="#our-story">NUESTRA HISTORIA</a></li>
            <li class="flex justify-center items-center py-2"><a class="scroll-anchor" data-to="#confirm-form">CONFIRMAR ASISTENCIA</a></li>
        </ul>
    </div>
</nav>

<script>
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    // Toggle menu on click
    hamburgerBtn.addEventListener('click', function() {
        if (mobileMenu.style.maxHeight === '0px' || !mobileMenu.style.maxHeight) {
            mobileMenu.style.maxHeight = mobileMenu.scrollHeight + "px";
        } else {
            mobileMenu.style.maxHeight = '0';
        }
    });

    // Show menu on mouseover
    hamburgerBtn.addEventListener('mouseover', function() {
        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + "px";
    });

    // Hide menu on mouseout
    hamburgerBtn.addEventListener('mouseout', function() {
        mobileMenu.style.maxHeight = '0';
    });

    // Keep menu open if mouseover the menu itself
    mobileMenu.addEventListener('mouseover', function() {
        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + "px";
    });

    // Hide menu on mouseout from the menu
    mobileMenu.addEventListener('mouseout', function() {
        mobileMenu.style.maxHeight = '0';
    });
</script>

<style>
    #mobile-menu ul {
        transition: max-height 0.3s ease-in-out;
    }

    .navbar {
        background-color: #fff;
    }

    .navbar.fixed {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 10;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>
