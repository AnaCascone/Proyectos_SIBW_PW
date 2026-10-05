        <footer>
            <p>© 2026 Nexus Gate - Agencia de viajes gamer</p>

            <nav class="footer-links">
                <a href="<?= $rutaBase ?>contacto.php">Contacto</a>
                <a href="como_se_hizo.pdf">Cómo se hizo</a>
            </nav>

            <p class="fecha">Última actualización: 7 de abril de 2026</p>
        </footer>

        <!-- Scripts específicos de cada página -->
        <?php if (!empty($jsPagina)): ?>

            <?php if (is_array($jsPagina)): ?>

                <?php foreach ($jsPagina as $archivoJs): ?>
                    <script src="<?= $rutaBase ?>js/<?= $archivoJs ?>"></script>
                <?php endforeach; ?>

            <?php else: ?>

                <script src="<?= $rutaBase ?>js/<?= $jsPagina ?>"></script>

            <?php endif; ?>

        <?php endif; ?>
    </body>
</html>