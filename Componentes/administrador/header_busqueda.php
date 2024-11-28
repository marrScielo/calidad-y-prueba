<!-- header_busqueda.php -->
<div class="header-busqueda">
    <form id="searchForm" class="search-form">
        <input type="text" name="query" placeholder="Buscar..." class="search-input" required>
        <button type="submit" class="search-button">
            <i class="fa-solid fa-search"></i>
        </button>
    </form>
</div>

<style>
    .header-busqueda {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    .search-form {
        display: flex;
        align-items: center;
    }

    .search-input {
        padding: 5px 10px;
        font-size: 16px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        margin-right: 10px;
    }

    .search-button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-button i {
        font-size: 16px;
    }

    .search-button:hover {
        background-color: #0056b3;
    }
</style>

<script>
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const query = document.querySelector('.search-input').value;
        fetch(`../Controlador/UsuariosController.php?action=search&query=${query}`)
            .then(response => response.json())
            .then(data => {
                let resultsHtml = '';
                if (data.length === 0) {
                    resultsHtml = '<p>No se encontraron resultados.</p>';
                } else {
                    resultsHtml = '<div class="table-scroll">';
                    resultsHtml += '<table class="user-table">';
                    resultsHtml += '<thead class="user-table__header">';
                    resultsHtml += '<tr class="user-table__row">';
                    resultsHtml += '<th class="user-table__cell user-table__cell--header">ID</th>';
                    resultsHtml += '<th class="user-table__cell user-table__cell--header">Email</th>';
                    resultsHtml += '<th class="user-table__cell user-table__cell--header">Foto Perfil</th>';
                    resultsHtml += '<th class="user-table__cell user-table__cell--header">Rol</th>';
                    resultsHtml += '</tr>';
                    resultsHtml += '</thead>';
                    resultsHtml += '<tbody class="user-table__body">';
                    data.forEach(usuario => {
                        resultsHtml += '<tr class="user-table__row">';
                        resultsHtml += `<td class="user-table__cell">${usuario.id}</td>`;
                        resultsHtml += `<td class="user-table__cell">${usuario.email}</td>`;
                        resultsHtml += `<td class="user-table__cell"><figure class="user-table__cell-figure"><img src="${usuario.fotoPerfil}" alt="Foto de perfil" class="user-table__profile-picture"></figure></td>`;
                        resultsHtml += `<td class="user-table__cell">${usuario.rol}</td>`;
                        resultsHtml += '</tr>';
                    });
                    resultsHtml += '</tbody>';
                    resultsHtml += '</table>';
                    resultsHtml += '</div>';
                }
                document.getElementById('searchResults').innerHTML = resultsHtml;
                document.getElementById('searchModal').style.display = 'block';
            });
    });
</script>