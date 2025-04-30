document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.user-rating .stars .fa-star');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            const productId = this.getAttribute('data-product-id');

            // Send AJAX request to store the rating
            fetch('/rate-product', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: productId,
                    rating: rating
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // Update the displayed stars
                    stars.forEach((s, index) => {
                        if(index < rating) {
                            s.classList.remove('far');
                            s.classList.add('fas', 'theme-color');
                        } else {
                            s.classList.remove('fas', 'theme-color');
                            s.classList.add('far');
                        }
                    });

                    // Optionally update the average rating display
                    if(data.averageRating) {
                        document.querySelector('.average-rating').textContent = data.averageRating;
                    }
                }
            });
        });

        // Hover effect
        star.addEventListener('mouseover', function() {
            const rating = this.getAttribute('data-rating');
            stars.forEach((s, index) => {
                if(index < rating) {
                    s.classList.add('hover');
                } else {
                    s.classList.remove('hover');
                }
            });
        });

        star.addEventListener('mouseout', function() {
            stars.forEach(s => s.classList.remove('hover'));
        });
    });
});
