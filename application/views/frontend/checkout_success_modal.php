<!-- Order Success Modal -->
<div id="orderSuccessModal" class="order-success-modal" style="display: none;">
    <div class="modal-overlay"></div>
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
                <div class="order-id-value" id="modal-order-id">#ORD-38</div>
            </div>

            <div class="success-message">
                <p>Your order has been received and is now being <strong>processed</strong>. We will notify you via email once your order is dispatched.</p>
            </div>

            <div class="order-details">
                <div class="detail-row">
                    <span class="detail-label">Order Date:</span>
                    <span class="detail-value" id="modal-order-date">13 May 2026, 23:04</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Amount:</span>
                    <span class="detail-value" id="modal-total-amount">&pound;28.07</span>
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
</div>

<style>
.order-success-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.order-success-modal .modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: -1;
}

.order-success-modal .success-modal {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    max-width: 500px;
    width: 90%;
    overflow: hidden;
    animation: slideIn 0.4s ease-out;
    z-index: 10000;
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

.order-success-modal .success-header {
    background: #3a1b76;
    padding: 40px 30px;
    text-align: center;
    color: #ffffff;
}

.order-success-modal .success-icon {
    font-size: 60px;
    margin-bottom: 15px;
    display: inline-block;
    animation: bounce 0.6s ease-out;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.order-success-modal .success-header h1 {
    font-size: 28px;
    margin-bottom: 8px;
    font-weight: 700;
}

.order-success-modal .success-header p {
    font-size: 14px;
    opacity: 0.95;
    margin-bottom: 5px;
}

.order-success-modal .success-body {
    padding: 40px 30px;
    text-align: center;
}

.order-success-modal .order-id {
    background: #F9F6F1;
    border: 2px solid #C9A646;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
}

.order-success-modal .order-id-label {
    font-size: 12px;
    color: #4A4A4A;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    margin-bottom: 5px;
}

.order-success-modal .order-id-value {
    font-size: 24px;
    color: #3a1b76;
    font-weight: 700;
    letter-spacing: 1px;
}

.order-success-modal .success-message {
    font-size: 15px;
    color: #4A4A4A;
    line-height: 1.6;
    margin-bottom: 30px;
}

.order-success-modal .success-message strong {
    color: #3a1b76;
}

.order-success-modal .order-details {
    background: #F9F6F1;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 30px;
    text-align: left;
}

.order-success-modal .detail-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #e8e8e8;
    font-size: 14px;
}

.order-success-modal .detail-row:last-child {
    border-bottom: none;
}

.order-success-modal .detail-label {
    color: #4A4A4A;
    font-weight: 600;
}

.order-success-modal .detail-value {
    color: #1E1E1E;
    font-weight: 500;
}

.order-success-modal .button-group {
    display: flex;
    gap: 12px;
    justify-content: center;
}

.order-success-modal .btn {
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

.order-success-modal .btn-home {
    background: #3a1b76;
    color: #ffffff;
    flex: 1;
}

.order-success-modal .btn-home:hover {
    background: #2a1456;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(58, 27, 118, 0.3);
}

.order-success-modal .btn-continue {
    background: #C9A646;
    color: #1E1E1E;
    flex: 1;
}

.order-success-modal .btn-continue:hover {
    background: #b89237;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(201, 166, 70, 0.3);
}

.order-success-modal .success-footer {
    background: #3a1b76;
    padding: 15px 30px;
    text-align: center;
    border-top: 1px solid #2a1456;
}

.order-success-modal .success-footer p {
    font-size: 12px;
    color: #C9A646;
    margin: 0;
}

@media (max-width: 480px) {
    .order-success-modal .button-group {
        flex-direction: column;
    }

    .order-success-modal .btn {
        width: 100%;
    }

    .order-success-modal .success-header h1 {
        font-size: 22px;
    }

    .order-success-modal .order-id-value {
        font-size: 20px;
    }

    .order-success-modal .success-body {
        padding: 30px 20px;
    }
}

.order-success-modal.show {
    display: flex;
}
</style>

<script>
function showOrderSuccessModal(orderId, totalAmount) {
    const modal = document.getElementById('orderSuccessModal');
    document.getElementById('modal-order-id').textContent = '#ORD-' + orderId;
    document.getElementById('modal-total-amount').textContent = '£' + parseFloat(totalAmount).toFixed(2);
    document.getElementById('modal-order-date').textContent = new Date().toLocaleDateString('en-GB', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}
</script>
