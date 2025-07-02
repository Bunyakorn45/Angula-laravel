<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .register-container { width: 400px; margin: 60px auto; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px #ccc; }
        h2 { text-align: center; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: .5rem; }
        input[type="text"], input[type="password"], input[type="number"] { width: 100%; padding: .5rem; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: .7rem; background: #28a745; color: #fff; border: none; border-radius: 4px; font-size: 1rem; }
        .error { color: red; text-align: center; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>สมัครสมาชิก</h2>
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ url('/register_post') }}">
            @csrf
            <div class="form-group">
                <label for="Username">ชื่อผู้ใช้</label>
                <input type="text" id="Username" name="Username" required value="{{ old('Username') }}">
            </div>
            <div class="form-group">
                <label for="Password">รหัสผ่าน</label>
                <input type="password" id="Password" name="Password" required>
            </div>
            <div class="form-group">
                <label for="Employee_Id">รหัสพนักงาน</label>
                <input type="text" id="Employee_Id" name="Employee_Id" required value="{{ old('Employee_Id') }}">
            </div>
            <div class="form-group">
                <label for="Hospital_Id">รหัสโรงพยาบาล</label>
                <input type="text" id="Hospital_Id" name="Hospital_Id" required value="{{ old('Hospital_Id') }}">
            </div>
            <div class="form-group">
                <label for="Permission_Id">สิทธิ์ผู้ใช้</label>
                <input type="text" id="Permission_Id" name="Permission_Id" required value="{{ old('Permission_Id') }}">
            </div>
            <button type="submit">สมัครสมาชิก</button>
        </form>
    </div>
</body>
</html>