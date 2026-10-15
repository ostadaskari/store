<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>در حال انتقال به درگاه پرداخت بانک ملت...</title>
    <style>
        body { font-family: Tahoma, sans-serif; text-align: center; padding-top: 100px; background-color: #f8f9fa; }
        .loader { border: 5px solid #f3f3f3; border-top: 5px solid #e21313; border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite; margin: 20px auto; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>
<h3>در حال انتقال به درگاه پرداخت بانک ملت...</h3>
<p>لطفاً شکیبا باشید و صفحه را ببندید یا رفرش نکنید.</p>
<div class="loader"></div>

<form id="behpardashtForm" action="{{ $startPayUrl }}" method="POST">
    <input type="hidden" name="RefId" value="{{ $refId }}">
</form>

<script>
    document.getElementById('behpardashtForm').submit();
</script>
</body>
</html>
