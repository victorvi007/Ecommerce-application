if (!mysqli_connect_errno()) {

$query = 'SELECT * FROM products ORDER BY added_at DESC';
$result = mysqli_query($conn, $query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
}

if (isset($_POST['add'])) {
session_start();
//
if (empty($_SESSION['cart'])) {
$_SESSION['cart'] = array();
}

$cart_array = array_push($_SESSION['cart'], $_POST['product_id']);
$cart_contents = $_SESSION['cart'];
//echo count($cart_contents);
foreach ($cart_contents as $cart_content) {
//echo $cart_content . '<br>';
}
}

$_SESSION['id'] = [];
$id_array = array_push($_SESSION['id'],$_POST['add']);

var_dump(count($_SESSION['id']));