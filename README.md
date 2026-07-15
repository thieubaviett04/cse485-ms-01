# MiniShop — Catalog (Buổi 1)

Dự án này là lời giải cho bài tập **Phiếu 01 — PHP cơ bản & Catalog MiniShop** thuộc khóa học CSE485.

## Cấu trúc thư mục

- `data.php`: Lưu trữ cấu trúc mảng cho sản phẩm (`$products`) và danh mục (`$categories`).
- `index.php`: Xử lý logic, tính toán thành tiền, map tên danh mục, và kết xuất mã HTML an toàn qua XSS.
- `style.css`: Giao diện hiển thị hiện đại theo phong cách Dark Mode và Glassmorphism.

## Chuẩn đầu ra & Số liệu kiểm tra

- **Tổng số lượng sản phẩm (`product_count`):** 8
- **Tổng giá trị kho hàng (`inventory_value`):** 41.380.000 ₫
- **Map danh mục:** Chuyển đổi mã ID danh mục sang tên chữ (`Ban phim`, `Chuot`, `Man hinh`).
- **An toàn mã nguồn:** Escape HTML với `htmlspecialchars` khi xuất ra Client.

## Hướng dẫn chạy thử nghiệm

Để khởi chạy trang web trên môi trường local, thực hiện lệnh:
```bash
php -S localhost:8000
```
Sau đó truy cập đường dẫn: http://localhost:8000/
