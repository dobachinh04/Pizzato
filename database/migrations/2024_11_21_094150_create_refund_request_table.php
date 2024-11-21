<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('refund_request', function (Blueprint $table) {
            $table->id(); // ID tự tăng - Khóa chính cho bảng
            $table->string('name'); // Tên người dùng - Có thể tự động điền dựa trên thông tin tài khoản người dùng đã đăng nhập
            $table->string('email'); // Email người dùng - Có thể tự động điền dựa trên thông tin tài khoản người dùng đã đăng nhập

            $table->string('invoice_id'); // Mã hóa đơn - Không cho phép nhập tay - Hiển thị danh sách các mã hóa đơn có trạng thái "Canceled" dưới dạng dropdown (Form Select)
            $table->foreign('invoice_id')->references('invoice_id')->on('orders')->onDelete('cascade'); // Khóa ngoại liên kết với `invoice_id` trong bảng `orders`. Khi đơn hàng bị xóa, yêu cầu hoàn tiền cũng sẽ bị xóa theo.

            $table->decimal('refund_amount', 10, 2)->nullable(); // Hiển thị tổng giá trị đơn hàng (`grand_total` bên bảng `orders`) tương ứng với mã hóa đơn

            $table->text('refund_reason'); // Lý do hoàn tiền - Người dùng tự nhập vào

            $table->string('bank_number'); // Số tài khoản ngân hàng của khách hàng - Người dùng tự nhập
            $table->string('bank_type'); // Loại ngân hàng (VD: MB, ACB, Vietcombank,...) - Người dùng tự nhập

            $table->string('status')->default('Pending'); // Trạng thái của yêu cầu hoàn tiền - Hiển thị dưới dạng Select Fix Cứng (Pending, Approved, Rejected)
            $table->text('admin_note')->nullable(); // Ghi chú của Admin - Chỉ hiển thị cho quản trị viên, ẩn đối với người dùng

            $table->timestamps(); // Tự động thêm 2 cột `created_at` và `updated_at` để lưu ngày tạo và ngày cập nhật yêu cầu hoàn tiền
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_request');

    }
};
