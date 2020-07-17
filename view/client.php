<?php
require "header.php";
?>
<p>
	<a href="client_dm.php" class="btn btn-success">+ Adicionar</a>
	Total de Clientes: <?=$clientRC?>
</p>

<div class="" style="text-align: center; margin: 20px 0px;">
	<a href="client.php?fl=A" class="btn btn-info">A</a>
	<a href="client.php?fl=B" class="btn btn-info">B</a>
	<a href="client.php?fl=C" class="btn btn-info">C</a>
	<a href="client.php?fl=D" class="btn btn-info">D</a>
	<a href="client.php?fl=E" class="btn btn-info">E</a>
	<a href="client.php?fl=F" class="btn btn-info">F</a>
	<a href="client.php?fl=G" class="btn btn-info">G</a>
	<a href="client.php?fl=H" class="btn btn-info">H</a>
	<a href="client.php?fl=I" class="btn btn-info">I</a>
	<a href="client.php?fl=J" class="btn btn-info">J</a>
	<a href="client.php?fl=K" class="btn btn-info">K</a>
	<a href="client.php?fl=L" class="btn btn-info">L</a>
	<a href="client.php?fl=M" class="btn btn-info">M</a>
	<a href="client.php?fl=N" class="btn btn-info">N</a>
	<a href="client.php?fl=O" class="btn btn-info">O</a>
	<a href="client.php?fl=P" class="btn btn-info">P</a>
	<a href="client.php?fl=Q" class="btn btn-info">Q</a>
	<a href="client.php?fl=R" class="btn btn-info">R</a>
	<a href="client.php?fl=S" class="btn btn-info">S</a>
	<a href="client.php?fl=T" class="btn btn-info">T</a>
	<a href="client.php?fl=U" class="btn btn-info">U</a>
	<a href="client.php?fl=V" class="btn btn-info">V</a>
	<a href="client.php?fl=W" class="btn btn-info">W</a>
	<a href="client.php?fl=X" class="btn btn-info">X</a>
	<a href="client.php?fl=Y" class="btn btn-info">Y</a>
	<a href="client.php?fl=Z" class="btn btn-info">Z</a>
</div>

<p>
	Resultado da Busca: <?=count($clientData)?>
</p>
<table class="table">
	<thead>
		<tr>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Telefone</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($clientData as $row) :?>
		<tr>
			<td><a href="client_info.php?clientId=<?=$row['clientId']?>"><?=$row["clientName"]?></a></td>
			<td><?=$row["clientEmail"]?></td>
			<td><?php 
			$mobile = empty($row['clientMobile'])? NULL : $row['clientMobile'] . " <small>Celular</small><br>";
			$tel1 = empty($row['clientTel1'])? NULL : $row['clientTel1'] . "<br>" ;
			$tel2 = empty($row['clientTel2'])? NULL : $row['clientTel2'] ;
			echo $mobile . $tel1 . $tel2;
			?>
			</td>
			<td>
				<a class='btn btn-info' href="client_dm.php?clientId=<?=$row['clientId']?>&st=edit"
					>Editar</a>
				&nbsp;	
				<a class='btn btn-danger' href="client_dm.php?clientId=<?=$row['clientId']?>&st=rm"
					>- Remover</a>
			</td>
		</tr>
	<?php endforeach?>
	</tbody>
	
</table>
<?php
require "footer.php";
?>