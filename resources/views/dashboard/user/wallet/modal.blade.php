<!-- Button trigger modal -->


@php
    $date = Date('d/m/y');
@endphp
<div class="modal fade" id="WalletModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLongTitle">Pay With Wallet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <h6> Your wallet balance as of today {{ $date }} is
                    <b> {{ $wallet->symbol }}{{ number_format($wallet->balance) }}.</b>
                    @if ($wallet->balance > $totalPrice)
                        It is eligible to pay for your order
                    @else
                        It is not sufficient to pay your order. Kindly fund your wallet to proceed.
                    @endif
                </h6>
            </div>
            <input type="hidden" name="amount" value="{{ $totalPrice }}">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if ($wallet->balance > $totalPrice)
                    <button type="submit" class="btn btn-primary">Pay ${{ $totalPrice }} now</button>
                @else
                    <a href="" class="btn btn-primary">Fund you wallet</a>
                @endif
            </div>
        </div>
    </div>
</div>
