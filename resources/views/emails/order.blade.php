<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Military Order - {{ $data['subject'] }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .section {
            margin-bottom: 25px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
        }
        .section h3 {
            margin: 0 0 10px 0;
            color: #1e40af;
            font-size: 18px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 15px 0;
        }
        .info-item {
            background: white;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #e5e7eb;
        }
        .info-label {
            font-weight: bold;
            color: #374151;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-value {
            color: #1f2937;
            margin-top: 5px;
        }
        .financial-transfer {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }
        .financial-transfer h3 {
            margin: 0 0 10px 0;
            font-size: 20px;
        }
        .amount {
            font-size: 36px;
            font-weight: bold;
            margin: 10px 0;
        }
        .weapons-list {
            background: #fef3c7;
            border: 2px solid #f59e0b;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
        }
        .weapons-list h4 {
            margin: 0 0 15px 0;
            color: #92400e;
            font-size: 16px;
        }
        .weapons-content {
            white-space: pre-line;
            color: #451a03;
            background: white;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #fbbf24;
        }
        .message-body {
            background: #ede9fe;
            border: 2px solid #8b5cf6;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
        }
        .message-body h4 {
            margin: 0 0 15px 0;
            color: #5b21b6;
            font-size: 16px;
        }
        .message-content {
            white-space: pre-line;
            color: #3730a3;
            background: white;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #a78bfa;
        }
        .footer {
            background: #374151;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .classification {
            background: #dc2626;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            letter-spacing: 1px;
        }
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="classification">
            🔒 MILITARY COMMUNICATION - WWII OPERATIONS
        </div>
        
        <div class="header">
            <h1>⚔️ {{ $data['subject'] }}</h1>
            <p>Military Order & Financial Transfer</p>
        </div>

        <div class="content">
            <!-- Sender Information -->
            <div class="section">
                <h3>📤 From: Command Authority</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Commanding Officer</div>
                        <div class="info-value">{{ $data['sender_name'] }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Rank/Position</div>
                        <div class="info-value">{{ $data['sender_role'] }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Nation</div>
                        <div class="info-value">{{ $data['sender_country'] }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Order Date</div>
                        <div class="info-value">{{ $data['order_date'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Recipient Information -->
            <div class="section">
                <h3>📥 To: Field Officer</h3>
                <div class="info-item">
                    <div class="info-label">Recipient Officer</div>
                    <div class="info-value">{{ $data['recipient_name'] }}</div>
                </div>
            </div>

            <!-- Financial Transfer -->
            <div class="financial-transfer">
                <h3>💰 FINANCIAL AUTHORIZATION</h3>
                <div class="amount">${{ number_format($data['cash_amount'], 2) }}</div>
                <p><strong>Purpose:</strong> {{ $data['transfer_purpose'] }}</p>
                <p style="font-size: 14px; margin: 0; opacity: 0.9;">
                    Funds have been transferred to your account for immediate use
                </p>
            </div>

            <!-- Weapons Requisition -->
            <div class="weapons-list">
                <h4>⚔️ WEAPONS & EQUIPMENT REQUISITION</h4>
                <div class="weapons-content">{{ $data['weapons_list'] }}</div>
            </div>

            <!-- Additional Instructions -->
            @if($data['message_body'])
            <div class="message-body">
                <h4>📋 ADDITIONAL ORDERS & INSTRUCTIONS</h4>
                <div class="message-content">{{ $data['message_body'] }}</div>
            </div>
            @endif

            <!-- Security Notice -->
            <div class="section">
                <h3>🔐 Security Notice</h3>
                <p style="margin: 0; color: #dc2626; font-weight: bold;">
                    This communication contains sensitive military information. Handle according to operational security protocols.
                </p>
                <ul style="margin: 10px 0 0 20px; color: #374151;">
                    <li>Confirm receipt within 24 hours</li>
                    <li>Execute orders within specified timeframe</li>
                    <li>Report status updates as required</li>
                    <li>Maintain operational security at all times</li>
                </ul>
            </div>
        </div>

        <div class="footer">
            <p><strong>WWII Military Operations Command</strong></p>
            <p>This is an automated military communication system</p>
            <p style="font-size: 12px; margin-top: 10px; opacity: 0.8;">
                Generated: {{ now()->format('Y-m-d H:i:s') }} UTC
            </p>
        </div>
    </div>
</body>
</html>
