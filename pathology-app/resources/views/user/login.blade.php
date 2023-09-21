<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label for="email">อีเมล:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div>
        <label for="password">รหัสผ่าน:</label>
        <input type="password" name="password" id="password" required>
    </div>

    <div>
        <button type="submit">เข้าสู่ระบบ</button>
    </div>
</form>
