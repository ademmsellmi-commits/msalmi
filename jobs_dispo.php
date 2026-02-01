<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Travaux Disponibles</title>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; padding: 20px; color: #1f2937; }
        .container { max-width: 900px; margin: auto; }
        h1 { text-align: center; color: #d63031; margin-bottom: 30px; }
        
        /* Grid Layout pour les cartes */
        .jobs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        /* Style de la Carte */
        .job-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border-left: 5px solid #d63031; /* Barre rouge style TunJob */
            transition: transform 0.2s;
        }
        .job-card:hover { transform: translateY(-5px); }

        .job-title { font-size: 1.25rem; font-weight: bold; color: #2d3436; margin-bottom: 10px; }
        .boss-name { color: #636e72; font-size: 0.9rem; margin-bottom: 15px; }
        .job-info { font-size: 0.95rem; margin-bottom: 8px; }
        .job-info strong { color: #2d3436; }
        
        .btn-contact {
            display: inline-block;
            margin-top: 15px;
            background: #10b981;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>💼 available job offer</h1>

    <div class="jobs-grid">
        <?php
        // 1. Connexion à la base
        $cnx = mysqli_connect("localhost", "root", "", "batal");

        if (!$cnx) {
            die("<p>Erreur de connexion</p>");
        }

        // 2. Récupérer les travaux
        $sql = "SELECT * FROM travaux ORDER BY id DESC"; // Les plus récents en premier
        $res = mysqli_query($cnx, $sql);

        // 3. Boucle pour afficher chaque offre
        if (mysqli_num_rows($res) > 0) {
            while ($job = mysqli_fetch_assoc($res)) {
                echo '<div class="job-card">';
                echo '  <div class="job-title">' . htmlspecialchars($job['sujet']) . '</div>';
                echo '  <div class="boss-name">published by : ' . htmlspecialchars($job['nom_boss']) . '</div>';
                echo '  <div class="job-info">📅 <strong>start :</strong> ' . $job['date_debut'] . '</div>';
                echo '  <div class="job-info">⌛ <strong>end :</strong> ' . $job['date_fin'] . '</div>';
                echo '  <div class="job-info">📞 <strong>Contact :</strong> ' . htmlspecialchars($job['telephone']) . '</div>';
                echo '  <a href="tel:' . $job['telephone'] . '" class="btn-contact">call the Boss</a>';
                echo '</div>';
            }
        } else {
            echo "<p style='text-align:center;'>no offers available at the moment.</p>";
        }

        mysqli_close($cnx);
        ?>
    </div>
</div>

</body>
</html>