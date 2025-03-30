<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Kasutaja lisamine</title>
</head>
<body>
    <h2>Lisa uus kasutaja</h2>
    <form id="userForm" enctype="multipart/form-data">
        <label>Nimi:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Foto (JPG, PNG):</label><br>
        <input type="file" name="photo" accept="image/*" required><br><br>

        <button type="submit">Saada</button>
    </form>

    <div id="result" style="margin-top:20px;"></div>

    <script>
        const form = document.getElementById('userForm');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
    
            const response = await fetch('/api/users', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });
    
            const result = await response.json();
            document.getElementById('result').innerText = JSON.stringify(result, null, 2);
        });
    </script>
    
</body>
</html>
