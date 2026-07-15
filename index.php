<?php
// 1. Nhập file dữ liệu
require_once 'data.php';

// 2. Tạo mảng phụ để ánh xạ category_id -> tên danh mục chữ
$categoryMap = [];
foreach ($categories as $cat) {
    $categoryMap[$cat['id']] = $cat['name'];
}

// 3. Tính toán tổng số lượng và tổng giá trị kho hàng
$total_inventory_value = 0;
$product_count = count($products);

// Mảng chứa dữ liệu sau khi đã tính toán thành tiền và map danh mục
$processed_products = [];
foreach ($products as $product) {
    // Tính thành tiền từng dòng = giá * số lượng
    $line_total = $product['price'] * $product['qty'];
    $total_inventory_value += $line_total;
    
    // Lấy tên danh mục chữ dựa vào category_id
    $cat_id = $product['category_id'];
    $category_name = isset($categoryMap[$cat_id]) ? $categoryMap[$cat_id] : 'Chưa phân loại';
    
    // Gộp dữ liệu mới vào sản phẩm
    $processed_products[] = array_merge($product, [
        'category_name' => $category_name,
        'line_total' => $line_total
    ]);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hệ thống quản lý kho sản phẩm MiniShop">
    <title>MiniShop — Catalog (Buoi 1)</title>
    <!-- Nhúng file style.css để áp dụng giao diện -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <header>
        <h1 id="shop-title">MiniShop Catalog</h1>
        <p>Hệ thống Quản lý Kho Hàng & Sản Phẩm (Buổi 1)</p>
    </header>

    <!-- Hộp thống kê ở trên cùng -->
    <div class="stats-grid">
        <div class="stat-card" id="stat-total-products">
            <span class="stat-label">Số sản phẩm</span>
            <span class="stat-value highlight"><?php echo htmlspecialchars($product_count); ?></span>
        </div>
        <div class="stat-card" id="stat-total-value">
            <span class="stat-label">Tổng giá trị kho</span>
            <span class="stat-value"><?php echo htmlspecialchars(number_format($total_inventory_value, 0, ',', '.')); ?> ₫</span>
        </div>
        <div class="stat-card" id="stat-total-categories">
            <span class="stat-label">Số danh mục</span>
            <span class="stat-value"><?php echo htmlspecialchars(count($categories)); ?></span>
        </div>
    </div>

    <!-- Bảng danh sách sản phẩm -->
    <div class="table-card" id="catalog-card">
        <h2 class="table-title">Danh sách sản phẩm chi tiết</h2>
        <div class="table-wrapper">
            <table id="product-table">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Danh mục</th>
                        <th>Tên sản phẩm</th>
                        <th class="text-right">Đơn giá</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-right">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($processed_products as $p): 
                        // Xác định class CSS cho badge danh mục để tô màu khác nhau
                        $badge_class = 'badge-default';
                        $cat_name_lower = strtolower($p['category_name']);
                        if (strpos($cat_name_lower, 'phim') !== false) {
                            $badge_class = 'badge-keyboard';
                        } elseif (strpos($cat_name_lower, 'chuot') !== false) {
                            $badge_class = 'badge-mouse';
                        } elseif (strpos($cat_name_lower, 'hinh') !== false) {
                            $badge_class = 'badge-monitor';
                        }
                    ?>
                        <tr>
                            <td><span class="sku-text"><?php echo htmlspecialchars($p['sku']); ?></span></td>
                            <td>
                                <span class="badge <?php echo htmlspecialchars($badge_class); ?>">
                                    <?php echo htmlspecialchars($p['category_name']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($p['name']); ?></td>
                            <td class="text-right price-col"><?php echo htmlspecialchars(number_format($p['price'], 0, ',', '.')); ?> ₫</td>
                            <td class="text-center"><?php echo htmlspecialchars($p['qty']); ?></td>
                            <td class="text-right total-col"><?php echo htmlspecialchars(number_format($p['line_total'], 0, ',', '.')); ?> ₫</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Phần hiển thị dữ liệu thô phục vụ debug -->
    <div class="debug-card" id="debug-section">
        <h3 class="debug-title">Hệ thống Debug (var_dump)</h3>
        <pre><?php var_dump($products); ?></pre>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> MiniShop. Được xây dựng trên chuẩn đầu ra CLO khóa học CSE485.</p>
    </footer>
</div>

</body>
</html>
<!-- MS_EXPECT product_count=8 inventory_value=41380000 -->
