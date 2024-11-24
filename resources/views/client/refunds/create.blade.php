<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input, select, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

textarea {
    resize: none;
}

input[readonly], textarea[readonly] {
    background-color: #f1f1f1;
    cursor: not-allowed;
}

.btn-submit {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

.btn-submit:hover {
    background-color: #0056b3;
}

</style>

<div class="refund-form">
  <form action="/refunds" method="POST">
    @csrf
      <h2>Yêu Cầu Hoàn Tiền</h2>

      <div class="form-group">
          <label for="name">Tên người dùng</label>
          <input type="text" id="name" name="name" value="Nguyễn Văn A" readonly>
      </div>

      <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="email@example.com" >
      </div>

      <div class="form-group">
          <label for="invoice_id">Mã hóa đơn</label>
      <input type="text" readonly>
      </div>

      <div class="form-group">
          <label for="refund_amount">Số tiền hoàn trả</label>
          <input type="text" id="refund_amount" name="refund_amount" value="500,000 VNĐ" readonly>
      </div>

      <div class="form-group">
          <label for="refund_reason">Lý do hoàn tiền</label>
          <textarea id="refund_reason" name="refund_reason" rows="4" placeholder="Nhập lý do..."></textarea>
      </div>

      <div class="form-group">
          <label for="bank_number">Số tài khoản ngân hàng</label>
          <input type="text" id="bank_number" name="bank_number" placeholder="Nhập số tài khoản...">
      </div>

      <div class="form-group">
          <label for="bank_type">Loại ngân hàng</label>
          <input type="text" id="bank_type" name="bank_type" placeholder="Nhập tên ngân hàng...">
      </div>

      <button type="submit" class="btn-submit">Gửi Yêu Cầu</button>
  </form>
</div>

