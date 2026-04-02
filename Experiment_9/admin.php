<?php
include 'db.php';

// --- LOGIC: DELETE PRODUCT ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id");
    header("Location: admin.php"); // Refresh page
}

// --- LOGIC: CREATE OR UPDATE PRODUCT ---
if (isset($_POST['save_product'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $cat = $_POST['category'];
    $img = $_POST['image_url'];
    $rating = $_POST['rating'];

    // If ID is present, UPDATE. Otherwise, INSERT.
    if ($_POST['id']) {
        $id = $_POST['id'];
        $conn->query("UPDATE products SET name='$name', description='$desc', price='$price', category='$cat', image_url='$img', rating='$rating' WHERE id=$id");
    } else {
        $conn->query("INSERT INTO products (name, description, price, category, image_url, rating) VALUES ('$name', '$desc', '$price', '$cat', '$img', '$rating')");
    }
    header("Location: admin.php");
}

// --- LOGIC: FETCH DATA FOR EDITING ---
 $edit_product = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM products WHERE id=$id");
    $edit_product = $result->fetch_assoc();
}

// --- LOGIC: RETRIEVE ALL PRODUCTS FOR LIST ---
 $products = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">

    <!-- Navigation -->
    <nav class="bg-gray-800 border-b border-gray-700 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold text-white">LUXE<span class="text-orange-500">.</span> Admin</h1>
            <a href="index.php" class="bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded text-sm font-medium">View Store</a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-8 grid lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Form -->
        <div class="lg:col-span-1 bg-gray-800 rounded-xl p-6 border border-gray-700 h-fit sticky top-8">
            <h2 class="text-lg font-bold mb-6 text-gray-200"><?php echo $edit_product ? 'Edit Product' : 'Add New Product'; ?></h2>
            
            <form method="POST" class="space-y-4">
                <input type="hidden" name="id" value="<?php echo $edit_product['id'] ?? ''; ?>">
                
                <div>
                    <label class="block text-xs text-gray-400 mb-1 uppercase tracking-wide">Product Name</label>
                    <input type="text" name="name" required value="<?php echo $edit_product['name'] ?? ''; ?>" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:border-orange-500">
                </div>

                <div>
                    <label class="block text-xs text-gray-400 mb-1 uppercase tracking-wide">Description</label>
                    <textarea name="description" rows="3" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:border-orange-500"><?php echo $edit_product['description'] ?? ''; ?></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-400 mb-1 uppercase tracking-wide">Price ($)</label>
                        <input type="number" step="0.01" name="price" required value="<?php echo $edit_product['price'] ?? ''; ?>" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:border-orange-500">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 mb-1 uppercase tracking-wide">Rating (0-5)</label>
                        <input type="number" step="0.1" name="rating" max="5" value="<?php echo $edit_product['rating'] ?? '0'; ?>" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:border-orange-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 mb-1 uppercase tracking-wide">Category</label>
                    <select name="category" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:border-orange-500">
                        <option value="Electronics" <?php echo ($edit_product['category'] ?? '') == 'Electronics' ? 'selected' : ''; ?>>Electronics</option>
                        <option value="Accessories" <?php echo ($edit_product['category'] ?? '') == 'Accessories' ? 'selected' : ''; ?>>Accessories</option>
                        <option value="Clothing" <?php echo ($edit_product['category'] ?? '') == 'Clothing' ? 'selected' : ''; ?>>Clothing</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 mb-1 uppercase tracking-wide">Image URL</label>
                    <input type="text" name="image_url" value="<?php echo $edit_product['image_url'] ?? ''; ?>" placeholder="https://..." class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:border-orange-500">
                </div>

                <button type="submit" name="save_product" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-lg transition-colors mt-4">
                    <?php echo $edit_product ? 'Update Product' : 'Save Product'; ?>
                </button>
                <?php if($edit_product): ?>
                    <a href="admin.php" class="block text-center text-gray-500 text-sm mt-2 hover:text-white">Cancel Edit</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Right Column: Product List -->
        <div class="lg:col-span-2">
            <h2 class="text-xl font-bold mb-6 text-gray-200">Inventory</h2>
            <div class="space-y-4">
                <?php while($row = $products->fetch_assoc()): ?>
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-4 flex items-center gap-4 hover:border-gray-600 transition-colors">
                    <img src="<?php echo $row['image_url']; ?>" class="w-20 h-20 object-cover rounded-lg bg-gray-700">
                    
                    <div class="flex-1">
                        <h3 class="font-bold text-white"><?php echo $row['name']; ?></h3>
                        <p class="text-sm text-gray-400"><?php echo $row['category']; ?> &bull; $<?php echo number_format($row['price'], 2); ?></p>
                    </div>

                    <div class="flex gap-2">
                        <a href="admin.php?edit=<?php echo $row['id']; ?>" class="px-3 py-2 bg-gray-700 hover:bg-gray-600 rounded text-xs font-medium">Edit</a>
                        <a href="admin.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" class="px-3 py-2 bg-red-900 hover:bg-red-800 rounded text-xs font-medium text-red-300">Delete</a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>