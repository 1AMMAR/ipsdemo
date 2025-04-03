<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Request</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: white;
      font-size: 16px;
    }

    .forum-container {
      background: rgb(14, 108, 185);
      padding: 80px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
      text-align: center;
      width: 100%;
      margin:50px;
      max-width: 400px;
    }

    h1 {
      font-size: 2em;
      margin-bottom: 20px;
      text-transform: uppercase;
      letter-spacing: 2px;
      font-weight: 600;
    }

    .email-input {
      width: 100%;
      padding: 15px;
      font-size: 1em;
      color: #333;
      border: none;
      border-radius: 10px;
      background: white;
      margin-bottom: 20px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .email-input:focus {
      outline: none;
      box-shadow: 0 0 10px rgba(52, 152, 219, 0.8);
      border: 2px solid #3498db;
    }

    .submit-button {
      width: 100%;
      padding: 15px;
      background: #3498db;
      border: none;
      border-radius: 10px;
      color: white;
      font-size: 1.2em;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .submit-button:hover {
      background: #2980b9;
      transform: translateY(-3px);
    }

    .submit-button:active {
      background: #1f7b9c;
      transform: translateY(2px);
    }

    .message {
      font-size: 0.9em;
      margin-top: 15px;
      color: rgba(255, 255, 255, 0.7);
    }

    .message a {
      color: #3498db;
      text-decoration: none;
    }

    a
    {
        color:white;
        
      text-decoration: none;
    }

    a:hover
    {
        color:rgb(18, 228, 106);
    }

  </style>
</head>
<body>

<form action="https://formspree.io/f/xvgkoqed" method="POST">

  <div class="forum-container">
    <h1>Registration Request</h1>
    <br><br>
    <input type="email" class="email-input" name="email" placeholder="enter email">
    <br><br>
    <button type="submit" class="submit-button"> Send</button>
    <p class="message">By submitting, you agree to our <a href="#">Privacy Policy</a>.</p>
    <br><br>
  <a href="login.php">Already have an account?</a>
<br><br>
<a href="">visit our mother company</a>
  </div>




</form>

</body>
</html>
