<form action="{{ route('momo.atm') }}" method="POST">
    @csrf
    <label for="amount">Số tiền:</label>
    <input type="text" id="amount" name="amount" value="10000">

    <label for="bankCode">Mã ngân hàng:</label>
    <input type="text" id="bankCode" name="bankCode" value="SML">

    <button type="submit">Thanh toán qua MoMo ATM</button>
</form>
