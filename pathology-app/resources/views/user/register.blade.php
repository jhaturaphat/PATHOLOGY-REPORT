<form method="POST" action="{{ route('register') }}">
    @csrf

    <div>
        <label for="name">ชื่อ:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
    </div>

    <div>
        <label for="email">อีเมล:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label for="password">รหัสผ่าน:</label>
        <input type="password" name="password" id="password" required>
    </div>

    <div>
        <label for="password_confirmation">ยืนยันรหัสผ่าน:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>

    <div>
        <button type="submit">ลงทะเบียน</button>
    </div>
</form>
