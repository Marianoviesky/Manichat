<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body style="min-height: 100vh;">
  <div class="wrapper" style="position: relative;">
    <section class="form signup">
      <header style="text-align: center;">Manichat</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>Prénom</label>
            <input type="text" name="fname" placeholder="Votre prénom" required>
          </div>
          <div class="field input">
            <label>Nom</label>
            <input type="text" name="lname" placeholder="Votre nom" required>
          </div>
        </div>
        <div class="field input">
          <label>Adresse email</label>
          <input type="text" name="email" placeholder="Entrez votre email" required>
        </div>
        <div class="field input">
          <label>Mot de passe</label>
          <input type="password" name="password" placeholder="Entrez un mot de passe" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Sélectionner une photo de profil</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continuer vers la discussion">
        </div>
      </form>
      <div class="link">Avez-vous déjà un comte? <a href="login.php">Se connecter</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
