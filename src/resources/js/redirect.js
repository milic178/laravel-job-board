function redirectTo(url, delay) {
    setTimeout(() => {
        window.location.href = url;
    }, delay);
}

// Export the function (if using modules)
export { redirectTo };
