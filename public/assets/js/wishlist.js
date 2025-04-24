// Wishlist Management Script

document.addEventListener("DOMContentLoaded", function () {
    // Initialize Feather icons
    if (typeof feather !== "undefined") {
        feather.replace();
    }

    // Load the wishlist count on page load
    updateWishlistCount();

    // Add event listeners to all wishlist buttons
    initWishlistButtons();
});

/**
 * Initialize all wishlist buttons on the page
 */
function initWishlistButtons() {
    const wishlistButtons = document.querySelectorAll(".add-wishlist");

    wishlistButtons.forEach((button) => {
        // Get product ID from data attribute
        const productId = button.getAttribute("data-product-id");

        // Check if the product is already in the wishlist
        checkWishlistStatus(productId, button);

        // Add click event listener
        button.addEventListener("click", function (e) {
            e.preventDefault();
            toggleWishlistItem(productId, button);
        });
    });
}

/**
 * Check if a product is already in the wishlist and update button styling
 */
function checkWishlistStatus(productId, button) {
    fetch("/wishlist/check", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            product_id: productId,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.in_wishlist) {
                setActiveWishlistButton(button);
            } else {
                setInactiveWishlistButton(button);
            }
        })
        .catch((error) => {
            console.error("Error checking wishlist status:", error);
        });
}

/**
 * Toggle product in wishlist (add or remove)
 */
function toggleWishlistItem(productId, button) {
    // Check if user is authenticated
    const isAuthenticated = checkUserAuthentication();

    if (!isAuthenticated) {
        // Redirect to login page or show login modal
        window.location.href = "/login?redirect=" + window.location.pathname;
        return;
    }

    fetch("/wishlist/toggle", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            product_id: productId,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "added") {
                setActiveWishlistButton(button);
                showNotification("Product added to wishlist");
            } else if (data.status === "removed") {
                setInactiveWishlistButton(button);
                showNotification("Product removed from wishlist");

                // If we're on the wishlist page, remove the product from the UI
                if (window.location.pathname.includes("wishlist")) {
                    const productCard =
                        button.closest(".product-card") ||
                        button.closest(".product-item");
                    if (productCard) {
                        productCard.remove();

                        // If no more products, show empty wishlist message
                        const remainingProducts = document.querySelectorAll(
                            ".product-card, .product-item"
                        );
                        if (remainingProducts.length === 0) {
                            const wishlistContainer = document.querySelector(
                                ".wishlist-container"
                            );
                            if (wishlistContainer) {
                                wishlistContainer.innerHTML =
                                    '<div class="empty-wishlist"><p>Your wishlist is empty</p><a href="/products" class="btn btn-primary">Continue Shopping</a></div>';
                            }
                        }
                    }
                }
            }

            // Update wishlist count
            updateWishlistCount();
        })
        .catch((error) => {
            console.error("Error toggling wishlist item:", error);
            showNotification(
                "An error occurred. Please try again later.",
                "error"
            );
        });
}

/**
 * Update the wishlist counter in the navigation
 */
function updateWishlistCount() {
    fetch("/wishlist/count")
        .then((response) => response.json())
        .then((data) => {
            const wishlistCount = document.getElementById("wishlist-count");
            if (wishlistCount) {
                wishlistCount.textContent = data.count;

                // Show/hide count based on whether there are items
                if (data.count > 0) {
                    wishlistCount.style.display = "inline-block";
                } else {
                    wishlistCount.style.display = "none";
                }
            }
        })
        .catch((error) => {
            console.error("Error updating wishlist count:", error);
        });
}

/**
 * Set active state for wishlist button (product in wishlist)
 */
function setActiveWishlistButton(button) {
    const icon = button.querySelector("i");
    if (icon) {
        icon.setAttribute("fill", "currentColor");
        icon.classList.add("text-danger");
    }
    button.classList.add("active");
}

/**
 * Set inactive state for wishlist button (product not in wishlist)
 */
function setInactiveWishlistButton(button) {
    const icon = button.querySelector("i");
    if (icon) {
        icon.setAttribute("fill", "none");
        icon.classList.remove("text-danger");
    }
    button.classList.remove("active");
}

/**
 * Check if user is authenticated
 */
function checkUserAuthentication() {
    // This function should be customized based on your authentication system
    // For example, you might check for a specific cookie or localStorage value

    // Simplistic example - assuming you have an auth-token cookie or something similar
    return (
        document.cookie.includes("auth-token=") ||
        localStorage.getItem("auth-token")
    );
}

/**
 * Show notification toast
 */
function showNotification(message, type = "success") {
    // This function can be customized based on your UI library
    // Simple example using a basic toast system
    const toast = document.createElement("div");
    toast.className = `toast toast-${type}`;
    toast.textContent = message;

    document.body.appendChild(toast);

    // Show toast
    setTimeout(() => {
        toast.classList.add("show");
    }, 100);

    // Hide and remove toast after 3 seconds
    setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}
