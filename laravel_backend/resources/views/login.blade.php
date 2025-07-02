<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
    }

    .login-container {
        width: 350px;
        margin: 80px auto;
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px #ccc;
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    label {
        display: block;
        margin-bottom: .5rem;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: .5rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        width: 100%;
        padding: .7rem;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
    }

    .error {
        color: red;
        text-align: center;
        margin-bottom: 1rem;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>เข้าสู่ระบบ</h2>
        @if(session('error'))
        <div class="error">{{ session('error') }}</div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ url('/login_post') }}">
            @csrf
            <div class="form-group">
                <label for="Username">ชื่อผู้ใช้</label>
                <input type="text" id="Username" name="Username" required autofocus>
            </div>
            <div class="form-group">
                <label for="Password">รหัสผ่าน</label>
                <input type="password" id="Password" name="Password" required>
            </div>
            <button type="submit">เข้าสู่ระบบ</button>
        </form>
    </div>
</body>

</html>