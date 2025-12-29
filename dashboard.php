<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$username = $_SESSION['username'];

$conn = new mysqli("localhost", "root", "", "studyspace", 3307);
$email = '';

$result = $conn->query("SELECT id, email, created_at FROM users WHERE name='$username' LIMIT 1");

$email = $created = $userid = '';
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $email = $row['email'];
  $created = date('F j, Y', strtotime($row['created_at']));
  $userid = $row['id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile | StudySpace</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    <!-- Add inside <style> tag or CSS file -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

body {
  font-family: 'Poppins', sans-serif;
  background: url('bg.jpg') no-repeat center center/cover;
  color: #fff;
  overflow-x: hidden;
  min-height: 100vh;
}

.overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: linear-gradient(to right, rgba(0,0,0,0.6), rgba(93,12,255,0.3));
  animation: pulseOverlay 10s infinite alternate;
  z-index: 0;
}



.profile-section {
  min-height: 100vh;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  padding: 6rem 2rem 4rem;
  z-index: 2;
  position: relative;
}

.profile-card {
  display: flex;
  flex-direction: row;
  gap: 3rem;
  align-items: flex-start;
  max-width: 1200px;
  background: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(18px);
  border-radius: 24px;
  padding: 4rem 5rem;
  box-shadow: 0 0 60px rgba(0,0,0,0.3);
  animation: slideIn 1s ease-out;
}

@keyframes slideIn {
  from { opacity: 0; transform: translateY(40px); }
  to { opacity: 1; transform: translateY(0); }
}

.profile-avatar {
  width: 140px;
  height: 140px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid rgba(255, 255, 255, 0.6);
  box-shadow: 0 0 25px rgba(255, 255, 255, 0.3);
  animation: glowAvatar 2s ease-in-out infinite alternate;
}



.profile-info h2 {
  font-size: 2.8rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  animation: bounceFade 1.2s ease-out;
}

@keyframes bounceFade {
  0% { opacity: 0; transform: scale(0.8); }
  60% { opacity: 1; transform: scale(1.1); }
  100% { transform: scale(1); }
}

.profile-info p {
  font-size: 1.2rem;
  margin-bottom: 0.6rem;
  color: rgba(255, 255, 255, 0.95);
  animation: fadeInUp 1s ease;
  animation-fill-mode: both;
}

.profile-info p:nth-of-type(1) { animation-delay: 0.2s; }
.profile-info p:nth-of-type(2) { animation-delay: 0.4s; }
.profile-info p:nth-of-type(3) { animation-delay: 0.6s; }
.profile-info p:nth-of-type(4) { animation-delay: 0.8s; }
.profile-info p:nth-of-type(5) { animation-delay: 1s; }
.profile-info p:nth-of-type(6) { animation-delay: 1.2s; }

@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.navbar .logout-btn {
  margin-left: 1rem;
  border-radius: 20px;
  padding: 0.5rem 1rem;
  background: #fff;
  color: #000;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

.navbar .logout-btn:hover {
  background: #c084fc;
  color: #fff;
}

@media (max-width: 768px) {
  .profile-card {
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 2.5rem;
  }

  .profile-info {
    text-align: center;
  }
}


.profile-section {
  min-height: 100vh;
  width: 100%;
  display: flex;
  align-items: flex-start;  /* ⬆️ push content to top */
  justify-content: center;
  padding: 7rem 2rem 4rem; /* Top padding for navbar spacing */
  position: relative;
  z-index: 2;
}
.profile-card {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  width: 100%;
  max-width: 1200px;
  background: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(18px);
  border-radius: 24px;
  padding: 4rem 5rem;
  box-shadow: 0 0 60px rgba(0,0,0,0.3);
  color: #fff;
  gap: 3rem;
  min-height: 720px; /* ⬇️ extend vertical size */
}
/* ✅ Fix navbar font, spacing, logo, and button */
.navbar-brand {
  font-weight: 600;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

.navbar-brand img {
  height: 36px;
}

.navbar-nav .nav-link {
  font-weight: 500;
  font-size: 1.05rem;
  padding-left: 1.2rem;
  padding-right: 1.2rem;
  transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover {
  color: #c084fc;
}

.navbar .btn-light {
  border-radius: 0.7rem;
  padding: 0.4rem 1.2rem;
  font-weight: 600;
  font-size: 1rem;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}



.profile-avatar {
  width: 140px;
  height: 140px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid rgba(255, 255, 255, 0.6);
  box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
}
.profile-info {
  text-align: left;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.profile-info h2 {
  font-size: 2.5rem;
  margin-bottom: 1.5rem;
}

.profile-info p {
  font-size: 1.15rem;
  margin-bottom: 0.6rem;
  color: rgba(255, 255, 255, 0.95);
}


    .navbar .logout-btn {
      margin-left: 1rem;
      border-radius: 20px;
      padding: 0.5rem 1rem;
      background: #fff;
      color: #000;
      font-weight: 600;
      text-decoration: none;
    }
    .profile-card.flex-column {
  flex-direction: column;
  align-items: center;
  padding: 3rem 2rem;
}



@media (max-width: 768px) {
  .profile-card {
    flex-direction: column;
    text-align: center;
    padding: 2.5rem;
  }

  .profile-info {
    text-align: center;
  }
}

      .profile-avatar {
        margin-bottom: 1.5rem;
      }
    }
  </style>
</head>
<body>

<div class="overlay"></div>

<nav class="navbar navbar-expand-lg navbar-dark bg-transparent px-4 w-100 fixed-top">
    <a class="navbar-brand d-flex align-items-center" href="index.html">
      <img src="logo-white.png" alt="StudySpace Logo" style="height: 50px; margin-right: 10px;">
      <strong class="text-white">StudySpace</strong>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link text-white" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="dashboard.php">Profile</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="notes.html">Notes</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="planner.html">Timetable</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="pomodoro.html">Pomodoro</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="contact.html">Contact</a></li>
        <li class="nav-item"><a class="btn btn-light ms-2" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>

<section class="profile-section">
  <div class="profile-card">
    <img src="profile-pic.png" alt="Profile Avatar" class="profile-avatar">

    <div class="profile-info">
      <h2>WELCOME, <?= htmlspecialchars(strtoupper($username)) ?> !</h2>
      <p><strong>Name:</strong> <?= htmlspecialchars($username) ?></p>
      <p><strong>User ID:</strong> #<?= $userid ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
      <p><strong>Account Type:</strong> Student</p>
      <p><strong>Status:</strong> Active</p>
      <p><strong>Joined On:</strong> <?= $created ?></p>
    </div>
  </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
