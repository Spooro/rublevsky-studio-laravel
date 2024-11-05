<x-mail::message>
<div class="email-content">
<h1 style="color: #000000; margin-bottom: 15px;">New Order Placed</h1>

<p style="color: #000000; margin-bottom: 20px;">A new order has been placed on the Rublevsky Store.</p>

<div style="background-color: #f3f4f6; border-radius: 8px; padding: 15px; margin-bottom: 20px;">
<table class="order-details" width="100%" cellpadding="0" cellspacing="0">
<tr>
<th align="left" style="color: #000000; padding-bottom: 10px;">Order Details</th>
<th align="right"></th>
</tr>
<tr class="item-row">
<td align="left" style="color: #000000; padding: 5px 0;">Order ID:</td>
<td align="right" style="color: #000000; padding: 5px 0;">{{ $order->id }}</td>
</tr>
<tr class="item-row">
<td align="left" style="color: #000000; padding: 5px 0;">Customer:</td>
<td align="right" style="color: #000000; padding: 5px 0;">
{{ $order->address->first_name }} {{ $order->address->last_name }}
</td>
</tr>
<tr class="item-row">
<td align="left" style="color: #000000; padding: 5px 0;">Email:</td>
<td align="right" style="color: #000000; padding: 5px 0;">{{ $order->address->email }}</td>
</tr>
<tr class="item-row">
<td align="left" style="color: #000000; padding: 5px 0;">Phone:</td>
<td align="right" style="color: #000000; padding: 5px 0;">{{ $order->address->phone }}</td>
</tr>
<tr class="item-row">
<td align="left" style="color: #000000; padding: 5px 0;">Address:</td>
<td align="right" style="color: #000000; padding: 5px 0;">
{{ $order->address->street_address }}, {{ $order->address->city }},
{{ $order->address->state }}, {{ $order->address->zip_code }},
{{ $order->address->country }}
</td>
</tr>
<tr class="item-row">
<td align="left" style="color: #000000; padding: 5px 0;">Payment Method:</td>
<td align="right" style="color: #000000; padding: 5px 0;">{{ ucfirst($order->payment_method) }}</td>
</tr>
<tr class="item-row">
<td align="left" style="color: #000000; padding: 5px 0;">Status:</td>
<td align="right" style="color: #000000; padding: 5px 0;">{{ ucfirst($order->status) }}</td>
</tr>
</table>
</div>

<h2 style="color: #000000; margin-top: 30px; margin-bottom: 15px;">Ordered Items:</h2>

<table class="order-details" width="100%" cellpadding="0" cellspacing="0" style="margin-top: 15px; margin-bottom: 30px;">
<tr>
<th align="left" style="color: #718096; font-weight: normal; padding-bottom: 8px;">Item</th>
<th align="center" style="color: #718096; font-weight: normal; padding-bottom: 8px;">Quantity</th>
<th align="right" style="color: #718096; font-weight: normal; padding-bottom: 8px;">Price</th>
</tr>
@foreach ($order->items as $item)
<tr class="item-row">
<td align="left" style="color: #000000; padding: 8px 0;">
<span class="item-name">{{ $item->product->name }}</span>
</td>
<td align="center" style="color: #000000; padding: 8px 0;">{{ $item->quantity }}</td>
<td align="right" style="color: #000000; padding: 8px 0;">
{{ Number::currency($item->unit_amount ?? 0, 'CAD') }}</td>
</tr>
@endforeach
<tr class="total-row">
<td colspan="2" align="right" style="color: #000000; padding: 12px 0;">Total:</td>
<td align="right" style="color: #000000; padding: 12px 0;">
<strong>{{ Number::currency($order->grand_total ?? 0, 'CAD') }}</strong></td>
</tr>
</table>

<x-mail::button :url="$url" style="margin-top: 20px;">
View Order Details
</x-mail::button>

<p style="color: #000000; margin-top: 20px;">
Thanks,<br>
{{ config('app.name') }}
</p>
</div>
</x-mail::message>
