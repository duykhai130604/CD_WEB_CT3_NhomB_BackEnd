<?php 

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Tại đây, bạn có thể định nghĩa tất cả các guard xác thực cho ứng dụng.
    | Mỗi guard đều có một user provider xác định cách lấy thông tin người dùng.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Tất cả các driver xác thực đều có một user provider. Cấu hình này xác định
    | cách người dùng sẽ được lấy ra từ cơ sở dữ liệu hoặc các nguồn lưu trữ khác.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Bạn có thể chỉ định nhiều cấu hình reset mật khẩu nếu có nhiều bảng người dùng
    | hoặc kiểu người dùng khác nhau trong ứng dụng.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Đây là số giây trước khi xác nhận mật khẩu hết hạn. Sau thời gian này, 
    | người dùng sẽ được yêu cầu nhập lại mật khẩu.
    |
    */

    'password_timeout' => 10800,

];
