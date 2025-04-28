// Elements
const sections = {
    profile: document.getElementById('profile_con'),
    address: document.getElementById('address_con'),
    contact: document.getElementById('contact_con'),
    settings: document.getElementById('settings_con'),
    logout: document.getElementById('logout_con')
};

const buttons = {
    profile: document.getElementById('profile'),
    address: document.getElementById('address'),
    contact: document.getElementById('contact'),
    settings: document.getElementById('settings'),
    logout: document.getElementById('logout')
};

// Function to toggle visibility
const toggleVisibility = (activeSection) => {
    for (let section in sections) {
        if (sections.hasOwnProperty(section)) {
            sections[section].style.display = (section === activeSection) ? 'block' : 'none';
        }
    }
};

// Event listeners for buttons
for (let button in buttons) {
    if (buttons.hasOwnProperty(button)) {
        buttons[button].addEventListener('click', () => {
            toggleVisibility(button);
        });
    }
}

// Get the logout button element
const logoutBtn = document.getElementById('logoutBtn');

// Add an event listener for the logout button
logoutBtn.addEventListener('click', (e) => {
    // Prevent the default action (redirecting to logout.php)
    e.preventDefault();

    // Ask for confirmation
    const confirmLogout = confirm("Are you sure you want to log out?");
    
    // If user confirms, redirect to logout.php
    if (confirmLogout) {
        window.location.href = 'logout.php';
    }
});
