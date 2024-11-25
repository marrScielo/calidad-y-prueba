<!-- header_busqueda.php -->
<div class="header-busqueda">
    <form action="buscar.php" method="GET" class="search-form">
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