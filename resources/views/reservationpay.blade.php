<div class="container">
    <h2>Payment Details</h2>
    <p>Total Amount: ${{ $cost }}</p>
    <p>Discount: ${{ $discount }}</p>
    <p>Final Amount to Pay: ${{ $cost - $discount }}</p>
    <a href="{{ url('/') }}">Go to Home</a>
</div>