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
            min-height: 100vh;
            background-color: #fff;
        }

        .container {
            max-width: 1200px;
        }

        .search-section {
            display: flex;
            padding-top: 40px;
            margin-bottom: 20px;
            width: 100%;
        }

        .logo {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 3rem;
            margin-bottom: 30px;
            color: #202124;
            width: 100px;
            height: 100px;
        }

        .logo img {
            width: 100%;
            height: 100%;
        }

        .search-section-inner {
            width: 80%;
            margin: 0 auto;
        }

        .search-container {
            width: 580px;
            margin-bottom: 20px;
        }

        .search-box {
            width: 100%;
            padding: 14px;
            border: 1px solid #dfe1e5;
            border-radius: 24px;
            font-size: 16px;
            outline: none;
        }

        .quick-folders {
            width: 580px;
            display: flex;
            gap: 10px;
            justify-content: flex-start;
            margin-bottom: 40px;
        }

        .quick-folder {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            background: #f8f9fa;
            border-radius: 8px;
            text-decoration: none;
            color: #202124;
            font-size: 14px;
            transition: background 0.2s;
        }

        .quick-folder:hover {
            background: #e8e8e9;
        }

        .folder-icon {
            opacity: 0.7;
        }

        .search-results {
            max-width: 80%;
            margin: 0 auto;
            padding: 20px 0;
        }

        .result-item {
            margin-bottom: 30px;
            padding: 15px;
            border-radius: 8px;
            background: #fff;
            transition: background 0.2s;
        }

        .result-item:hover {
            background: #f8f9fa;
        }

        .result-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            gap: 10px;
        }

        .result-icon {
            width: 32px;
            height: 32px;
            border-radius: 4px;
            background: #f1f3f4;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .result-path {
            color: #202124;
            font-size: 14px;
            opacity: 0.7;
        }

        .result-title {
            color: #1a0dab;
            font-size: 20px;
            text-decoration: none;
            margin: 5px 0;
            display: block;
        }

        .result-title:hover {
            text-decoration: underline;
        }

        .result-description {
            color: #4d5156;
            font-size: 14px;
            line-height: 1.58;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="search-section">
        <div class="logo">
            <img src="mamp-viewer.png" alt="MAMP Logo">
        </div>
        <div class="search-section-inner">
            <div class="search-container">
                <input type="text" class="search-box" placeholder="Rechercher dans localhost..." id="searchInput">
            </div>

            <div class="quick-folders">
                <?php
                $htdocsPath = __DIR__;
                $items = scandir($htdocsPath);
                $excludeFiles = ['index.php', 'mamp-viewer.png', '.', '..'];

                foreach ($items as $item) {
                    // Vérifie si le fichier n'est pas dans la liste d'exclusion et n'est pas un fichier caché
                    if (!in_array($item, $excludeFiles) && substr($item, 0, 1) != ".") {
                        $isDir = is_dir($htdocsPath . DIRECTORY_SEPARATOR . $item);
                        $icon = $isDir ? "📁" : "📄";

                        echo "<a href='/$item' class='quick-folder' data-name='" . strtolower($item) . "'>
                            <span class='folder-icon'>$icon</span>
                            $item
                        </a>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="search-results">
        <?php
        foreach ($items as $item) {
            // Utilise la même liste d'exclusion
            if (!in_array($item, $excludeFiles) && substr($item, 0, 1) != ".") {
                $fullPath = $htdocsPath . DIRECTORY_SEPARATOR . $item;
                $isDir = is_dir($fullPath);
                $icon = $isDir ? "📁" : "📄";

                echo "
                <div class='result-item' data-name='" . strtolower($item) . "'>
                    <div class='result-header'>
                        <div class='result-icon'>$icon</div>
                        <div class='result-path'>localhost/$item</div>
                    </div>
                    <a href='/$item' class='result-title'>$item</a>
                    <div class='result-description'>
                        " . ($isDir ? "Dossier contenant des fichiers web" : "Fichier web") . "
                        situé dans le répertoire principal de votre serveur local.
                    </div>
                </div>";
            }
        }
        ?>
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const quickFolders = document.querySelectorAll('.quick-folder');
    const resultItems = document.querySelectorAll('.result-item');

    searchInput.addEventListener('input', function (e) {
        const searchTerm = e.target.value.toLowerCase();

        quickFolders.forEach(folder => {
            const folderName = folder.dataset.name;
            if (folderName.includes(searchTerm)) {
                folder.style.display = 'flex';
            } else {
                folder.style.display = 'none';
            }
        });

        resultItems.forEach(item => {
            const itemName = item.dataset.name;
            if (itemName.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
