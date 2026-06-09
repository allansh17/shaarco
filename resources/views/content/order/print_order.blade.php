<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} — Print</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #1a1a1a;
            margin: 0;
            padding: 24px;
            background: #f4f6f8;
            font-size: 13px;
            line-height: 1.45;
        }
        .sheet {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 28px 32px;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,.08);
        }
        .toolbar {
            max-width: 900px;
            margin: 0 auto 16px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .toolbar button, .toolbar a {
            border: none;
            border-radius: 6px;
            padding: 10px 18px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-print { background: #3887CD; color: #fff; }
        .btn-close { background: #e9ecef; color: #333; }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            padding-bottom: 18px;
            border-bottom: 2px solid #3887CD;
            margin-bottom: 20px;
        }
        .brand img {
            width: 72px;
            height: 72px;
            object-fit: contain;
            display: block;
        }
        .order-meta { text-align: left; }
        .order-meta h2 { margin: 0 0 6px; font-size: 20px; }
        .order-meta .badge {
            display: inline-block;
            background: #e8f4ff;
            color: #3887CD;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .order-meta p { margin: 4px 0 0; color: #555; }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 22px;
        }
        .box {
            border: 1px solid #dde3ea;
            border-radius: 8px;
            padding: 14px 16px;
            background: #fafbfc;
        }
        .box h3 {
            margin: 0 0 10px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #3887CD;
        }
        .box p { margin: 0 0 4px; }
        .box address { font-style: normal; color: #444; }
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.items th {
            background: #3887CD;
            color: #fff;
            padding: 10px 8px;
            font-size: 12px;
            text-align: right;
        }
        table.items td {
            border-bottom: 1px solid #e8edf2;
            padding: 10px 8px;
            vertical-align: middle;
        }
        table.items tr:nth-child(even) td { background: #f8fafc; }
        table.items .thumb {
            width: 48px;
            height: 48px;
            object-fit: contain;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            background: #fff;
        }
        table.items .name { font-weight: bold; }
        table.items .muted { color: #777; font-size: 11px; }
        .text-left { text-align: left; }
        .text-center { text-align: center; }
        .summary {
            margin-right: auto;
            width: 320px;
            border: 1px solid #dde3ea;
            border-radius: 8px;
            overflow: hidden;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 14px;
            border-bottom: 1px solid #e8edf2;
        }
        .summary-row.total {
            background: #3887CD;
            color: #fff;
            font-weight: bold;
            font-size: 15px;
            border-bottom: none;
        }
        .message-box {
            margin-bottom: 20px;
            padding: 12px 14px;
            border-right: 4px solid #3887CD;
            background: #f0f7ff;
            border-radius: 4px;
        }
        .message-box h3 { margin: 0 0 6px; font-size: 13px; color: #3887CD; }
        @media print {
            body { background: #fff; padding: 0; }
            .toolbar { display: none !important; }
            .sheet { box-shadow: none; border-radius: 0; padding: 0; max-width: 100%; }
            @page { margin: 12mm; }
        }
    </style>
</head>
<body>
    <div class="toolbar no-print">
        <button type="button" class="btn-print" onclick="window.print()">طباعة / Print</button>
        <a href="javascript:window.close()" class="btn-close">إغلاق / Close</a>
    </div>

    <div class="sheet">
        <div class="header">
            <div class="brand">
                <img src="{{ asset('stc_css/images/stc-order-logo.png') }}" alt="STC Shaar Co.">
            </div>
            <div class="order-meta">
                <h2>طلب #{{ $order->id }}</h2>
                <span class="badge">{{ $order_status_label }}</span>
                <p>{{ \Carbon\Carbon::parse($order->created_at)->timezone(config('app.timezone'))->format('j M Y, g:i a') }}</p>
                <p>نوع العميل: {{ ucfirst($order->user_type ?? 'normal') }}</p>
            </div>
        </div>

        <div class="grid-2">
            <div class="box">
                <h3>بيانات العميل</h3>
                <p><strong>{{ ucfirst($order->first_name) }} {{ ucfirst($order->last_name) }}</strong></p>
                <p>{{ $order->email }}</p>
                <p>{{ $order->phone }}</p>
                <p class="muted">معرّف العميل: {{ $order->user_id }}</p>
            </div>
            <div class="box">
                <h3>عنوان الشحن</h3>
                @if($shipping_address)
                    <p><strong>{{ $shipping_address->full_name }}</strong></p>
                    <address>
                        {{ $shipping_address->address }},
                        {{ $shipping_address->city }},
                        {{ $shipping_address->state }}
                        {{ $shipping_address->pin_code }}
                    </address>
                    @if(!empty($shipping_address->mobile_number))
                        <p>{{ $shipping_address->mobile_number }}</p>
                    @endif
                @else
                    <p>— غير متوفر —</p>
                @endif
            </div>
        </div>

        @if($order->message)
            <div class="message-box">
                <h3>رسالة الطلب</h3>
                <p>{{ $order->message }}</p>
            </div>
        @endif

        <table class="items">
            <thead>
                <tr>
                    <th class="text-center" style="width:36px">#</th>
                    <th class="text-center" style="width:56px">صورة</th>
                    <th>المنتج</th>
                    <th style="width:80px">الكمية</th>
                    <th style="width:90px">السعر</th>
                    <th class="text-left" style="width:100px">المجموع</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product_order as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">
                            @if(!empty($item->product_image))
                                <img class="thumb" src="{{ asset('uploads/product/product_image/' . $item->product_image) }}" alt="">
                            @endif
                        </td>
                        <td>
                            <div class="name">{{ $item->name }}</div>
                            <div class="muted">
                                SKU: {{ $item->sku ?? '—' }}
                                @if(!empty($item->code)) · كود: {{ $item->code }}@endif
                                @if(!empty($item->brand_name)) · {{ $item->brand_name }}@endif
                            </div>
                        </td>
                        <td class="text-center">{{ $item->qty }}</td>
                        <td>₪ {{ number_format($item->unit_price ?? 0, 2) }}</td>
                        <td class="text-left"><strong>₪ {{ number_format($item->line_total ?? 0, 2) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <div class="summary-row">
                <span>عدد القطع</span>
                <span>{{ $order_item_count ?? 0 }}</span>
            </div>
            <div class="summary-row">
                <span>المجموع الفرعي</span>
                <span>₪ {{ number_format($order_subtotal ?? 0, 2) }}</span>
            </div>
            <div class="summary-row">
                <span>الشحن</span>
                <span>مجاني</span>
            </div>
            <div class="summary-row total">
                <span>الإجمالي</span>
                <span>₪ {{ number_format($order_subtotal ?? 0, 2) }}</span>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function () {
            setTimeout(function () { window.print(); }, 400);
        });
    </script>
</body>
</html>
