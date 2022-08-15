<?php
include 'config.php';
$subcategory = $_POST["subcategory"];
$result = mysqli_query($conn,"SELECT * FROM product_subcategory where id = $subcategory");
?>
<option value="">Select SubCategory</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["subcategory"];?></option>
<?php
}
?>