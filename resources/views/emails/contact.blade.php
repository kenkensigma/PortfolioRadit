<!DOCTYPE html>
<html>
<body style="font-family:sans-serif;padding:32px;background:#f9f9f9">
    <div style="max-width:560px;margin:0 auto;background:#fff;padding:32px;border:1px solid #eee">
        <h2 style="margin:0 0 24px">New Portfolio Message</h2>
        <p><strong>From:</strong> {{ $senderName }}</p>
        <p><strong>Email:</strong> <a href="mailto:{{ $senderEmail }}">{{ $senderEmail }}</a></p>
        <hr style="margin:24px 0;border:none;border-top:1px solid #eee">
        <p style="white-space:pre-wrap">{{ $body }}</p>
    </div>
</body>
</html>