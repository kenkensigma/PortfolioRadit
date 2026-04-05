<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { background: #f4f4f0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; padding: 40px 16px; }
    .wrapper { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e8e8e4; }
    .header { background: #1a1a1a; padding: 28px 32px; display: flex; align-items: center; gap: 12px; }
    .header-icon { width: 36px; height: 36px; border-radius: 50%; border: 1.5px solid rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; }
    .header-title { font-size: 15px; font-weight: 500; color: #fff; }
    .header-sub { font-size: 12px; color: rgba(255,255,255,0.45); margin-top: 2px; }
    .body { padding: 32px; }
    .section-label { font-size: 11px; color: #999; letter-spacing: 0.08em; text-transform: uppercase; font-weight: 500; margin-bottom: 14px; }
    .field { display: flex; align-items: flex-start; gap: 14px; padding: 14px 16px; background: #f8f8f6; border-radius: 8px; margin-bottom: 10px; }
    .field-meta { font-size: 11px; color: #aaa; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 3px; }
    .field-value { font-size: 14px; color: #1a1a1a; font-weight: 500; }
    .message-box { padding: 20px; background: #f8f8f6; border-radius: 8px; border-left: 3px solid #1a1a1a; margin-top: 8px; }
    .message-text { font-size: 14px; color: #333; line-height: 1.7; }
    .footer { margin-top: 28px; padding-top: 20px; border-top: 1px solid #ebebeb; display: flex; justify-content: space-between; }
    .footer p { font-size: 12px; color: #bbb; }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="header">
      <div class="header-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
          <polyline points="22,6 12,13 2,6"/>
        </svg>
      </div>
      <div>
        <p class="header-title">New message received</p>
        <p class="header-sub">portfolio contact form</p>
      </div>
    </div>

    <div class="body">
      <p class="section-label">Sender details</p>

      <div class="field">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#aaa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top:2px;flex-shrink:0;">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
        </svg>
        <div>
          <p class="field-meta">Name</p>
          <p class="field-value">{{ $name }}</p>
        </div>
      </div>

      <div class="field">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#aaa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top:2px;flex-shrink:0;">
          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
          <polyline points="22,6 12,13 2,6"/>
        </svg>
        <div>
          <p class="field-meta">Email</p>
          <p class="field-value">{{ $email }}</p>
        </div>
      </div>

      <p class="section-label" style="margin-top: 24px;">Message</p>
      <div class="message-box">
        <p class="message-text">{{ $userMessage }}</p>
      </div>

      <div class="footer">
        <p>Sent via portfolio contact form</p>
        <p>{{ now()->format('d M Y, H:i') }}</p>
      </div>
    </div>
  </div>
</body>
</html>