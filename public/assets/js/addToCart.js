document.addEventListener("DOMContentLoaded", function () {
    // Get all "Add to Cart" buttons
    const addToCartButtons = document.querySelectorAll(".add-card");

    // Add click event listeners to all "Add to Cart" buttons
    addToCartButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            // Get product ID from data attribute
            const productId = this.getAttribute("data-product-id");

            // Call the addToCart function
            addToCart(productId, 1); // Assuming quantity of 1
        });
    });
});

// Function to send AJAX request to the Laravel controller
function addToCart(productId, quantity) {
    // Get CSRF token from meta tag
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    fetch("/cart/add", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
            Accept: "application/json",
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity,
        }),
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
                // Update the cart counter in the header
                updateCartCounter(data.cartCount);

                // Show success notification
                showNotification("Item added to cart!", "success");
            } else {
                showNotification("Failed to add item to cart", "error");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            if (error.message !== "User not authenticated") {
                showNotification("An error occurred", "error");
            }
        });
}

// Function to update the cart counter display
function updateCartCounter(count) {
    const cartCounter = document.querySelector(".cart-counter");
    if (cartCounter) {
        cartCounter.textContent = count;
    }
}

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
    } else {
        notification.style.backgroundColor = "#F44336";
        notification.style.color = "white";
    }

    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
