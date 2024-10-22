<x-mail::message>
<div class="email-content">
<h1 style="color: #000000; margin-bottom: 15px;">New Inquiry Received</h1>

<p style="color: #000000; margin-bottom: 30px;">You have received a new inquiry from the contact form.</p>

<table class="inquiry-details" width="100%" cellpadding="0" cellspacing="0" style="margin-top: 40px; margin-bottom: 40px;">
<tr class="item-row">
<td align="left" style="color: #718096; padding: 8px 0;">Name</td>
<td align="left" style="color: #000000; padding: 8px 0;">{{ $inquiry->name }}</td>
</tr>
<tr class="item-row">
<td align="left" style="color: #718096; padding: 8px 0;">Email</td>
<td align="left" style="color: #000000; padding: 8px 0;">{{ $inquiry->email }}</td>
</tr>
<tr class="item-row">
<td align="left" style="color: #718096; padding: 8px 0;">Company</td>
<td align="left" style="color: #000000; padding: 8px 0;">{{ $inquiry->company_name ?? 'N/A' }}</td>
</tr>
<tr class="item-row">
<td align="left" style="color: #718096; padding: 8px 0;">Role</td>
<td align="left" style="color: #000000; padding: 8px 0;">{{ $inquiry->role ?? 'N/A' }}</td>
</tr>
<tr class="item-row">
<td align="left" style="color: #718096; padding: 8px 0;">Budget</td>
<td align="left" style="color: #000000; padding: 8px 0;">
{{ Number::currency($inquiry->budget ?? 0, 'CAD') }}</td>
</tr>
</table>

<h2 style="color: #000000; margin-top: 30px; margin-bottom: 15px;">Message:</h2>
<p style="color: #000000; margin-bottom: 30px;">{{ $inquiry->message }}</p>

<x-mail::button :url="config('app.url') . '/admin/inquiries/' . $inquiry->id" style="margin-top: 30px;">
View Inquiry in Admin Panel
</x-mail::button>
</div>
</x-mail::message>
