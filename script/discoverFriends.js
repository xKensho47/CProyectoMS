document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    const itemsPerPage = 9;
    const loadMoreButton = document.getElementById('load-more');

    function loadDiscoverFriends(page) {
        fetch(`discoverFriends.php?page=${page}&itemsPerPage=${itemsPerPage}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const container = document.getElementById('discover-grid-container');
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
                                    <button type="submit" class="btn btn-color fs-5 button-add-discover">Agregar amigo</button>
                                </form>
                            </div>
                        `;
                        container.appendChild(friendDiv);
                    });

                    if (!data.hasMore) {
                        loadMoreButton.style.display = 'none';
                    }
                } else {
                    alert('Error al cargar amigos.');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    loadMoreButton.addEventListener('click', function() {
        currentPage++;
        loadDiscoverFriends(currentPage);
    });

    loadDiscoverFriends(currentPage);
});
