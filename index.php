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

        .search-section {
            padding-top: 100px;
            text-align: center;
            margin-bottom: 50px;
        }

        .logo {
            font-size: 90px;
            margin-bottom: 30px;
            color: #202124;
        }

        .search-container {
            width: 580px;
            margin: 0 auto;
        }

        .search-box {
            width: 100%;
            padding: 14px;
            border: 1px solid #dfe1e5;
            border-radius: 24px;
            font-size: 16px;
            outline: none;
        }

        .search-results {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
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

        .divider {
            height: 1px;
            background: #e5e5e5;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<div class="search-section">
    <div class="logo">MAMP</div>

    <div class="search-container">
        <input type="text" class="search-box" placeholder="Rechercher dans localhost..." id="searchInput">
    </div>
</div>

<div class="search-results">
    <?php
    $htdocsPath = __DIR__;
    $items = scandir($htdocsPath);

    foreach($items as $item) {
        if($item != "." && $item != ".." && substr($item, 0, 1) != ".") {
            $fullPath = $htdocsPath . DIRECTORY_SEPARATOR . $item;
            $isDir = is_dir($fullPath);
            $icon = $isDir ? "📁" : "📄";

            echo "
                <div class='result-item' data-name='".strtolower($item)."'>
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

<script>
    const searchInput = document.getElementById('searchInput');
    const resultItems = document.querySelectorAll('.result-item');

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        resultItems.forEach(item => {
            const itemName = item.dataset.name;
            if(itemName.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
