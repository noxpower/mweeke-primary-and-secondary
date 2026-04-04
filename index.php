<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mweeke School</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* Base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
      color: #333;
    }

    /* Header layout */
    .school-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #0077cc;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .school-header img {
      height: 80px;
      width: auto;
    }

    .header-text {
      flex: 1;
      text-align: center;
      color: floralwhite;
    }

    .header-text h1 {
      margin: 0;
      font-size: 2em;
    }

    .header-text p {
      margin: 5px 0 0;
      font-size: 1em;
    }

    nav {
      background-color: #ffffff;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
      padding: 15px 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    nav a {
      text-decoration: none;
      color: #0077cc;
      font-weight: bold;
      padding: 10px 18px;
      border-radius: 5px;
      background-color: #e8f4fc;
      transition: all 0.3s ease;
    }

    nav a:hover {
      background-color: #0077cc;
      color: white;
    }

    .hero {
      text-align: center;
      padding: 60px 20px;
      background: linear-gradient(to bottom, #ffffff, #e8f4fc);
      animation: fadeIn 1.5s ease;
    }

    .hero h2 {
      font-size: 32px;
      color: #005fa3;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 18px;
      max-width: 700px;
      margin: 0 auto;
      color: black;
    }

    .cta-buttons {
      margin-top: 30px;
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    .cta-buttons a {
      background-color: #0077cc;
      color: white;
      padding: 12px 24px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .cta-buttons a:hover {
      background-color: #005fa3;
    }

    .student-login {
      max-width: 400px;
      margin: 40px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
    }

    .student-login img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-bottom: 15px;
    }

    .student-login input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .student-login button {
      width: 100%;
      padding: 10px;
      background-color: #0077cc;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    .student-login button:hover {
      background-color: #005fa3;
    }

    .news-section {
      max-width: 800px;
      margin: 60px auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .news-section h3 {
      color: #0077cc;
      margin-bottom: 20px;
      text-align: center;
    }

    .news-section ul {
      list-style: none;
      padding: 0;
    }

    .news-section ul li {
      margin-bottom: 15px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
    }

    .carousel {
      max-width: 700px;
      margin: 60px auto;
      text-align: center;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .carousel h3 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .carousel img {
      width: 100%;
      height: auto;
      border-radius: 10px;
      transition: opacity 0.5s ease-in-out;
    }

    .carousel p {
      margin-top: 15px;
      font-size: 16px;
      color: #555;
    }

    footer {
      background-color: #0077cc;
      color: white;
      text-align: center;
      padding: 20px 0;
      margin-top: 40px;
    }

    footer p {
      margin: 0;
      font-weight: 500;
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    @media (max-width: 600px) {
      .school-header {
        flex-direction: column;
        text-align: center;
      }

      .school-header img {
        margin: 10px 0;
      }

      .header-text {
        margin: 10px 0;
      }

      .hero h2 {
        font-size: 24px;
      }

      nav a {
        padding: 8px 12px;
        font-size: 14px;
      }

      .cta-buttons a {
        padding: 10px 16px;
        font-size: 14px;
      }
    }

    /* Moving text container - full width */
    .moving-text-container {
      width: 100%;
      overflow: hidden;
      background: linear-gradient(135deg, #f8f9fa, #e3f2fd);
      padding: 20px 0;
      border-top: 2px solid #0077cc;
      border-bottom: 2px solid #0077cc;
      margin: 20px 0;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    /* The moving text with slower animation */
    .moving-text {
      display: inline-block;
      white-space: nowrap;
      animation: slide 40s linear infinite; /* Slower: 40 seconds */
      font-size: 1.8em;
      color: #005fa3;
      font-weight: bold;
      padding-left: 20px;
    }

    .moving-text i {
      color: #ff6b6b;
      margin: 0 15px;
      font-size: 0.9em;
    }

    .moving-text span {
      color: #0077cc;
      background: rgba(0, 119, 204, 0.1);
      padding: 5px 15px;
      border-radius: 30px;
      margin: 0 10px;
      font-size: 0.8em;
    }

    @keyframes slide {
      0% {
        transform: translateX(100%);
      }
      100% {
        transform: translateX(-100%);
      }
    }

    .social-links {
      display: flex;
      gap: 15px;
      justify-content: center;
      margin: 20px 0;
    }

    .social-links a {
      font-size: 28px;
      color: #008080;
      transition: color 0.3s ease;
    }

    .social-links a.whatsapp:hover { color: #25D366; }
    .social-links a.facebook:hover { color: #1877F2; }
    .social-links a.twitter:hover  { color: #1DA1F2; }
    .social-links a.youtube:hover  { color: #FF0000; }

    /* Mission and Vision cards - separate from moving text */
    .mission-vision-container {
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
      max-width: 1000px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .mission-card, .vision-card {
      flex: 1;
      min-width: 280px;
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      border-top: 5px solid #0077cc;
    }

    .mission-card:hover, .vision-card:hover {
      transform: translateY(-5px);
    }

    .mission-card h3, .vision-card h3 {
      color: #0077cc;
      font-size: 24px;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .mission-card p, .vision-card p {
      color: black;
      line-height: 1.8;
      font-size: 16px;
    }

    .mission-icon, .vision-icon {
      font-size: 32px;
    }

    /* For the original h2 moving text in hero section */
    .hero h2 {
      display: inline-block;
      white-space: nowrap;
      overflow: hidden;
      animation: slide 15s linear infinite;
      font-size: 2em;
      color: #2c3e50;
      margin-bottom: 20px;
    }

    /* Dropdown hover functionality */
   /* Dropdown container */
  .dropdown {
    position: relative;
    display: inline-block;
  }
  
  /* Main Login button hover effect */
  .dropdown > a {
    transition: all 0.3s ease !important;
    border: 1px solid transparent !important;
  }
  
  .dropdown:hover > a {
    background-color: #0077cc !important;
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 119, 204, 0.3);
    border-color: #005fa3 !important;
  }
  
  /* Show dropdown on hover */
  .dropdown:hover .dropdown-menu {
    display: block !important;
    animation: fadeInDown 0.3s ease;
  }
  
  /* Dropdown menu styling */
  .dropdown-menu {
    border: none !important;
    overflow: hidden;
  }
  
  /* Dropdown items hover effect */
  .dropdown-menu li a {
    transition: all 0.3s ease !important;
    position: relative;
    overflow: hidden;
  }
  
  /* Production item hover effect */
  .dropdown-menu li:first-child a:hover {
    background: linear-gradient(135deg, #0077cc10, #0077cc20) !important;
    color: #0077cc !important;
    padding-left: 25px !important;
  }
  
  .dropdown-menu li:first-child a:hover i {
    transform: scale(1.1);
    color: #0077cc !important;
  }
  
  /* Finance item hover effect */
  .dropdown-menu li:last-child a:hover {
    background: linear-gradient(135deg, #27ae6010, #27ae6020) !important;
    color: #27ae60 !important;
    padding-left: 25px !important;
  }
  
  .dropdown-menu li:last-child a:hover i {
    transform: scale(1.1);
    color: #27ae60 !important;
  }
  
  /* Add sliding animation on hover */
  .dropdown-menu li a::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: #0077cc;
    transform: scaleY(0);
    transition: transform 0.3s ease;
  }
  
  .dropdown-menu li:first-child a:hover::before {
    transform: scaleY(1);
    background: #0077cc;
  }
  
  .dropdown-menu li:last-child a:hover::before {
    transform: scaleY(1);
    background: #27ae60;
  }
  
  /* Icon animation */
  .dropdown-menu li a i {
    transition: transform 0.3s ease, color 0.3s ease;
  }
  
  /* Animation for dropdown appearance */
  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  /* Add a subtle shadow on hover for dropdown items */
  .dropdown-menu li a:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  }
  
  /* Style for the icons in dropdown */
  .dropdown-menu li a i {
    width: 20px;
    text-align: center;
  }
  
  /* Make the dropdown menu appear smoothly */
  .dropdown-menu {
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease;
    transform: translateY(-10px);
  }
  
  .dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }
  
  /* Add a small arrow indicator on the main button */
  .dropdown > a::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid #0077cc;
    opacity: 0;
    transition: opacity 0.3s ease;
  }
  
  .dropdown:hover > a::after {
    opacity: 1;
  }
  </style>
</head>
<body>

  <header class="school-header">
    <img src="/learn/assets/images/coat_of_arms.png" alt="Coat of Arms">
    
    <div class="header-text">
      <h1>MWEEKE PRIMARY AND SECONDARY SCHOOL</h1>
      <p>Empowering Learners, Supporting Teachers, Building the Future</p>
    </div>
    
    <img src="/learn/assets/images/schoollogo.png" alt="School Logo">
  </header>

  <nav>
      <a href="https://www.w3schools.com/" target="_blank">E-Learning</a>
      <a href="https://www.teacher.tcz.ac.zm/teacherLogin.php" target="_blank">TCZ Portal</a>
      <a href="https://systems.exams-council.org.zm/" target="_blank">ECZ Web Portal</a>
      <a href="https://www.edu.gov.zm/" target="_blank">MOE</a>
      <a href="#">PTA Info</a>
      <a href="#">Sports</a>
      <a href="#">Jets</a>
      <a href="showcase.php">Showcase</a>

      <!-- Fixed Dropdown - No bullets, aligned properly -->
      <li class="dropdown" style="display: inline-block; list-style: none; margin: 0; padding: 0;">
          <a href="#" style="text-decoration: none; color: #0077cc; font-weight: bold; padding: 10px 18px; border-radius: 5px; background-color: #e8f4fc; transition: all 0.3s ease; display: inline-block; border: 1px solid transparent;">Login ▼</a>
        <ul class="dropdown-menu" style="display: none; position: absolute; background-color: white; min-width: 180px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); border-radius: 8px; z-index: 1000; padding: 8px 0; margin: 5px 0 0 0; list-style: none; border: 1px solid #e0e0e0;">
            
           <li style="list-style: none;">
              <a href="finance.php" style="color: #333; padding: 12px 20px; text-decoration: none; display: flex; align-items: center; gap: 10px; font-weight: 500; transition: all 0.3s ease;">
                  <i class="fas fa-coins" style="color: #27ae60; font-size: 16px;"></i>
                  Finance Portal
              </a> 

              <a href="/learn/library_login.php" style="color: #333; padding: 12px 20px; text-decoration: none; display: flex; align-items: center; gap: 10px; font-weight: 500; transition: all 0.3s ease; border-bottom: 1px solid #f0f0f0;">
                  <i class="fas fa-industry" style="color: #63cc00; font-size: 16px;"></i>
                  Library
                </a>
            </li>
        
            <li style="list-style: none;">
                <a href="/learn/admin/login.php" style="color: #333; padding: 12px 20px; text-decoration: none; display: flex; align-items: center; gap: 10px; font-weight: 500; transition: all 0.3s ease; border-bottom: 1px solid #f0f0f0;">
                  <i class="fas fa-industry" style="color: #0077cc; font-size: 16px;"></i>
                  Production Unit
                </a>
            </li>
               
            <li style="list-style: none;">
              <a href="stores_login.php" style="color: #333; padding: 12px 20px; text-decoration: none; display: flex; align-items: center; gap: 10px; font-weight: 500; transition: all 0.3s ease;">
                  <i class="fas fa-coins" style="color: #ae2797; font-size: 16px;"></i>
                  Stores Portal
              </a>
            </li>
        </ul>
    </li>
</nav>

  <!-- Moving text container (slower) -->
  <div class="moving-text-container">
    <div class="moving-text">
      ✨ Welcome to Mweeke Primary & Secondary School Management System  
      <i class="fas fa-star"></i> Empowering Learners, Supporting Teachers, Building the Future 
      <span>Quality Inclusive Education for All</span> ✨
    </div>
  </div>

  <div class="social-links">
    <a href="https://wa.me/0977405054" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
    <a href="https://facebook.com/YourPage" target="_blank" class="facebook"><i class="fab fa-facebook"></i></a>
    <a href="https://twitter.com/YourHandle" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
    <a href="https://youtube.com/YourChannel" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
  </div>

  <!-- Mission and Vision Cards (separate section) -->
  <div class="mission-vision-container">
    <div class="mission-card">
      <h3>
        <span class="mission-icon">🎯</span>
        Our Mission Statement
      </h3>
      <p>To provide quality education to the learners who will contribute to the development of the nation.</p>
    </div>

    <div class="vision-card">
      <h3>
        <span class="vision-icon">👁️</span>
        Our Vision
      </h3>
      <p>To provide quality education to all regardless of sex, race, ethnicity for sustainable national development in a diverse world.</p>
    </div>
  </div>

  <div class="hero">
    <p>
      Our digital platform connects Learners, Teachers, Administrators, Parents and all Stakeholders with powerful tools for learning, communication, and collaboration.
    </p>

    <div class="cta-buttons">
      <a href="contact.php">Contact Us</a>
      <a href="pages/login.php">Get Started</a>
    </div>
    
    <h2 style="color: #0077cc">Motto Primary: Inclusive Learning for All</h2>
    <h2 style="color: #0077cc">Motto Secondary: Elevating Minds, Igniting Excellence</h2>
  </div>
    
  <div class="student-login">
    <img src="assets/images/profile-placeholder.png" alt="Headteacher Profile">
    <form method="POST" action="pages/student_login.php">
      <input type="text" name="student_id" placeholder="Student ID" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Student Login</button>
    </form>
  </div>

  <div class="news-section">
    <h3>Latest Announcements</h3>
    <ul>
      <li><strong>Nov 3rd:</strong> Exams Grade 12 Exams started. Check your timetable.</li>
      <li><strong>Nov:</strong> Library hours extended to 8 PM.</li>
      <li><strong>Dec:</strong> Teacher training workshop.</li>
      <li><strong>Admin:</strong> Teacher are thanked for there team spirit!!!</li>
    </ul>
  </div>

  <div class="carousel">
    <h3>School Highlights</h3>
    <img id="carouselImage" src="assets/images/events/event1.jpg" alt="School Event">
    <p id="carouselCaption">Grade 11, 2026 — Class</p>
  </div>

  <script>
    const images = [
      { src: "assets/images/events/event1.jpg", caption: "Grade 11, 2025 — Class" },
      { src: "assets/images/events/event2.jpg", caption: "STP 2025 — Team Spirit Unleashed" },
      { src: "assets/images/events/event3.jpg", caption: "STP 2025 — Team Spirit Unleashed" },
      { src: "assets/images/events/event4.jpg", caption: "STP 2025 — Team Spirit Unleashed" },
      { src: "assets/images/events/event5.jpg", caption: "STP 2025 — Team Spirit Unleashed" },
      { src: "assets/images/events/event6.jpg", caption: "STP 2025 — Team Spirit Unleashed" },
      { src: "assets/images/events/event7.jpg", caption: "STP 2025 — Team Spirit Unleashed" },
      { src: "assets/images/events/event8.jpg", caption: "Sanitation — Health" },
      { src: "assets/images/events/event9.jpg", caption: "Sanitation — Health" },
      { src: "assets/images/events/event10.jpg", caption: "Sanitation — Health" },
      { src: "assets/images/events/event11.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event12.jpg", caption: "Admission — Block" },
      { src: "assets/images/events/event13.jpg", caption: "ECE — Class" },
      { src: "assets/images/events/event14.jpg", caption: "ECE — Class" },
      { src: "assets/images/events/event15.jpg", caption: "ECE — Class" },
      { src: "assets/images/events/event16.jpg", caption: "Grade 9 - 2025" },
      { src: "assets/images/events/event17.jpg", caption: "Grade 9 - 2025" },
      { src: "assets/images/events/event18.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event19.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event20.jpg", caption: "Form 1 — Class" },
      { src: "assets/images/events/event21.jpg", caption: "Form 1 — Class" },
      { src: "assets/images/events/event22.jpg", caption: "Form 1 — Class" },
      { src: "assets/images/events/event23.jpg", caption: "Form 1 — Class" },
      { src: "assets/images/events/event24.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event25.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event26.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event27.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event28.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event29.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event30.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event31.jpg", caption: "Grade 12 Class - 2025" },
      { src: "assets/images/events/event32.jpg", caption: "Grade 12 Class - 2025" },
      { src: "assets/images/events/event33.jpg", caption: "Grade 12 Class - 2025" },
      { src: "assets/images/events/event34.jpg", caption: "Grade 11 Class - 2025" },
      { src: "assets/images/events/event35.jpg", caption: "Grade 11 Class - 2025" },
      { src: "assets/images/events/event36.jpg", caption: "Secondary — Block" },
      { src: "assets/images/events/event37.jpg", caption: "Secondary — Block" },
      { src: "assets/images/events/event38.jpg", caption: "Secondary — Block" },
      { src: "assets/images/events/event39.jpg", caption: "Secondary — Block" },
      { src: "assets/images/events/event40.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event41.jpg", caption: "Sports - 2025" },
      { src: "assets/images/events/event42.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event43.jpg", caption: "Science — Innoventions" },
      { src: "assets/images/events/event44.jpg", caption: "CDF - Desks, 2025" },
      { src: "assets/images/events/event45.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event46.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event47.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event48.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event49.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event50.jpg", caption: "Form 1 — Class" },
      { src: "assets/images/events/event51.jpg", caption: "Form 1 — Class" },
      { src: "assets/images/events/event52.jpg", caption: "Form 1 — Class" },
      { src: "assets/images/events/event53.jpg", caption: "Science Fair 2025 — Innovation in Action" },
      { src: "assets/images/events/event54.jpg", caption: "Science Fair 2025 — Innovation in Action" },
      { src: "assets/images/events/event55.jpg", caption: "Science Fair 2025 — Innovation in Action" },
      { src: "assets/images/events/event56.jpg", caption: "PU — Cashow Plantation" },
      { src: "assets/images/events/event57.jpg", caption: "PU — Cashow Plantation" },
      { src: "assets/images/events/event58.jpg", caption: "PU — Cashow Plantation" },
      { src: "assets/images/events/event59.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event60.jpg", caption: "PU — Cashow Plantation" },
      { src: "assets/images/events/event61.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event62.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event63.jpg", caption: "ICT — Innoventions" },
      { src: "assets/images/events/event64.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event65.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event66.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event67.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event68.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event69.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event70.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event71.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event72.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event73.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event74.jpg", caption: "2025 — Sports" },
      { src: "assets/images/events/event75.jpg", caption: "2025 — Sports" },
    ];

    let currentIndex = 0;
    const imageElement = document.getElementById("carouselImage");
    const captionElement = document.getElementById("carouselCaption");

    setInterval(() => {
      currentIndex = (currentIndex + 1) % images.length;
      imageElement.src = images[currentIndex].src;
      captionElement.textContent = images[currentIndex].caption;
    }, 3000);
  </script>

  <footer>
    <p>&copy; <?php echo date('Y'); ?> Mweeke School. All rights reserved.</p>
  </footer>

</body>
</html>
