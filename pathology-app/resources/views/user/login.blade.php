<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label for="loginname">อีเมล:</label>
        <input type="text" name="loginname" id="loginname" value="{{ old('loginname') }}" required autofocus>
    </div>

    <div>
        <label for="passweb">รหัสผ่าน:</label>
        <input type="text" name="passweb" id="passweb" required>
    </div>

    <div>
        <button type="submit">เข้าสู่ระบบ</button>
    </div>
</form>
