<?php
include 'db.php';

// RETRIEVE PRODUCTS
 $category_filter = isset($_GET['category']) ? $_GET['category'] : null;

if ($category_filter) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->bind_param("s", $category_filter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LUXE Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background: #0a0a0b; }
        .product-card:hover .product-image { transform: scale(1.05); }
    </style>
</head>
<body class="text-gray-100">

    <!-- Navigation -->
    <nav class="fixed w-full bg-[#0a0a0b]/90 backdrop-blur-lg z-50 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-white">LUXE<span class="text-orange-500">.</span></a>
            
            <!-- Filters -->
            <div class="flex gap-2 text-sm">
                <a href="index.php" class="px-4 py-2 rounded-full <?php echo !$category_filter ? 'bg-orange-500 text-white' : 'bg-gray-800 text-gray-400 hover:text-white'; ?>">All</a>
                <a href="?category=Electronics" class="px-4 py-2 rounded-full <?php echo $category_filter == 'Electronics' ? 'bg-orange-500 text-white' : 'bg-gray-800 text-gray-400 hover:text-white'; ?>">Electronics</a>
                <a href="?category=Accessories" class="px-4 py-2 rounded-full <?php echo $category_filter == 'Accessories' ? 'bg-orange-500 text-white' : 'bg-gray-800 text-gray-400 hover:text-white'; ?>">Accessories</a>
            </div>

            <a href="admin.php" class="text-sm text-gray-400 hover:text-white border border-gray-700 px-4 py-2 rounded-full">Admin</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="pt-32 pb-16 px-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold leading-tight">
                Discover<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-amber-400">Exceptional</span> Products
            </h1>
            <p class="text-gray-500 text-lg mt-4 max-w-xl">Curated selection of premium items designed for those who appreciate quality.</p>
        </div>
    </header>

    <!-- Product Grid -->
    <main class="px-6 pb-24">
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            
            <?php while($product = $result->fetch_assoc()): ?>
            <!-- Product Card -->
            <article class="product-card bg-[#111113] rounded-2xl overflow-hidden border border-gray-800 hover:border-gray-700 transition-all duration-300 group">
                <div class="relative aspect-square overflow-hidden bg-gray-800">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image w-full h-full object-cover transition-transform duration-500">
                    
                    <!-- Quick Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                        <button class="w-full bg-orange-500 text-white py-2 rounded-lg font-medium">Add to Cart</button>
                    </div>
                </div>

                <div class="p-5">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1"><?php echo $product['category']; ?></p>
                    <h3 class="font-semibold text-lg mb-2 truncate"><?php echo htmlspecialchars($product['name']); ?></h3>
                    
                    <!-- Rating Stars -->
                    <div class="flex items-center gap-1 mb-3">
                        <?php 
                        $rating = $product['rating'];
                        for($i=1; $i<=5; $i++): 
                            if($i <= $rating) {
                                echo '<svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
                            } else {
                                echo '<svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
                            }
                        endfor;
                        ?>
                        <span class="text-xs text-gray-500 ml-1">(<?php echo $product['rating']; ?>)</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-xl font-bold text-white">$<?php echo number_format($product['price'], 2); ?></span>
                        <span class="text-xs text-green-500 font-medium">In Stock</span>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>

        </div>
    </main>

</body>
</html>