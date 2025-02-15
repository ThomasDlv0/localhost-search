<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localhost MAMP - Navigation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 150px;
        }

        .logo {
            font-size: 90px;
            margin-bottom: 30px;
            color: #202124;
        }

        .search-container {
            width: 580px;
            margin: 0 auto;
            margin-bottom: 30px;
        }

        .search-box {
            width: 100%;
            padding: 14px;
            border: 1px solid #dfe1e5;
            border-radius: 24px;
            font-size: 16px;
            outline: none;
        }

        .search-box:hover {
            box-shadow: 0 1px 6px rgba(32,33,36,.28);
        }

        .folders {
            width: 80%;
            max-width: 1200px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .folder {
            text-decoration: none;
            padding: 15px;
            border-radius: 8px;
            background: #f8f9fa;
            color: #202124;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .folder:hover {
            background: #e8e8e9;
        }

        .folder-icon {
            width: 24px;
            height: 24px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<div class="logo">MAMP</div>

<div class="search-container">
    <input type="text" class="search-box" placeholder="Rechercher dans localhost..." id="searchInput">
</div>

<div class="folders" id="folderContainer">
    <?php
    // Chemin vers le répertoire htdocs
    $htdocsPath = __DIR__;

    // Récupérer tous les éléments du répertoire
    $items = scandir($htdocsPath);

    // Filtrer les éléments
    foreach($items as $item) {
        // Ignorer . et .. et les fichiers cachés
        if($item != "." && $item != ".." && substr($item, 0, 1) != ".") {
            $fullPath = $htdocsPath . DIRECTORY_SEPARATOR . $item;
            $isDir = is_dir($fullPath);
            $icon = $isDir ? "📁" : "📄";

            echo "<a href='/$item' class='folder' data-name='".strtolower($item)."'>
                        <span class='folder-icon'>$icon</span>
                        $item
                    </a>";
        }
    }
    ?>
</div>

<script>
    // Fonction de recherche
    const searchInput = document.getElementById('searchInput');
    const folders = document.querySelectorAll('.folder');

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        folders.forEach(folder => {
            const folderName = folder.dataset.name;
            if(folderName.includes(searchTerm)) {
                folder.classList.remove('hidden');
            } else {
                folder.classList.add('hidden');
            }
        });
    });

    // Tri alphabétique des dossiers
    const folderContainer = document.getElementById('folderContainer');
    const foldersArray = Array.from(folders);

    foldersArray.sort((a, b) => {
        return a.dataset.name.localeCompare(b.dataset.name);
    });

    foldersArray.forEach(folder => {
        folderContainer.appendChild(folder);
    });
</script>
</body>
</html>
