<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed Successfully - Marlota Ltd</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #3a1b76 0%, #5a3fa1 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .success-modal {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            max-width: 500px;
            width: 100%;
            overflow: hidden;
            animation: slideIn 0.4s ease-out;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .success-header {
            background: #3a1b76;
            padding: 40px 30px;
            text-align: center;
            color: #ffffff;
        }
        .success-icon {
            font-size: 60px;
            margin-bottom: 15px;
            animation: bounce 0.6s ease-out;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .success-header h1 {
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 700;
        }
        .success-header p {
            font-size: 14px;
            opacity: 0.95;
            margin-bottom: 5px;
        }
        .success-body {
            padding: 40px 30px;
            text-align: center;
        }
        .order-id {
            background: #F9F6F1;
            border: 2px solid #C9A646;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .order-id-label {
            font-size: 12px;
            color: #4A4A4A;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .order-id-value {
            font-size: 24px;
            color: #3a1b76;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .success-message {
            font-size: 15px;
            color: #4A4A4A;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .success-message strong {
            color: #3a1b76;
        }
        .order-details {
            background: #F9F6F1;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 30px;
            text-align: left;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e8e8e8;
            font-size: 14px;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #4A4A4A;
            font-weight: 600;
        }
        .detail-value {
            color: #1E1E1E;
            font-weight: 500;
        }
        .button-group {
            display: flex;
            gap: 12px;
            justify-content: center;
        }
        .btn {
            display: inline-block;
            padding: 12px 28px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn-home {
            background: #3a1b76;
            color: #ffffff;
            flex: 1;
        }
        .btn-home:hover {
            background: #2a1456;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(58, 27, 118, 0.3);
        }
        .btn-continue {
            background: #C9A646;
            color: #1E1E1E;
            flex: 1;
        }
        .btn-continue:hover {
            background: #b89237;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(201, 166, 70, 0.3);
        }
        .success-footer {
            background: #3a1b76;
            padding: 15px 30px;
            text-align: center;
            border-top: 1px solid #2a1456;
        }
        .success-footer p {
            font-size: 12px;
            color: #C9A646;
            margin: 0;
        }
        @media (max-width: 480px) {
            .button-group {
                flex-direction: column;
            }
            .btn {
                width: 100%;
            }
            .success-header h1 {
                font-size: 22px;
            }
            .order-id-value {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="success-modal">
        <!-- Header -->
        <div class="success-header">
            <div class="success-icon">✅</div>
            <h1>Order Placed Successfully!</h1>
            <p>Thank you for shopping with Marlota Ltd.</p>
        </div>

        <!-- Body -->
        <div class="success-body">
            <div class="order-id">
                <div class="order-id-label">Order Reference</div>
                <div class="order-id-value">#ORD-<?php echo htmlspecialchars($order_id); ?></div>
            </div>

            <div class="success-message">
                <p>Your order has been received and is now being <strong>processed</strong>. We will notify you via email once your order is dispatched.</p>
            </div>

            <div class="order-details">
                <div class="detail-row">
                    <span class="detail-label">Order Date:</span>
                    <span class="detail-value"><?php echo date('d M Y, H:i'); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Amount:</span>
                    <span class="detail-value">&pound;<?php echo number_format($total_amount, 2); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value" style="color: #28a745; font-weight: 700;">Processing</span>
                </div>
            </div>

            <div class="button-group">
                <a href="<?php echo base_url(''); ?>" class="btn btn-home">← Back to Home</a>
                <a href="<?php echo base_url('products'); ?>" class="btn btn-continue">Continue Shopping →</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="success-footer">
            <p>A confirmation email has been sent to your registered email address.</p>
        </div>
    </div>
</body>
</html>
