<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Kasutajad</title>
</head>
<body>
    <h2>Kasutajad</h2>
    <div id="user-list"></div>

    <button id="load-more">Näita rohkem</button>

    <script>
        let page = 1;

        async function loadUsers() {
            const response = await fetch(`/api/users?page=${page}`);
            const data = await response.json();

            const container = document.getElementById('user-list');

            data.data.forEach(user => {
                const el = document.createElement('div');
                el.innerHTML = `
                    <p><strong>${user.name}</strong> (${user.email})</p>
                    ${user.photo ? `<img src="/${user.photo}" width="70" height="70">` : ''}
                    <hr>
                `;
                container.appendChild(el);
            });

            if (!data.next_page_url) {
                document.getElementById('load-more').style.display = 'none';
            }

            page++;
        }

        document.getElementById('load-more').addEventListener('click', loadUsers);

        // Lae esimene leht kohe
        loadUsers();
    </script>
</body>
</html>
