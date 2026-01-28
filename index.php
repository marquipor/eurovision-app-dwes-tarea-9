<?php
    // Archivo con la lógica para conectarse a la API
    require_once 'api_connection.php';
    
    //Capturar el año del input. Si no existe,por defecto mostramos 2025.
    $selected_year = isset($_GET['year']) ? $_GET['year']: 2025;
    
    // Construcción dinámica de URL
    $year_url = "https://eurovisionapi.runasp.net/api/senior/contests/" . $selected_year;
    // Obtención de datos
    $eurovision_data=getDataFromAPI($year_url);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Eurovision API - Buscador</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <header>
            <h1>Eurovision Song Contest API - Buscador</h1>
            <form action="index.php" method="GET">
                <label for="year">Selecciona un año:</label>
                <input type="number" name="year" id="year"
                       min="1956" max="2025"
                       value="<?php echo $selected_year;?>"
                       onchange="this.form.submit()">
                
            </form>
             <?php if (!empty($eurovision_data['logoUrl'])): ?>
                        <img src="<?php echo $eurovision_data['logoUrl']; ?>" alt="Logo de Eurovision <?php echo $selected_year; ?>" class="festival-logo">
                    <?php endif; ?>
        </header>
        
        <main class="container">
         <!-- Si los datos no son null o falsos -->
            <?php if ($eurovision_data): ?>
            <section class="year-summary-card">
                <div class="header-info">
                    <div class="text-data">
                        <h1>Eurovisión <?php echo $eurovision_data['year']; ?></h1>
                        <p><strong>Arena:</strong> <?php echo $eurovision_data['arena']; ?></p>
                        <p><strong>Ciudad:</strong> <?php echo $eurovision_data['city']; ?></p>
                        <p><strong>País:</strong> 
                            <img src="https://flagcdn.com/16x12/<?php echo strtolower($eurovision_data['country'])?>.png"/>
                        </p>
                        <p><strong>Broadcaster: </strong></p> <ul>
                        <?php foreach ($eurovision_data['broadcasters'] as $broadcaster): ?>
                            <li> <?php echo $broadcaster; ?></li>
                        <?php endforeach;?>
                        </ul>
                        <p><strong>Presentadores: </strong></p> <ul>
                        <?php foreach ($eurovision_data['presenters'] as $presenter): ?>
                            <li> <?php echo $presenter; ?></li>
                        <?php endforeach;?>
                        </ul>

                        <p><strong>Eslogan:</strong> "<?php echo $eurovision_data['slogan']; ?>"</p>
                    </div>
                </div>
            </section>

            <h2>Participantes de <?php echo $selected_year; ?></h2>
    
            <div class="grid-contestants">
                <?php if (!empty($eurovision_data['contestants'])): ?>
                    <?php foreach ($eurovision_data['contestants'] as $contestant): ?>
                        <article class="card-contestant">
                            <div class="info">
                                <h3><?php echo $contestant['artist']; ?></h3>
                                <p class="song">"<?php echo $contestant['song']; ?>"</p>            
                                <p><strong>País:</strong> 
                                    <img src="https://flagcdn.com/16x12/<?php echo strtolower($contestant['country'])?>.png"/>
                                </p>
                                <a href="details.php?year=<?php echo $selected_year?>&id=<?php echo $contestant['id']?>" class="btn-detail">Ver actuación</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay concursantes registrados para este año.</p>
                <?php endif; ?>
            </div>
            <?php else: ?>
            <div class="error-msg">
                <p>No se encontraron datos para el año <strong><?php echo $selected_year; ?></strong>. Intenta con otro año entre 1956 y 2024.</p>
            </div>
            <?php endif; ?> 
        </main>
        <footer>María Quintero Portillo <small><a href="https://github.com/marquipor">marquipor</a></small> - Tarea 9 de DWES</footer>
    </body>
</html>
