<?php
require "header.php";

?>
<hr>

<section>
	<h3>Dados Pessoais&nbsp;
<a href="client_dm.php?clientId=<?=$clientData["clientId"]?>&st=edit" class="btn btn-info">Editar</a>&nbsp;
<a href="client_dm.php?clientId=<?=$clientData["clientId"]?>&st=rm" class="btn btn-danger">Remover</a>
	</h3>
	<p><strong>Nome do Cliente:</strong> <?=$clientData["clientName"]?></p>
	<p><strong>E-mail do Cliente:</strong> <?=$clientData["clientEmail"]?></p>
	<p> 
		<strong>Telefones:</strong> 
		<?=$clientData["clientMobile"]?>
		<?=$clientData["clientTel1"]?> 
		<?=$clientData["clientTel2"]?>
	</p>
	<p>
		<strong>Endereço: </strong>
		<?=$clientData["clientAddress"]?>, 
		Nº <?=$clientData["clientAddressNum"]?> 
		– <?=$clientData["clientCity"]?> <?=$clientData["clientUf"]?>
	</p>
	<p>
		<strong>CEP:</strong> <?=$clientData["clientCep"]?>
	</p>
</section>

<table class="table">
	<thead>
		<tr>
			<th>No. do Pedido</th>
			<th>Última Atualização</th>
			<th>Total</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
	
	<?php foreach ($orderData as $row) :?>
		<tr>
			<td><?=$row["orderId"]?></td>
			<td><?=$row["orderLastUpdate"]?></td>
			<td><?=$row["orderTotal"]?></td>
			<td>
				<a href="order_dm?orderId=<?=$row["orderId"]?>&st=edit" class="btn btn-info">Editar</a>
				&nbsp;
				<a href="order_dm?orderId=<?=$row["orderId"]?>&st=rm" class="btn btn-danger">Remover</a>	
			</td>
		</tr>
	<?php endforeach?>

	</tbody>
	
</table>
<?php
require "footer.php";
?>