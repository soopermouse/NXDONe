<?php
/**
 * Created by PhpStorm.
 * User: SimonaThrussell
 * Date: 11/09/2018
 * Time: 08:20
 */

<?php

require 'config.php';

protected_area(true);
$crud->table='order_prod';
$order_list= $crud->select('*');

$id= (int) $_GET['id'];
//if($id!= $_SESSION['user_id']){
//echo $_SESSION['message']= 'you do not have authority to be here.';
//redirect('dashboard.php');

//}
$crud;
$sql="SELECT order_id,product_name,quantity,total  FROM products INNER JOIN order_prod
 ON order_prod.prod_id=products.product_id
 WHERE order_id= ?";
$stmt= $crud->prepare($sql);
$stmt->execute([$id]);
$data= $stmt->fetchAll();
if(isset($_GET['save'])){
$quantity= $_POST['quantity'];
$total= $_POST['total'];


$result= $crud->update([
'quantity'=>$quantity,
'total'=>$total
],['order_id'=>$id]);
if($result){
echo "Orders no $id has been updated";
}
}
?>

<!doctype html>
<html><body>
<table>
<td><a href="dashboard.php">Dashboard</a></td>
<td> | </td>
 <td><a href="user.php">User</a> <td>
 <td> | </td>
 <td><a href="orders.php">Orders</a> <td>
 <td> | </td>
 <td><a href="index.php?logout"> Log Out</a><td>
 </table>

<h3>Edit Order</h3>
<form method="post" action="?save&id=<?=$id?>">
Quantity: <input type="text" name="quantity" value="<?=isset($quantity) ? $quantity : ''?>"><br />
Total: <input type="text" name="total" value="<?=isset($total) ? $total : ''?>"><br />
<input type="submit" value="Save" />
</form>
<h3>Current Order</h3>
<table border=1 bgcolor="lightgrey">
<tr>
<td>Order No.</td>
<td>Product</td>
<td>Quantity</td>
<td>Total</td>
</tr>
<?php foreach($data as $orderline):?>
<tr>
<td><?=$orderline['order_id']?></td>
<td><?=$orderline['product_name']?></td>
<td><?=$orderline['quantity']?></td>
<td><?=$orderline['total']?></td>


</tr>
<?php  endforeach;?>
</table>


</body></html>