document.addEventListener('DOMContentLoaded', () => {
    const friends = [
        { name: 'Amigo 1', avatar: 'path_to_avatar_1.jpg' },
        { name: 'Amigo 2', avatar: 'path_to_avatar_2.jpg' },
        // Añade más amigos aquí
    ];

    const friendsGrid = document.getElementById('friendsGrid');

    friends.forEach(friend => {
        const friendDiv = document.createElement('div');
        friendDiv.className = 'friend';

        const img = document.createElement('img');
        img.src = friend.avatar;
        img.alt = friend.name;

        friendDiv.appendChild(img);
        friendsGrid.appendChild(friendDiv);
    });
});
