<?php
require_once 'api_connection.php';

$year = isset($_GET['year']) ? $_GET['year'] : 2025;
$id = isset($_GET['id']) ? $_GET['id'] : 0;

$song_data = "https://eurovisionapi.runasp.net/api/senior/contests/$year/contestants/$id";
$song = getDataFromAPI($song_data);

$videoToShow = null;
if (!empty($song['videoUrls']) && is_array($song['videoUrls'])) {
    $videoToShow = $song['videoUrls'][0]; 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $song['artist'] ?? 'Detalle'; ?> - Eurovisión <?php echo $year; ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <main class="container">
        <header>
            <nav><a href="index.php?year=<?php echo $year; ?>" class="btn-volver">← Volver al listado</a></nav>
            <h1>
                <?php echo $song['artist'] ?? 'Artista desconocido'; ?>
                <img src="https://flagcdn.com/16x12/<?php echo strtolower($song['country'] ?? 'es'); ?>.png" alt="Bandera"/>
            </h1>
        </header> 
        <?php if ($song): ?>
            <div class="video-container">
             <?php if ($videoToShow): ?>
                <iframe
                        src="<?php echo $videoToShow; ?>" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                </iframe>
                <?php else: ?>
                    <div class="no-video">
                        <p>No hay vídeos disponibles para este candidato.</p>
                    </div>
                <?php endif; ?>
            </div>
            <?php else: ?>
                <p>Error: No se pudo cargar la información del concursante.</p>
            <?php endif; ?>
        </main>
        <footer>
            María Quintero Portillo <small><a href="https://github.com/marquipor">marquipor</a></small> - Tarea 9 de DWES
        </footer>
    </body>
</html>