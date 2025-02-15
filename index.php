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
            width: 580px;
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
        }

        .folder:hover {
            background: #e8e8e9;
        }
    </style>
</head>
<body>
<div class="logo">MAMP</div>

<div class="search-container">
    <input type="text" class="search-box" placeholder="Rechercher dans localhost...">
</div>

<div class="folders">
    <a href="/portfolio" class="folder">Portfolio</a>
    <a href="/sfaitV5" class="folder">SfaitV5</a>
    <a href="/index.html" class="folder">Index.html</a>
</div>
</body>
</html>