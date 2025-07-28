</main>

<footer>
  <div class="footer-top">
    <nav>
      <a href="/terms">CGU</a>
      <a href="/privacy">Politique de confidentialité</a>
      <a href="/contact">Contact</a>
      <a href="/about">À propos</a>
    </nav>
  </div>
  <div class="footer-bottom">
    <p>&copy; <?= date('Y') ?> SkillSwipe. Tous droits réservés.</p>
  </div>
</footer>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    // Dropdown
    const dropdown = document.querySelector(".dropdown");
    const toggle = document.querySelector(".dropdown-toggle");

    if (dropdown && toggle) {
      toggle.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdown.classList.toggle("active");
      });

      document.addEventListener("click", (e) => {
        if (!dropdown.contains(e.target)) {
          dropdown.classList.remove("active");
        }
      });
    }

    // Burger menu plein écran
    const menuToggle = document.getElementById('menu-toggle');
    const fullscreenMenu = document.getElementById('fullscreen-menu');
    const closeMenu = document.getElementById('close-menu');

    if (menuToggle && fullscreenMenu) {
      menuToggle.addEventListener('click', () => {
        fullscreenMenu.classList.toggle('hidden');
      });

      fullscreenMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
          fullscreenMenu.classList.add('hidden');
        });
      });

      if (closeMenu) {
        closeMenu.addEventListener('click', () => {
          fullscreenMenu.classList.add('hidden');
        });
      }
    }
  });
</script>

</body>

</html>