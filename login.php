<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .cms-form {
            background: white;
            padding: 4rem;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.19);
            width: 100%;
            max-width: 600px;
            transition-duration: 0.5s;
        }

        .cms-form:hover {
            transform:scale(1.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.89);
        }

        .cms-form h1 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }

        .form-group input[type="text"]:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        input[type="file"] {
        display: none;            
}

.custom-file-upload {
   border: 1px solid #ccc;
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
  margin-bottom: 30px;
  
}

        /* Radio button styling */
        .radio-group {
            margin-top: 0.5rem;
        }

        .radio-option {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .radio-option input[type="radio"] {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 50%;
            margin-right: 0.5rem;
            position: relative;
            cursor: pointer;
        }

        .radio-option input[type="radio"]:checked {
            border-color: #4f46e5;
        }

        .radio-option input[type="radio"]:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            background-color: #4f46e5;
            border-radius: 50%;
        }

        .radio-option label {
            font-weight: normal;
            cursor: pointer;
        }

        button {
            background-color: #4f46e5;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 15px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #4338ca;
        }

        @media (max-width: 480px) {
            .cms-form {
                padding: 1.5rem;
            }
        }


        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 0.5rem;
        }



    </style>
</head>
<body>
    <form class="cms-form" action="testing-login-check.php" method="POST" enctype="multipart/form-data">
    <a  class="logo">
                <img src="assets/logo.svg" style="height: 20%; width: 20%; " alt="">
            </a>
    <h1>Welcome to IPS</h1>    
    <h3>Login</h3>
    <br><br>
        
        <div class="form-group">
            <label for="title">Email</label>
            <input 
                type="text" 
                id="email" 
                name="email" 
                placeholder=""
                required
            >
        </div>

        <div class="form-group">
            <label for="description">Password</label>
            <input 
                type="text" 
                id="password" 
                name="password" 
                placeholder=""
                required
            >
        </div>

        
<br><br>
        <button type="submit">Login</button>

        <br><br>
        <form action="">
        <button type="submit" id="request"  style="background-color : white;" ><a href="signup.php" style="color : green ;">Request Account</a></button>
    </form>
    
    </form>

</body>
</html>