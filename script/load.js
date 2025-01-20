// Function to show the loading bar
function showLoadingBar() {
    document.getElementById('loading-bar').style.width = '100%';
}

// Function to hide the loading bar
function hideLoadingBar() {
    document.getElementById('loading-bar').style.width = '0';
}

// Event listener for DOMContentLoaded
document.addEventListener('DOMContentLoaded', function () {
    hideLoadingBar(); // Hide the loading bar once the DOM content is loaded
});

// Event listener for page unload (before leaving the page)
window.addEventListener('beforeunload', function () {
    showLoadingBar(); // Show the loading bar when leaving the page
});