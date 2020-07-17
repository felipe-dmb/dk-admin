<?php
require "header.php";
?>

<hr/>
<?php if(!empty($msg)) :?>
	<p><?=$msg?></p>
<?php endif; ?>
<form method="POST" id="clientForm">

<?php if( !empty($_GET["clientId"]) ):?>
	<input type="hidden" name="clientId" value="<?=$clientData['clientId']?>">
<?php endif;?>
	<input type="hidden" name="st" value="<?=$st?>">


<?php if($st == "rm") :?>
	<section class="alert alert-danger">
		<p>
			Você tem certeza que deseja excluir esse Cliente?	
		</p>
		<button type="submit" >
			Sim
		</button>
		<button type="button" onclick="location.href = 'client.php';" >
			Não
		</button>
	</section>
<?php endif?>

<section>
	<h3>Dados Pessoais</h3>
	<fieldset class="form-check border rounded form-group">
		<legend class="">Pessoa</legend>
		<ul class="list-unstyled ">
			<li class="form-check-inline">
				<input type="radio" name="clientPessoa" id="fisica" class="form-check-input" value="1" <?=$disabled?> />
				<label for="fisica" class="form-check-label">Pessoa Física</label>
			</li>
			<li class="form-check-inline">
				<input type="radio" name="clientPessoa" id="juridica" class="form-check-input" value="2" <?=$disabled?> />
				<label for="juridica" class="form-check-label">Pessoa Jurídica</label>
			</li>
		</ul>
	</fieldset>
	<div class="form-group">
		<label for="name">Nome do Cliente:</label>
		<input type="text" name="clientName" id="name" class="form-control" 
		value="<?=($clientData['clientName'])??null?>" <?=$disabled?> />
	</div>
	<div class="form-group">
		<label for="contact">Nome para Contato:</label>
		<input type="text" name="clientContact" id="contact" class="form-control"
		value="<?=($clientData['clientContact'])??null?>" <?=$disabled?> />
	</div>
	<div class="form-group">
		<label for="email">Endereço de Email:</label>
		<input type="email" name="clientEmail" id="email" class="form-control"
		value="<?=($clientData['clientEmail'])??null?>" <?=$disabled?> />
	</div>
</section>

<section>
	<h3>Telefones para Contato</h3>
	<div class="form-row">
		<div class="form-group col-md-2 m-auto">
			<label for="mobile" class="">Celular:</label>
			<input type="text" id="mobile" name="clientMobile" class="form-control"
			value="<?=($clientData['clientMobile'])??null?>" <?=$disabled?> >
		</div>
		<div class="form-group col-md-2 m-auto">
			<label for="tel1" class="">Telefone 1:</label>
			<input type="text" id="tel1" name="clientTel1" class="form-control"
			value="<?=($clientData['clientTel1'])??null?>" <?=$disabled?> >
		</div>
		<div class="form-group col-md-2 m-auto">
			<label for="tel2" class="">Telefone 2:</label>
			<input type="text" id="tel2" name="clientTel2" class="form-control"
			value="<?=($clientData['clientTel2'])??null?>" <?=$disabled?> >
		</div>
	</div>
</section>

