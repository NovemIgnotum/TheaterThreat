</main>
    <footer>
        <p>&copy; <?= date('Y') ?> TheaterThreat - Version Sécurisée</p>
        <p>Dernière mise à jour : <?= date('d/m/Y H:i') ?></p>
    </footer>
    <script src="/assets/js/script.js"></script>
</body>
</html>
<?php
// Limiter l'exposition des infos serveur
header_remove('X-Powered-By');
?>