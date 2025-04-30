document.addEventListener("DOMContentLoaded", function () {
    // Get all "Add to Wishlist" buttons
    const addToWishlistButtons = document.querySelectorAll(".add-wishlist");

    // Add click event listeners to all "Add to Wishlist" buttons
    addToWishlistButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            // Get product ID from data attribute
            const productId = this.getAttribute("data-product-id");

            // Call the addToWishlist function
            addToWishlist(productId);
        });
    });

    // Get all "Move to Cart" buttons if they exist
    const moveToCartButtons = document.querySelectorAll(".move-to-cart");
    if (moveToCartButtons) {
        moveToCartButtons.forEach((button) => {
            button.addEventListener("click", function (e) {
                e.preventDefault();

                // Get wishlist item ID from data attribute
                const wishlistItemId = this.getAttribute("data-wishlist-id");

                // Call the moveToCart function
                moveToCart(wishlistItemId);
            });
        });
    }

    // Get all "Remove from Wishlist" buttons if they exist
    const removeFromWishlistButtons = document.querySelectorAll(
        ".remove-from-wishlist"
    );
    if (removeFromWishlistButtons) {
        removeFromWishlistButtons.forEach((button) => {
            button.addEventListener("click", function (e) {
                e.preventDefault();

                // Get wishlist item ID from data attribute
                const wishlistItemId = this.getAttribute("data-wishlist-id");

                // Call the removeFromWishlist function
                removeFromWishlist(wishlistItemId);
            });
        });
    }
});

// Function to send AJAX request to add to wishlist
function addToWishlist(productId) {
    // Get CSRF token from meta tag
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    fetch("/wishlist/add", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
            Accept: "application/json",
        },
        body: JSON.stringify({
            product_id: productId,
        }),
    })
        .then((response) => {
            if (response.status === 401) {
                // User is not logged in
                showNotification("Login to save items!", "warning");
                throw new Error("User not authenticated");
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                // Update the wishlist counter in the header
                updateWishlistCounter(data.wishlistCount);

                // Show appropriate notification
                if (data.exists) {
                    showNotification("Item already in wishlist!", "info");
                } else {
                    showNotification("Item added to wishlist!", "success");
                }
            } else {
                showNotification("Failed to add item to wishlist", "error");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            if (error.message !== "User not authenticated") {
                showNotification("An error occurred", "error");
            }
        });
}

// Function to send AJAX request to move item to cart
function moveToCart(wishlistItemId) {
    // Get CSRF token from meta tag
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    fetch(`/wishlist/move-to-cart/${wishlistItemId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
            Accept: "application/json",
        },
    })
        .then((response) => {
            if (response.status === 401) {
                // User is not logged in
                showNotification("Login to shop!", "warning");
                throw new Error("User not authenticated");
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                // Update the wishlist counter in the header
                updateWishlistCounter(data.wishlistCount);

                // Update the cart counter in the header
                updateCartCounter(data.cartData.cartCount);

                // Remove item from the wishlist display
                const wishlistItem = document.querySelector(
                    `#wishlist-item-${wishlistItemId}`
                );
                if (wishlistItem) {
                    wishlistItem.remove();
                }

                // Show success notification
                showNotification("Item moved to cart!", "success");

                // Reload page if wishlist is now empty
                if (data.wishlistCount === 0) {
                    location.reload();
                }
            } else {
                showNotification("Failed to move item to cart", "error");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            if (error.message !== "User not authenticated") {
                showNotification("An error occurred", "error");
            }
        });
}

// Function to send AJAX request to remove from wishlist
function removeFromWishlist(wishlistItemId) {
    // Get CSRF token from meta tag
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    fetch(`/wishlist/remove/${wishlistItemId}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
            Accept: "application/json",
        },
    })
        .then((response) => {
            if (response.status === 401) {
                // User is not logged in
                showNotification("Login required!", "warning");
                throw new Error("User not authenticated");
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                // Update the wishlist counter in the header
                updateWishlistCounter(data.wishlistCount);

                // Remove item from the wishlist display
                const wishlistItem = document.querySelector(
                    `#wishlist-item-${wishlistItemId}`
                );
                if (wishlistItem) {
                    wishlistItem.remove();
                }

                // Show success notification
                showNotification("Item removed from wishlist!", "success");

                // Reload page if wishlist is now empty
                if (data.wishlistCount === 0) {
                    location.reload();
                }
            } else {
                showNotification(
                    "Failed to remove item from wishlist",
                    "error"
                );
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            if (error.message !== "User not authenticated") {
                showNotification("An error occurred", "error");
            }
        });
}

// Function to update the wishlist counter display
function updateWishlistCounter(count) {
    const wishlistCounter = document.querySelector(".wishlist-counter");
    if (wishlistCounter) {
        wishlistCounter.textContent = count;
    }
}

// Function to update the cart counter display (reused from your cart.js)
function updateCartCounter(count) {
    const cartCounter = document.querySelector(".cart-counter");
    if (cartCounter) {
        cartCounter.textContent = count;
    }
}

// Function to show notification (reused from your cart.js)
function showNotification(message, type) {
    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);

    // Add some basic styling
    notification.style.position = "fixed";
    notification.style.top = "20px";
    notification.style.right = "20px";
    notification.style.padding = "10px 20px";
    notification.style.borderRadius = "4px";
    notification.style.zIndex = "1000";

    if (type === "success") {
        notification.style.backgroundColor = "#4CAF50";
        notification.style.color = "white";
    } else if (type === "info") {
        notification.style.backgroundColor = "#2196F3";
        notification.style.color = "white";
    } else if (type === "warning") {
        notification.style.backgroundColor = "#FF9800";
        notification.style.color = "white";
    } else {
        notification.style.backgroundColor = "#F44336";
        notification.style.color = "white";
    }

    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
