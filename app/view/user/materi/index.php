<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../../../assets/css/pilihan-materi.css" />
  <title>Document</title>
</head>

<body>
  <header>
    <h1 class=" animate">Selamat datang!</h1>
    <p class="animate">
      Temukan dunia menakjubkan anatomi manusia dan pelajari segala sesuatu tentang tulang!
    </p>

  </header>
  <main>
    <section class="animate">
      <h2>Tulang Manusia</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id
        felis et ipsum bibendum ultrices.
      </p>
      <a href="opening-tulang.php" class="button">Pelajari</a>
    </section>
    <section class="animate">
      <h2>Sendi Gerak</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id
        felis et ipsum bibendum ultrices.
      </p>
      <a href="opening-sendi.php" class="button">Pelajari</a>
    </section>

    <section class="animate">
      <h2>Otot</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id
        felis et ipsum bibendum ultrices.
      </p>
      <a href="opening-otot.php" class="button">Pelajari</a>
    </section>

    <section class="animate">
      <h2>Penyakit tulang</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id
        felis et ipsum bibendum ultrices.
      </p>
      <a href="Penyakit.php" class="button">Pelajari</a>
    </section>

    <section class="animate">
      <h2>Kuis</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id
        felis et ipsum bibendum ultrices.
      </p>
      <a href="#" class="button">Pelajari</a>
    </section>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('show');
          }
        });
      });

      document.querySelectorAll('.animate').forEach(el => {
        observer.observe(el);
      });
    });
  </script>
</body>

</html>