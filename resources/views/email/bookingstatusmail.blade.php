<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trek Booking Status</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 30px;
            font-weight: 500;
        }
        .status-box {
            padding: 25px;
            border-radius: 8px;
            margin: 25px 0;
            text-align: center;
            font-size: 16px;
        }
        .status-box.accepted {
            background-color: #d4edda;
            border: 2px solid #28a745;
            color: #155724;
        }
        .status-box.rejected {
            background-color: #f8d7da;
            border: 2px solid #dc3545;
            color: #721c24;
        }
        .status-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .status-title {
            font-size: 24px;
            font-weight: bold;
            margin: 15px 0;
        }
        .trek-name {
            font-size: 20px;
            color: #667eea;
            font-weight: 600;
            word-break: break-word;
        }
        .details-section {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin: 25px 0;
            border-left: 4px solid #667eea;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #555;
        }
        .detail-value {
            color: #333;
            text-align: right;
        }
        .next-steps {
            background-color: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 20px;
            border-radius: 6px;
            margin: 25px 0;
        }
        .next-steps h3 {
            color: #2196F3;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .next-steps p {
            color: #555;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .thank-you {
            text-align: center;
            padding: 20px 0;
            margin: 30px 0 20px;
            font-size: 15px;
            color: #666;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 25px 30px;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            font-size: 13px;
            color: #888;
        }
        .social-links {
            margin-top: 15px;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🏔️ Trek Booking System</h1>
            <p>Your Adventure Awaits!</p>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="greeting">
                Hello <strong>{{ $booking->name ?? 'Valued Customer' }}</strong>,
            </div>

            @php
                $trekName = ($booking->trek && $booking->trek->trekname) ? $booking->trek->trekname : 'your trek';
                $statusIcon = $status == 'accepted' ? '✅' : '❌';
                $statusText = $status == 'accepted' ? 'ACCEPTED' : 'REJECTED';
                $statusClass = $status == 'accepted' ? 'accepted' : 'rejected';
            @endphp

            <!-- Status Box -->
            <div class="status-box {{ $statusClass }}">
                <div class="status-icon">{{ $statusIcon }}</div>
                <div class="status-title">{{ $statusText }}</div>
                <div>Your booking for <span class="trek-name">{{ $trekName }}</span> has been <strong>{{ $statusText }}</strong>.</div>
            </div>

            <!-- Booking Details -->
            <div class="details-section">
                <div class="detail-row">
                    <span class="detail-label">📅 Booking Date:</span>
                    <span class="detail-value">{{ \Illuminate\Support\Carbon::parse($booking->booking_date)->format('M d, Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">👥 Number of Travelers:</span>
                    <span class="detail-value">{{ $booking->number_of_people }} {{ $booking->number_of_people > 1 ? 'persons' : 'person' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">📱 Contact Number:</span>
                    <span class="detail-value">{{ $booking->phone }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">📧 Email:</span>
                    <span class="detail-value">{{ $booking->email }}</span>
                </div>
                @if($booking->additional_infromation)
                <div class="detail-row">
                    <span class="detail-label">📝 Additional Info:</span>
                    <span class="detail-value">{{ $booking->additional_infromation }}</span>
                </div>
                @endif
            </div>

            <!-- Next Steps -->
            @if($status == 'accepted')
            <div class="next-steps">
                <h3>🎯 What's Next?</h3>
                <p>✓ Your booking has been confirmed!</p>
                <p>✓ Our team will contact you shortly with further details and payment information.</p>
                <p>✓ Prepare for an unforgettable trekking experience!</p>
            </div>
            @else
            <div class="next-steps" style="background-color: #ffe7e7; border-left-color: #dc3545;">
                <h3 style="color: #dc3545;">❌ Booking Rejected</h3>
                <p>Unfortunately, your booking could not be accepted at this time.</p>
                <p>Please contact our support team for more information or to explore other available dates.</p>
            </div>
            @endif

            <!-- Thank You -->
            <div class="thank-you">
                Thank you for choosing our Trek Booking System. We look forward to making your trek memorable!
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Trek Booking System</strong></p>
            <p>Making your adventure dreams come true</p>
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
            </div>
            <p style="margin-top: 15px; font-size: 12px;">© 2026 Trek Booking. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
