document.addEventListener('DOMContentLoaded', () => {
    // Hamburger menu functionality
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const menuItems = document.getElementById('menu-items');

    if (hamburgerMenu && menuItems) {
        hamburgerMenu.addEventListener('click', function () {
            menuItems.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            const isClickInsideMenu = menuItems.contains(event.target);
            const isClickOnHamburger = hamburgerMenu.contains(event.target);

            if (!isClickInsideMenu && !isClickOnHamburger) {
                menuItems.classList.add('hidden');
            }
        });
    }

    // Employers dropdown functionality
    const employersButton = document.getElementById('employers-button');
    const employersDropdown = document.getElementById('employers-dropdown');

    if (employersButton && employersDropdown) {
        employersButton.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent the document click event from firing
            employersDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            const isClickInsideDropdown = employersDropdown.contains(event.target);
            const isClickOnButton = employersButton.contains(event.target);

            if (!isClickInsideDropdown && !isClickOnButton) {
                employersDropdown.classList.add('hidden');
            }
        });
    }
});
