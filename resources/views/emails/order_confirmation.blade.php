<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận đơn hàng</title>
</head>
<body>
    <h2>Chào {{ $user->name }},</h2>
    <p>Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi. Đây là thông tin chi tiết đơn hàng của bạn:</p>
    <p><strong>Mã đơn hàng:</strong> {{ $order->id }}</p>
    <p><strong>Số tiền:</strong> {{ number_format($totalAmount, 0, ',', '.') }} VND</p>
    <p><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}</p>
    <p>Chúng tôi sẽ giao hàng cho bạn trong thời gian sớm nhất có thể.</p>
    <p>Trân trọng,</p>
    <p>Đội ngũ hỗ trợ</p>
</body>
</html>
