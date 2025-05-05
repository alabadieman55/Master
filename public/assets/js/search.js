document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("live-search-input");
    const searchResults = document.getElementById("live-search-results");
    let searchTimeout;

    searchInput.addEventListener("input", function () {
        clearTimeout(searchTimeout);
        const query = this.value.trim();

        if (query.length < 2) {
            searchResults.style.display = "none";
            return;
        }

        searchTimeout = setTimeout(() => {
            fetchLiveSearchResults(query);
        }, 300);
    });

    function fetchLiveSearchResults(query) {
        fetch(`/search/live?q=${encodeURIComponent(query)}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                // Check if data is an array
                if (Array.isArray(data)) {
                    displaySearchResults(data);
                } else {
                    // Handle case where data might be a single object
                    displaySearchResults([data]);
                }
            })
            .catch((error) => {
                console.error("Error fetching search results:", error);
                searchResults.innerHTML =
                    '<div class="search-item">Error loading results</div>';
                searchResults.style.display = "block";
            });
    }

    function displaySearchResults(results) {
        if (results.length > 0) {
            let html = "";
            results.forEach((item) => {
                // Fix image URL by replacing backslashes with forward slashes
                const imageUrl = item.image
                    ? item.image.replace(/\\/g, "/")
                    : "";

                html += `
                    <a href="${item.url.replace(
                        /\\/g,
                        "/"
                    )}" class="search-item d-flex align-items-center">
                        ${
                            imageUrl
                                ? `<img src="${imageUrl}" alt="${item.name}">`
                                : ""
                        }
                        <div>
                            <h6 class="mb-0">${item.name}</h6>
                            <small class="text-muted">${
                                item.price || "Price not available"
                            }</small>
                        </div>
                    </a>
                `;
            });
            searchResults.innerHTML = html;
            searchResults.style.display = "block";
        } else {
            searchResults.innerHTML =
                '<div class="search-item">No results found</div>';
            searchResults.style.display = "block";
        }
    }

    // Close results when clicking outside
    document.addEventListener("click", function (e) {
        if (e.target !== searchInput && !searchResults.contains(e.target)) {
            searchResults.style.display = "none";
        }
    });
});
