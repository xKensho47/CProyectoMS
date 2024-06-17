document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    const itemsPerPage = 9;
    const loadMoreButton = document.getElementById('load-more');
    const searchInput = document.getElementById('search-input');

    function loadDiscoverFriends(page, searchTerm = '') {
        fetch(`discoverFriends.php?page=${page}&itemsPerPage=${itemsPerPage}&search=${encodeURIComponent(searchTerm)}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const container = document.getElementById('discover-grid-container');
                    if (page === 1) {
                        container.innerHTML = ''; // Clear existing friends only if loading the first page
                    }
                    data.friends.forEach(friend => {
                        const friendDiv = document.createElement('div');
                        friendDiv.classList.add('data-discover');
                        friendDiv.id = `discover-${friend.id_cuenta}`;
                        friendDiv.innerHTML = `
                            <div class="discover-container">
                                <div class="discover-avatar">
                                    <img class="profile-img" src="${friend.id_img}" alt="Discover Avatar"/>
                                </div>
                                <div class="discover-info">
                                    <p class="discover-username">${friend.nombre_usuario}</p>
                                </div>
                            </div>
                            <div class="discover-button">
                                <a href="perfilAmigo.php?id_profile=${friend.id_cuenta}"><button class="btn btn-color fs-5 view-profile">Ver perfil</button></a>
                                <form class="form-add-friend" action="agregarAmigo.php" method="post">
                                    <input type="hidden" name="discover_id" value="${friend.id_cuenta}">
                                    <button type="submit" class="btn btn-color fs-5">Agregar amigo</button>
                                </form>
                            </div>
                        `;
                        container.appendChild(friendDiv);
                    });

                    if (!data.hasMore) {
                        loadMoreButton.style.display = 'none';
                    } else {
                        loadMoreButton.style.display = 'block';
                    }
                } else {
                    alert('Error al cargar amigos.');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    loadMoreButton.addEventListener('click', function() {
        currentPage++;
        loadDiscoverFriends(currentPage, searchInput.value);
    });

    searchInput.addEventListener('input', function() {
        currentPage = 1; // Reset to first page
        loadDiscoverFriends(currentPage, searchInput.value);
    });

    loadDiscoverFriends(currentPage);
});
