@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="https://motocare.co.in/assets/img/logo/logo.png" style="width: 180px;"  class="logo" alt="Laravel Logo">
@endif
</a>
</td>
</tr>
