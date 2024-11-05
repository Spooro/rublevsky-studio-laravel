<x-mail::message>
<div class="email-content">
<h1 style="color: #000000; margin-bottom: 15px;">Order placed successfully!</h1>
<p style="color: #000000; margin-bottom: 30px;"> Thank you for your order, {{ $order->address->first_name }}! Your order number is {{ $order->id }}.</p>
<p style="color: #000000; margin-bottom: 30px;">You will be contacted shortly regarding delivery and payment.</p>
<table class="order-details" width="100%" cellpadding="0" cellspacing="0" style="margin-top: 40px; margin-bottom: 40px;">
<tr>
<th align="left" style="color: #718096; font-weight: normal; padding-bottom: 8px;">Item</th>
<th align="center" style="color: #718096; font-weight: normal; padding-bottom: 8px;">Quantity</th>
<th align="right" style="color: #718096; font-weight: normal; padding-bottom: 8px;">Price</th>
<th align="right" style="color: #718096; font-weight: normal; padding-bottom: 8px;">Total</th>
</tr>
@foreach ($order->items as $item)
<tr class="item-row">
<td align="left" style="color: #000000; padding: 8px 0;">
<span class="item-name">{{ $item->product->name }}</span>
</td>
<td align="center" style="color: #000000; padding: 8px 0;">{{ $item->quantity }}</td>
<td align="right" style="color: #000000; padding: 8px 0;"> {{ Number::currency($item->unit_amount ?? 0, 'CAD') }}</td>
<td align="right" style="color: #000000; padding: 8px 0;">
{{ Number::currency($item->total_amount ?? 0, 'CAD') }}</td>
</tr>
@endforeach
<tr class="total-row">
<td colspan="3" align="right" style="color: #000000; padding: 12px 0;">Total:</td>
<td align="right" style="color: #000000; padding: 12px 0;">
<strong>{{ Number::currency($order->grand_total ?? 0, 'CAD') }}</strong></td>
</tr>
</table>
<x-mail::button :url="$url" style="margin-top: 30px;">
View Order
</x-mail::button>
<p style="color: #000000; margin-top: 30px;">
Thanks,<br>
Rublevsky Store
</p>
</div>
</x-mail::message>
