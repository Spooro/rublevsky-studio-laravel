@props([
'url',
'color' => 'primary',
'align' => 'center',
])

<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<a href="{{ $url }}" class="button button-{{ $color }}" target="_blank" rel="noopener">{{ $slot }}</a>
</td>
</tr>
</table>
