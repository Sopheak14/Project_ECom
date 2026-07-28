<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice {{ $order['id'] }} — BASELINE.shop</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #14161B; --surface: #1B1E24; --line: #2A2E37;
      --text: #E7E9EC; --text-dim: #8B93A1;
      --accent: #5EEAD4; --accent-warm: #FFB454;
    }
    * { box-sizing: border-box; }
    body {
      background: var(--bg); color: var(--text);
      font-family: 'Inter', sans-serif; margin: 0; padding: 48px 20px;
    }
    .invoice {
      max-width: 640px; margin: 0 auto; background: var(--surface);
      border: 1px solid var(--line); border-radius: 4px; padding: 40px;
    }
    .invoice-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; }
    .invoice-head h1 { font-family: 'Space Grotesk', sans-serif; font-size: 22px; margin: 0 0 4px; }
    .invoice-head .brand-dim { color: var(--text-dim); font-weight: 400; }
    .order-id { font-family: 'JetBrains Mono', monospace; color: var(--accent); font-size: 14px; }
    .invoice-meta { color: var(--text-dim); font-size: 13px; margin-top: 4px; }
    .divider { border: none; border-top: 1px dashed var(--line); margin: 24px 0; }
    .bill-to { font-size: 14px; line-height: 1.6; margin-bottom: 8px; }
    .bill-to .label { color: var(--text-dim); font-family: 'JetBrains Mono', monospace; font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; display: block; margin-bottom: 4px; }
    table { width: 100%; border-collapse: collapse; margin: 16px 0; font-size: 14px; }
    th { text-align: left; color: var(--text-dim); font-weight: 500; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; padding-bottom: 8px; border-bottom: 1px solid var(--line); }
    td { padding: 10px 0; border-bottom: 1px solid var(--line); }
    td.num, th.num { text-align: right; font-family: 'JetBrains Mono', monospace; }
    .totals { margin-top: 16px; margin-left: auto; width: 220px; font-family: 'JetBrains Mono', monospace; font-size: 14px; }
    .totals-row { display: flex; justify-content: space-between; padding: 4px 0; color: var(--text-dim); }
    .totals-row.grand { color: var(--accent-warm); font-size: 18px; font-weight: 600; border-top: 1px solid var(--line); margin-top: 6px; padding-top: 10px; }
    .status { display: inline-block; margin-top: 24px; padding: 6px 12px; border: 1px solid var(--accent); color: var(--accent); border-radius: 3px; font-family: 'JetBrains Mono', monospace; font-size: 12px; letter-spacing: 0.05em; }
    .foot-note { margin-top: 28px; color: var(--text-dim); font-size: 12px; text-align: center; }
    @media print { body { background: white; } }
  </style>
</head>
<body>
  <div class="invoice">
    <div class="invoice-head">
      <div>
        <h1>BASELINE<span class="brand-dim">.shop</span></h1>
        <div class="invoice-meta">Computer parts &amp; machines</div>
      </div>
      <div style="text-align: right;">
        <div class="order-id">{{ $order['id'] }}</div>
        <div class="invoice-meta">{{ $order['date'] }}</div>
      </div>
    </div>

    <hr class="divider">

    <div class="bill-to">
      <span class="label">Bill to</span>
      {{ $order['customer']['name'] }}<br>
      {{ $order['customer']['address'] }}, {{ $order['customer']['city'] }}<br>
      {{ $order['customer']['email'] }}<br>
      Payment: {{ $order['customer']['payment'] }}
    </div>

    <table>
      <thead>
        <tr>
          <th>Item</th>
          <th class="num">Qty</th>
          <th class="num">Price</th>
          <th class="num">Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order['items'] as $item)
          <tr>
            <td>{{ $item['product']->name }} <span style="color: var(--text-dim); font-family: 'JetBrains Mono', monospace; font-size: 11px;">&nbsp;{{ $item['product']->sku }}</span></td>
            <td class="num">{{ $item['qty'] }}</td>
            <td class="num">${{ number_format($item['product']->price, 2) }}</td>
            <td class="num">${{ number_format($item['lineTotal'], 2) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="totals">
      <div class="totals-row"><span>Subtotal</span><span>${{ number_format($order['subtotal'], 2) }}</span></div>
      <div class="totals-row"><span>Tax (8%)</span><span>${{ number_format($order['tax'], 2) }}</span></div>
      <div class="totals-row grand"><span>Total</span><span>${{ number_format($order['total'], 2) }}</span></div>
    </div>

    <span class="status">&#10003; ORDER CONFIRMED</span>

    <p class="foot-note">This invoice was generated server-side and saved as a standalone HTML file at checkout.</p>
  </div>
</body>
</html>
