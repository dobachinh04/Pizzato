<!DOCTYPE html>
<html>
<head>
    <title>Đăng Ký</title>
</head>
<body>
    <h1>Đăng Ký</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('client.register') }}">
        @csrf
        <div>
            <label for="name">Tên:</label>
            <input type="text" name="name" id="name" >
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" >
        </div>
        <div>
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" >
        </div>
        <div>
            <label for="password_confirmation">Xác nhận mật khẩu:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" >
        </div>
        <div>
            <label for="role_id">Vai trò:</label>
            <input type="hidden" name="role_id" id="role_id" value="1"> <!-- Giả sử ID của vai trò "User" là 1 -->
            <span>User</span> <!-- Hiển thị vai trò "User" -->
        </div>
        
        <button type="submit">Đăng Ký</button>
    </form>

    <p>Đã có tài khoản? <a href="{{ route('client.login') }}">Đăng nhập</a></p>
</body>
</html>
