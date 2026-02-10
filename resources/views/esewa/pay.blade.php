<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Redirecting to eSewa...</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-900">
  <main class="max-w-2xl mx-auto px-4 py-16">
    <div class="bg-white border rounded-xl shadow-lg p-8">
      <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
          <svg class="animate-spin h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
        </div>
        <h1 class="text-2xl font-bold mb-2">Redirecting to eSewa...</h1>
        <p class="text-slate-600 mb-6">Please wait while we redirect you to the payment gateway.</p>
      </div>

      <div class="bg-slate-50 border rounded-lg p-4 mb-6">
        <div class="flex justify-between">
          <span class="text-slate-600">Transaction ID</span>
          <span class="font-semibold">{{ $transactionId }}</span>
        </div>
        <div class="flex justify-between mt-2">
          <span class="text-slate-600">Amount</span>
          <span class="font-semibold">Rs. {{ number_format($amount, 2) }}</span>
        </div>
      </div>

      <!-- Test Credentials -->
      <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6">
        <p class="text-sm font-semibold text-amber-900 mb-2">📱 Test eSewa Credentials</p>
        <div class="text-sm text-amber-800 space-y-1">
          <div><span class="font-medium">eSewa ID:</span> 9806800001 – 9806800005</div>
          <div><span class="font-medium">Password:</span> Nepal@123</div>
          <div><span class="font-medium">Token:</span> 123456</div>
        </div>
      </div>

      <form id="esewaForm" method="POST" action="{{ config('services.esewa.payment_url') }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="tax_amount" value="0">
        <input type="hidden" name="total_amount" value="{{ $amount }}">
        <input type="hidden" name="transaction_uuid" value="{{ $transactionId }}">
        <input type="hidden" name="product_code" value="{{ config('services.esewa.merchant_id') }}">
        <input type="hidden" name="product_service_charge" value="0">
        <input type="hidden" name="product_delivery_charge" value="0">
        <input type="hidden" name="success_url" value="{{ route('esewa.success', [], true) }}">
        <input type="hidden" name="failure_url" value="{{ route('esewa.failure', [], true) }}">

        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
          Continue to eSewa
        </button>
      </form>

      <p class="text-xs text-slate-500 mt-4 text-center">If you are not redirected automatically, click the button above.</p>
    </div>
  </main>

  <script>
    // Auto-submit form after 2 seconds
    setTimeout(function() {
      document.getElementById('esewaForm').submit();
    }, 2000);
  </script>
</body>
</html>
