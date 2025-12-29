<?php
session_start();
$toast = '';
$toastType = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $conn = new mysqli("localhost", "root", "", "studyspace", 3307);

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm = $_POST['confirm_password'];

  if ($password !== $confirm) {
    $toast = "Passwords do not match.";
    $toastType = 'danger';
  } else {
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
      $toast = "Email already registered.";
      $toastType = 'danger';
    } else {
      $hash = password_hash($password, PASSWORD_BCRYPT);
      $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hash')");
      $toast = "Registered successfully! Please login.";
      $toastType = 'success';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up | StudySpace</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="overlay"></div>

<nav class="navbar navbar-expand-lg navbar-dark bg-transparent px-4 w-100">
  <a class="navbar-brand d-flex align-items-center" href="index.html">
  <img src="logo-white.png" alt="StudySpace Logo" style="height: 60px; margin-right: 12px;">
  <span class="studyspace-logo">Study<span>Space</span></span>
</a>

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link text-white" href="index.html">Home</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="notes.html">Notes</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="planner.html">Planner</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="pomodoro.html">Pomodoro</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="dashboard.php">Profile</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="contact.html">Contact</a></li>
      

      <li class="nav-item"><a class="nav-link text-white" href="login.php">Login</a></li>
      <li class="nav-item"><a class="btn btn-light ms-2" href="register.php">Sign Up</a></li>
    </ul>
  </div>
</nav>


<div class="split-container">
  <!-- LEFT SIDE: Welcome Message -->
  <div class="left-pane">
    <div class="welcome-text">
      <h1>Welcome to StudySpace</h1>
      <p>Your ultimate student productivity hub — organize notes, plan your week, and stay focused like a pro.</p>
    </div>
  </div>

  <!-- RIGHT SIDE: Sign Up Form -->
  <div class="right-pane">
    <form method="POST">
      <p style="text-align: center; color: #fff;">Already have an account? <a href="login.php" style="color: #a6e1ff;">Login</a></p>
      <h2 class="fade-item fade-delay-1">Sign Up</h2>

<input type="text" name="name" placeholder="Full Name" class="glass-input fade-item fade-delay-2" required>
<input type="email" name="email" placeholder="Email" class="glass-input fade-item fade-delay-3" required>
<input type="password" name="password" placeholder="Password" class="glass-input fade-item fade-delay-4" required>
<input type="password" name="confirm_password" placeholder="Confirm Password" class="glass-input fade-item fade-delay-5" required>

<button type="submit" class="fade-item fade-delay-6">Sign Up</button>


      <div class="form-footer">
  <label><input type="checkbox"> Remember Me</label>
  <span>Terms & conditions</span>
</div>

    </form>
  </div>
</div>


<?php if (!empty($toast)): ?>
  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div class="toast show align-items-center text-bg-<?= $toastType ?> border-0" role="alert">
      <div class="d-flex">
        <div class="toast-body"><?= htmlspecialchars($toast) ?></div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
