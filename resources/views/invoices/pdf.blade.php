<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $invoice->invoice_number }}</title>
    <style>
        @page { size: A4; margin: 20mm; }
        body { margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; color: #222; background: #fff; }
        .page { min-height: 277mm; padding: 0; box-sizing: border-box; }
        .header, .section, .totals { width: 100%; margin-bottom: 24px; }
        .header-wrap { overflow: hidden; }
        .brand-block { float: left; width: 58%; }
        .invoice-badge { float: right; width: 40%; padding: 16px; border: 1px solid #ddd; border-radius: 12px; text-align: right; box-sizing: border-box; }
        .brand-title { margin: 0 0 8px 0; font-size: 24px; letter-spacing: 0.03em; }
        .brand-subtitle { margin: 0; font-size: 12px; color: #555; line-height: 1.6; }
        .invoice-label { margin: 0; font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 0.12em; }
        .invoice-value { margin: 8px 0 0; font-size: 18px; font-weight: bold; color: #111; }
        .clearfix::after { content: ""; display: table; clear: both; }
        .grid-row { width: 100%; overflow: hidden; }
        .grid-item { float: left; width: 48%; margin-right: 4%; box-sizing: border-box; }
        .grid-item:last-child { margin-right: 0; }
        .card { border: 1px solid #ddd; border-radius: 16px; padding: 18px; background: #fafafa; box-sizing: border-box; }
        .card h3 { margin: 0 0 12px 0; font-size: 14px; text-transform: uppercase; letter-spacing: 0.08em; color: #666; }
        .card p { margin: 6px 0; font-size: 12px; line-height: 1.6; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 18px; }
        th, td { padding: 12px 10px; border-bottom: 1px solid #e4e4e4; font-size: 12px; text-align: left; vertical-align: top; }
        th { background: #f5f5f5; color: #555; font-weight: 700; }
        tr:nth-child(even) td { background: #fbfbfb; }
        .text-right { text-align: right; }
        .small { font-size: 11px; color: #666; }
        .totals { max-width: 320px; margin-left: auto; }
        .totals-row { overflow: hidden; margin-bottom: 10px; font-size: 12px; }
        .totals-row span { display: inline-block; width: 50%; }
        .totals-row.total { font-size: 14px; font-weight: 700; margin-top: 16px; }
    </style>
</head>
<body>
<div class="page">
    <section class="header">
        <div class="header-wrap clearfix">
            <div class="brand-block">
                <p class="brand-title">Optical CRM</p>
                <p class="brand-subtitle">Boutique d'optique<br>Casablanca, Maroc<br>info@opticalcrm.com</p>
            </div>
            <div class="invoice-badge">
                <p class="invoice-label">Facture</p>
                <p class="invoice-value">{{ $invoice->invoice_number }}</p>
                <p class="small" style="margin-top: 8px;">Date d'émission : {{ optional($invoice->issue_date)->format('d/m/Y') }}</p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="grid-row clearfix">
            <div class="grid-item">
                <div class="card">
                    <h3>Facturé à</h3>
                    <p>{{ optional($invoice->order->customer)->first_name }} {{ optional($invoice->order->customer)->last_name }}</p>
                    <p>{{ optional($invoice->order->customer)->email }}</p>
                    <p>{{ optional($invoice->order->customer)->phone }}</p>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <h3>Commande</h3>
                    <p>{{ $invoice->order->order_number }}</p>
                    <p class="small">Date commande : {{ optional($invoice->order->order_date)->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th class="text-right">Sous-total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->order->items as $item)
                    <tr>
                        <td>{{ optional($item->product)->name ?? 'Produit supprimé' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->unit_price, 2) }} DH</td>
                        <td class="text-right">{{ number_format($item->subtotal, 2) }} DH</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section class="totals">
        <div class="totals-row"><span>Total HT</span><span class="text-right">{{ number_format($invoice->total_ht, 2) }} DH</span></div>
        <div class="totals-row"><span>TVA ({{ number_format($invoice->tax_rate, 2) }}%)</span><span class="text-right">{{ number_format($invoice->total_ttc - $invoice->total_ht, 2) }} DH</span></div>
        <div class="totals-row total"><span>Total TTC</span><span class="text-right">{{ number_format($invoice->total_ttc, 2) }} DH</span></div>
    </section>
</div>
</body>
</html>
