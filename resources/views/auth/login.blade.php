<!DOCTYPE html>
<html>
<head>
    <title>Đăng Nhập</title>
</head>
<body>
    <h1>Đăng Nhập</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('client.login') }}">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" >
        </div>
        <div>
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" >
        </div>
        <button type="submit">Đăng Nhập</button>
    </form>

    <p>Quên mật khẩu? <a href="{{ route('password.request') }}">Đặt lại mật khẩu</a></p>
    <p>Chưa có tài khoản? <a href="{{ route('client.register') }}">Đăng ký</a></p>
</body>
</html>
