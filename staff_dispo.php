<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Travailleurs Disponibles</title>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; padding: 20px; color: #334155; }
        .container { max-width: 1000px; margin: auto; }
        h1 { text-align: center; color: #2d3250; margin-bottom: 30px; }

        .staff-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .staff-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            position: relative;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        /* Badge Disponible */
        .status-badge {
            background: #10b981;
            color: white;
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            position: absolute;
            top: 15px;
            right: 15px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .staff-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
            text-transform: capitalize;
        }

        .staff-tel {
            color: #00cec9;
            font-weight: 600;
            margin-bottom: 15px;
            display: block;
            text-decoration: none;
        }

        .experience-box {
            background: #f1f5f9;
            padding: 10px;
            border-radius: 8px;
            font-size: 0.9rem;
            min-height: 60px;
            margin-bottom: 15px;
        }

        .info-item {
            font-size: 0.85rem;
            color: #64748b;
        }

        .btn-call {
            display: block;
            text-align: center;
            background: #2d3250;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-call:hover { background: #00cec9; }
    </style>
</head>
<body>

<div class="container">
    <h1>👷 workers ready for employment</h1>

    <div class="staff-grid">
        <?php
        $cnx = mysqli_connect("localhost", "root", "", "batal");

        if (!$cnx) { die("Erreur de connexion"); }

        // On sélectionne SEULEMENT ceux qui ont dit "Oui" pour la disponibilité
        $sql = "SELECT * FROM utilisateurs WHERE disponible = 'Oui' ORDER BY id DESC";
        $res = mysqli_query($cnx, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                echo '<div class="staff-card">';
                echo '  <span class="status-badge">available</span>';
                echo '  <div class="staff-name">' . htmlspecialchars($row['prenom']) . ' ' . htmlspecialchars($row['nom']) . '</div>';
                echo '  <a href="tel:' . $row['tel'] . '" class="staff-tel">📞 ' . htmlspecialchars($row['tel']) . '</a>';
                
                echo '  <div class="experience-box">';
                echo '    <strong>Experience:</strong><br>' . nl2br(htmlspecialchars($row['experience']));
                echo '  </div>';
                
                echo '  <div class="info-item">🎂 born on : ' . $row['date_naissance'] . '</div>';
                echo '  <a href="tel:' . $row['tel'] . '" class="btn-call">Contact</a>';
                echo '</div>';
            }
        } else {
            echo "<p style='grid-column: 1/-1; text-align:center;'>worker account available for now .</p>";
        }

        mysqli_close($cnx);
        ?>
    </div>
</div>

</body>
</html>