<section>
	<h3>Endereço</h3>
	<div class="form-group">
		<label for="address">Endereço do Cliente:</label>
		<input type="text" name="clientAddress" id="address" class="form-control"
		value="<?=($clientData['clientAddress'])??null?>" <?=$disabled?> />
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="city">Cidade:</label>
			<input type="text" name="clientCity" id="city" class="form-control" 
			value="<?=($clientData['clientCity'])??null?>" <?=$disabled?> />
		</div>
		<div class="form-group col-md-4">
			<label for="block">Bairro:</label>
			<input type="text" name="clientBlock" id="block" class="form-control" 
			value="<?=($clientData['clientBlock'])??null?>" <?=$disabled?> />
		</div>
		<div class="form-group col-md-2">
			<label for="cep">CEP:</label>
			<input type="text" name="clientCep" id="cep" class="form-control" 
			value="<?=($clientData['clientCep'])??null?>" <?=$disabled?> />
		</div>
		<div class="form-group col-md-1">
			<label for="addressnum">Número:</label>
			<input type="text" name="clientAddressNum" id="addressnum" class="form-control" 
			value="<?=($clientData['clientAddressnum'])??null?>" <?=$disabled?> />
		</div>
		<div class="form-group col-md-1">
			<label for="uf">Estado:</label>
			<select name="clientUf" class="form-control" id="uf" <?=$disabled?> >
				<?php $clientData['clientUf'] = $clientData['clientUf']??null?>
				<option value="AC" <?=( $clientData["clientUf"] == "AC" ? "selected" : "")?> >
				AC</option>
				<option value="AL" <?=( $clientData["clientUf"] == "AL" ? "selected" : "")?> >
				AL</option>
				<option value="AP" <?=( $clientData["clientUf"] == "AP" ? "selected" : "")?> >
				AP</option>
				<option value="AM" <?=( $clientData["clientUf"] == "AM" ? "selected" : "")?> >
				AM</option>
				<option value="BA" <?=( $clientData["clientUf"] == "BA" ? "selected" : "")?> >
				BA</option>
				<option value="CE" <?=( $clientData["clientUf"] == "CE" ? "selected" : "")?> >
				CE</option>
				<option value="DF" <?=( $clientData["clientUf"] == "DF" ? "selected" : "")?> >
				DF</option>
				<option value="ES" <?=( $clientData["clientUf"] == "ES" ? "selected" : "")?> >
				ES</option>
				<option value="GO" <?=( $clientData["clientUf"] == "GO" ? "selected" : "")?> >
				GO</option>
				<option value="MA" <?=( $clientData["clientUf"] == "MA" ? "selected" : "")?> >
				MA</option>
				<option value="MT" <?=( $clientData["clientUf"] == "MT" ? "selected" : "")?> >
				MT</option>
				<option value="MS" <?=( $clientData["clientUf"] == "MS" ? "selected" : "")?> >
				MS</option>
				<option value="MG" <?=( $clientData["clientUf"] == "MG" ? "selected" : "")?> >
				MG</option>
				<option value="PA" <?=( $clientData["clientUf"] == "PA" ? "selected" : "")?> >
				PA</option>
				<option value="PB" <?=( $clientData["clientUf"] == "PB" ? "selected" : "")?> >
				PB</option>
				<option value="PR" <?=( $clientData["clientUf"] == "PR" ? "selected" : "")?> >
				PR</option>
				<option value="PE" <?=( $clientData["clientUf"] == "PE" ? "selected" : "")?> >
				PE</option>
				<option value="PI" <?=( $clientData["clientUf"] == "PI" ? "selected" : "")?> >
				PI</option>
				<option value="RJ" <?=( $clientData["clientUf"] == "RJ" ? "selected" : "")?> >
				RJ</option>
				<option value="RN" <?=( $clientData["clientUf"] == "RN" ? "selected" : "")?> >
				RN</option>
				<option value="RS" <?=( $clientData["clientUf"] == "RS" ? "selected" : "")?> >
				RS</option>
				<option value="RO" <?=( $clientData["clientUf"] == "RO" ? "selected" : "")?> >
				RO</option>
				<option value="RR" <?=( $clientData["clientUf"] == "RR" ? "selected" : "")?> >
				RR</option>
				<option value="SC" <?=( $clientData["clientUf"] == "SC" ? "selected" : "")?> >
				SC</option>
				<option value="SP" 
				<?=( (($clientData["clientUf"] == "SP") OR empty($clientData["clientUf"])) ? "selected" : "")?> >
				SP</option>
				<option value="SE" <?=( $clientData["clientUf"] == "SE" ? "selected" : "")?> >
				SE</option>
				<option value="TO" <?=( $clientData["clientUf"] == "TO" ? "selected" : "")?> >
				TO</option>
			</select>
		</div>
	</div>
</section>

<!--<section>
	<h3>Detalhes</h3>
	<div class="form-group">
		<label for="details">Detalhes a respeito do Cliente:</label>
		<textarea id="details" name="<?=$formName['details']?>" class="form-control"></textarea>
	</div>
</section>-->

<?php if($st != "rm"):?>
<section class="m-auto button-group">
	<button type="subtmit" name="" id="submit" class="btn-lg btn-success">Enviar</button>
	<button type="reset" name="" class="btn btn-warning">Limpar</button>
	<button type="button" name="" class="btn btn-danger" onclick="location.href = 'client.php' ">Cancelar</button>
</section>
<?php endif ?>

</form>
<?php
require "footer.php";
?>