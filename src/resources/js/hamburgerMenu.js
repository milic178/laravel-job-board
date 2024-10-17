document.addEventListener('DOMContentLoaded', () => {
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const menuItems = document.getElementById('menu-items');

    // Check if hamburger menu and menu items exist
    if (hamburgerMenu && menuItems) {
        // Toggle menu visibility
        hamburgerMenu.addEventListener('click', function () {
            menuItems.classList.toggle('hidden');
        });

        // Close the menu when clicking outside
        document.addEventListener('click', function (event) {
            const isClickInsideMenu = menuItems.contains(event.target);
            const isClickOnHamburger = hamburgerMenu.contains(event.target);

            if (!isClickInsideMenu && !isClickOnHamburger) {
                menuItems.classList.add('hidden');
            }
        });
    }
});
