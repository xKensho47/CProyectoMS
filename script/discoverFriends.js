document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    const itemsPerPage = 9;
    const loadMoreButton = document.getElementById('load-more');
    const searchInput = document.getElementById('search-input');

    // Definición directa de la cadena Base64 de la imagen por defecto (blanco)
    const defaultImg = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/wcAAwAB/mazYAAAAABJRU5ErkJggg==';

    function isValidImageUrl(url) {
        // Esta función verifica si la URL no está vacía y tiene un formato válido.
        return url && url.trim() !== '';
    }

    function loadDiscoverFriends(page, searchTerm = '') {
        fetch(`discoverFriends.php?page=${page}&itemsPerPage=${itemsPerPage}&search=${encodeURIComponent(searchTerm)}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const container = document.getElementById('discover-grid-container');
                    if (page === 1) {
                        container.innerHTML = ''; // Limpiar amigos existentes solo al cargar la primera página
                    }

                    data.friends.forEach(friend => {
                        const friendDiv = document.createElement('div');
                        friendDiv.classList.add('data-discover');
                        friendDiv.id = `discover-${friend.id_cuenta}`;

                        // Verificar si friend.id_img es válido, de lo contrario usar defaultImg
                        const imgSrc = isValidImageUrl(friend.id_img) ? friend.id_img : defaultImg;

                        friendDiv.innerHTML = `
                            <div class="discover-container">
                                <div class="discover-avatar">
                                    <img class="profile-img" src="${imgSrc}" alt="Discover Avatar"/>
                                </div>
                                <div class="discover-info">
                                    <p class="discover-username">${friend.nombre_usuario}</p>
                                </div>
                            </div>
                            <div class="discover-button">
                                <a href="perfilAmigo.php?id_profile=${friend.id_cuenta}">
                                    <button class="btn btn-color fs-5 view-profile">Ver perfil</button>
                                </a>
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
        currentPage = 1; // Reiniciar a la primera página
        loadDiscoverFriends(currentPage, searchInput.value);
    });

    loadDiscoverFriends(currentPage);
});
