<?php
$page_title = 'Deliveries';
require_once 'includes/header.php';
require_once 'includes/db.php';

$sql = "SELECT d.delivery_id, d.delivery_date, d.farmer_id, d.litres, f.route_id FROM milk_delivery d JOIN farmer f ON d.farmer_id = f.farmer_id ORDER BY d.delivery_date DESC, d.delivery_id DESC";
$result = mysqli_query($conn, $sql);

$total_sql = "SELECT SUM(litres) AS total_litres FROM milk_delivery";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
?>
<main>
<h2>Record a delivery</h2>
<p>Use this form to record a delivery of milk at a collection centre. Fill in the member number, the litres delivered, the route and the date.</p>

<form id="deliveryForm">
<label for="memberNumber">Member number</label>
<input type="text" id="memberNumber" placeholder="e.g. ER-0042">

<label for="litres">Litres delivered</label>
<input type="number" id="litres" placeholder="e.g. 12">

<label for="route">Route</label>
<select id="route">
<option value="Kiserian">Kiserian</option>
<option value="Ngong">Ngong</option>
<option value="Rongai">Rongai</option>
</select>

<label for="deliveryDate">Date</label>
<input type="date" id="deliveryDate">

<button type="submit">Record delivery</button>
</form>

<p id="formError"></p>

<h2>Recent deliveries</h2>
<table id="deliveriesTable">
<thead>
<tr>
<th>Delivery ID</th>
<th>Date</th>
<th>Farmer</th>
<th>Litres</th>
<th>Route</th>
</tr>
</thead>
<tbody>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo htmlspecialchars($row['delivery_id']); ?></td>
<td><?php echo htmlspecialchars($row['delivery_date']); ?></td>
<td><?php echo htmlspecialchars($row['farmer_id']); ?></td>
<td><?php echo htmlspecialchars($row['litres']); ?></td>
<td><?php echo htmlspecialchars($row['route_id']); ?></td>
</tr>
<?php } ?>
</tbody>
<tfoot>
<tr>
<td colspan="4">Total litres</td>
<td id="litresTotal"><?php echo htmlspecialchars($total_row['total_litres']); ?></td>
</tr>
</tfoot>
</table>
</main>
<?php require_once 'includes/footer.php'; ?>
