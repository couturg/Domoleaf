<?php

include('configuration-menu.php');

echo '
<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-10 col-xs-offset-2">
	<div class="center"><h2>'._('Device configuration').'</h2></div>
	<div>
		<a href="/conf_installation/'.$_GET['floor'].'/'.$_GET['room'].'" class="btn btn-greenleaf">
			<span class="fa fa-reply"></span> '._('Back').'
		</a>
	</div>
	<div class="col-xs-12"><br/>
		<h3 class="subheader">'._('Information').'</h3><br/>
		<div class="col-md-6 col-xs-12">
			<div class="control-group">
				<label class="control-label" for="devicename">'._('Device Name').'</label>
				<div class="input-group">
					<label for="devicename" class="input-group-addon">
						<span class="glyphicon glyphicon-hdd" aria-hidden="true"></span>
					</label>
					<input name="devicename" type="text" class="form-control" id="devicename" value="'.$device->name.'" placeholder="'._('Enter your device name').'">
				</div>
			</div>
			<br/>';
		if (!empty($device->daemon_id)){
			echo '
			<div class="control-group" >
				<label class="control-label" for="listdaemon">'._('Box').'</label>
				<select class="selectpicker form-control" id="listdaemon">';
					foreach ($daemonlist as $elem){
						if (!empty($elem->protocol->{1})) {
							if ($device->daemon_id == $elem->daemon_id){
								echo '<option selected value="'.$elem->daemon_id.'">'.$elem->name.'</option>';
							}
							else {
								echo '<option value="'.$elem->daemon_id.'">'.$elem->name.'</option>';
							}
						}
					}
				echo '
				</select>
			</div>';
		}
	echo '
	</div>
	<div class="col-md-6 col-xs-12">
		<div class="control-group" id="selectFloor">
			<label class="control-label" for="listfloor">'._('Floor').'</label>
			<select class="selectpicker form-control" selected id="listfloor" onchange="GetRoomByFloor()">';
				foreach ($floorlistroom as $elem){
					if ($_GET['floor'] == $elem->floor_id){
						echo '
						<option value="'.$elem->floor_id.'" selected>'.$elem->floor_name.'</option>';
					}
					else {
						echo '
						<option value="'.$elem->floor_id.'">'.$elem->floor_name.'</option>';
					}
				}
			echo '
			</select>
		</div>
		<br/>
		<div id="selectRoom" class="control-group">
			<label for="listroom" class="control-label">'._('Room').'</label>
			<select class="selectpicker form-control" onchange="" id="listroom" selected="">';
				foreach ($roomlist as $elem){
					if ($_GET['room'] == $elem->room_id){
						echo '<option value="'.$elem->room_id.'" selected>'.$elem->room_name.'</option>';
					}
					else {
						echo '<option value="'.$elem->room_id.'">'.$elem->room_name.'</option>';
					}
				}
			echo '
			</select>
		</div>';
	echo '
	</div>
	<br/>
</div>

<div name="infopart" class="col-xs-12"><br/>';
if ($device->protocol_id == 6){
	echo
	'<div class="col-md-6 col-xs-12">
		<div class="input-group">
			<label for="addr" class="input-group-addon">
				<span class="glyphicon glyphicon-hdd" aria-hidden="true"></span>
			</label>
			<input type="text" class="form-control" value="'.$device->addr.'" id="addr" placeholder="'._('IP address or name').'">
		</div>
	
		<div class="input-group">
			<label for="port" class="input-group-addon">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</label>
			<input type="text" class="form-control" value="'.$device->plus1.'" id="port" placeholder="'._('Port').' ('._('Default: 80').')">
		</div>
		<div class="input-group">
			<label for="macaddr" class="input-group-addon">
				<span class="fa flaticon-chip" aria-hidden="true"></span>
			</label>
			<input type="text" class="form-control" value="'.$device->plus4.'" id="macaddr" placeholder="'._('Mac Address').'">
		</div>
	</div>
	<div class="col-md-6 col-xs-12">
		<div class="input-group">
			<label for="login" class="input-group-addon">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</label>
			<input type="text" class="form-control" value="'.$device->plus2.'" id="login" placeholder="'._('Login').'" autocomplete="off">
		</div>
	
		<div class="input-group">
			<label for="pass" class="input-group-addon">
				<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
			</label>
			<input type="password" class="form-control" value="'.$device->plus3.'" id="pass" placeholder="'._('Password').'" autocomplete="off">
		</div>
	</div><br/>';
}
else if ($device->protocol_id == 1){
	echo 
	'<div class="col-md-6 col-xs-12">
		<div class="input-group">
			<label for="addr" class="input-group-addon">
			<span class="glyphicon glyphicon-hdd" aria-hidden="true"></span>
			</label>
			<input type="text" class="form-control" id="addr" value="'.$device->addr.'" placeholder="'._('KNX address or name').'">
		</div>
	</div>';
	if($device->device_id == 30) {
		echo
		'<div class="col-md-6 col-xs-12">
			<div class="input-group">
				<label for="widgetpassword" class="input-group-addon">
				<span class="fa fa-key" aria-hidden="true"></span>
				</label>
				<input type="text" class="form-control" id="widgetpassword" value="'.$device->password.'" placeholder="'._('Widget\'s password').'">
			</div>
		</div>';
	}
}
else if ($device->protocol_id == 2){
	echo
	'<div class="col-md-6 col-xs-12">
		<input type="hidden" class="form-control" id="addr" value="EnOcean" placeholder="'._('Enocean address or name').'">
	</div>';
}
echo '
</div>&nbsp;

<div class="col-xs-12 center">
	<button type="button" id="saveinfo" title="'._('Save').'" class="btn btn-greenleaf" onclick="SaveInfo()">'._('Save').'</button>
</div>

<div class="col-xs-12" name="optionpart">
	<br/>
	<h3>
		'._('Options').'';
		if (sizeof($manufacturerList) > 0) { 
			echo
			'<button class="btn btn-warning margin-left"
			         onclick="PopupPreConfigurationDevice('.$_GET['device'].')"
			         title="Pre-configuration device" type="button">
				<span class="fa fa-cog"></span>
			</button>';
		}
		echo
	'</h3>
	<br/>
	<div class="center">
		<button type="button" title="'._('Save All').'" class="btn btn-greenleaf" onclick="SaveAllOpt()">'._('Save All').'</button>
	</div>';

if (!empty($tabopt) && sizeof($tabopt) > 0){
	
	//KNX
	if ($device->protocol_id != 6) {
		//Generic
		if($device->device_id == 86) {
			echo '
			<table class="table" id="tabopt">
				<thead>
					<tr>
						<th>'._('Option').'</th>
						<th>'._('Write address').'</th>
						<th>'._('Value').'</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>';
			foreach ($tabopt as $i => $elem) {
				if (!empty($tabopt[$i])) {
					echo '
						<tr>
							<td>
								'.$tabopt[$i]['name'].'
							</td>
							<td>
								<input id="waddr-'.$tabopt[$i]['id'].'" class="form-control knx" type="text" placeholder="'._('Write address').'">
							</td>';
					if (isset($exceptionaddress[$tabopt[$i]['id']])) {
						echo
						'<td>
								<input disabled id="raddr-'.$tabopt[$i]['id'].'" class="form-control knx" type="text" placeholder="'._('Value').'">
							</td>';
					}
					else {
						echo
						'<td>
								<input id="raddr-'.$tabopt[$i]['id'].'" class="form-control knx" type="text" placeholder="'._('Value').'">
							</td>';
					}
					echo
					'<td>';
					if (isset($listdpt->$i)) {
						$list = $listdpt->$i;
						if (sizeof($listdpt->$i) == 1){
							echo
							'<div hidden>
										<select disabled class="selectpicker form-control" id="unity-'.$tabopt[$i]['id'].'">
											<option value="'.$list[0]->dpt_id.'"></option>
										</select>
									</div>';
						}
						else {
							echo '<select class="selectpicker form-control" id="unity-'.$tabopt[$i]['id'].'">';
							foreach ($listdpt->$i as $list){
								if (!empty($list->dpt_id)){
									if (!empty($option_overload[$list->option_id]) && !empty($option_overload[$list->option_id][$list->dpt_id])){
										echo '<option value="'.$list->dpt_id.'">'.$option_overload[$list->option_id][$list->dpt_id].'</option>';
									}
									else{
										echo '<option value="'.$list->dpt_id.'">'.$list->unit.'</option>';
									}
								}
							}
							echo '</select>';
						}
					}
					echo
					'</td>
							<td>
								<div class="checkbox">
									<input id="toggle-'.$tabopt[$i]['id'].'"
									       data-on-color="greenleaf"
									       data-label-width="0"
									       data-on-text="'._('Enable').'"
									       data-off-text="'._('Disable').'"
									       type="checkbox">
								</div>
								<script type="text/javascript">
									$("#toggle-'.$tabopt[$i]['id'].'").bootstrapSwitch();
								</script>
							</td>
							<td>
								 <div class="btn-group btn-group-greenleaf center">
									<button data-loading-text="Loading..."
									        type="button"
									        id="saveoption-'.$tabopt[$i]['id'].'"
									        title="'._('Save').'"
									        class="btn btn-greenleaf save"
									        onclick="SaveOption(\''.$tabopt[$i]['id'].'\')">'._('Save').'
									</button>
								</div>
							</td>
						</tr>';
				}
			}
			echo '
				</tbody>
			</table>';
		}
		elseif (!empty($device->application_id)) {
			echo '
			<table class="table" id="tabopt">
				<thead>
					<tr>
						<th>'._('Option').'</th>
						<th>'._('Write address').'</th>
						<th>'._('Return address').'</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>';
				foreach ($tabopt as $i => $elem) {
					if (!empty($tabopt[$i]) && isset($listdpt->$i)) {
						$list = $listdpt->$i;
						echo '
						<tr>
							<td>
								'.$tabopt[$i]['name'].'
							</td>
							<td>
								<input id="waddr-'.$tabopt[$i]['id'].'" class="form-control knx" type="text" placeholder="'._('Write address').'">
							</td>';
						if (isset($exceptionaddress[$tabopt[$i]['id']])) {
							echo
							'<td>
								<input disabled id="raddr-'.$tabopt[$i]['id'].'" class="form-control knx" type="text" placeholder="'._('Return address').'">
							</td>';
						}
						else {
							echo
							'<td>
								<input id="raddr-'.$tabopt[$i]['id'].'" class="form-control knx" type="text" placeholder="'._('Return address').'">
							</td>';
						}
						echo
							'<td>'; 
							
							if (sizeof($list) == 1){
								echo
								'<div hidden>
									<select disabled class="selectpicker form-control" id="unity-'.$tabopt[$i]['id'].'">
										<option value="'.$list[0]->dpt_id.'"></option>
									</select>
								</div>';
							}
							else {
								echo '<select class="selectpicker form-control" id="unity-'.$tabopt[$i]['id'].'">';
								foreach ($list as $list){
									if (!empty($list->dpt_id)){
										if (!empty($option_overload[$list->option_id]) && !empty($option_overload[$list->option_id][$list->dpt_id])){
											echo '<option value="'.$list->dpt_id.'">'.$option_overload[$list->option_id][$list->dpt_id].'</option>';
										}
										else{
											echo '<option value="'.$list->dpt_id.'">'.$list->unit.'</option>';
										}
									}
								}
								echo '</select>';
							}
						echo
							'</td>
							<td>
								<div class="checkbox">
									<input id="toggle-'.$tabopt[$i]['id'].'"
									       data-on-color="greenleaf"
									       data-label-width="0"
									       data-on-text="'._('Enable').'"
									       data-off-text="'._('Disable').'"
									       type="checkbox">
								</div>
								<script type="text/javascript">
									$("#toggle-'.$tabopt[$i]['id'].'").bootstrapSwitch();
								</script>
							</td>
							<td>
								 <div class="btn-group btn-group-greenleaf center">
									<button data-loading-text="Loading..."
									        type="button"
									        id="saveoption-'.$tabopt[$i]['id'].'"
									        title="'._('Save').'"
									        class="btn btn-greenleaf save"
									        onclick="SaveOption(\''.$tabopt[$i]['id'].'\')">'._('Save').'
									</button>
								</div>
							</td>
						</tr>';
					}
				}
				echo '
				</tbody>
			</table>';
		}
		echo
		'<div class="center">
			<button type="button" title="'._('Save All').'" class="btn btn-greenleaf" onclick="SaveAllOpt()">
				'._('Save All').'
			</button>
		</div>';
		echo
		'<script type="text/javascript">';
		foreach ($listoptdevice as $elem) {
			if (!empty($elem->addr)) {
				echo '$("#waddr-'.$elem->option_id.'").val(\''.$elem->addr.'\');';
			}
			if (!empty($elem->addr_plus)) {
				echo '$("#raddr-'.$elem->option_id.'").val(\''.$elem->addr_plus.'\');';
			}
			if (!empty($elem->dpt_id)) {
				echo '$("#unity-'.$elem->option_id.'").selectpicker(\'refresh\');';
				echo '$("#unity-'.$elem->option_id.'").selectpicker(\'val\', \''.$elem->dpt_id.'\');';
			}
			if ($elem->status == 1) {
				echo '$("#toggle-'.$elem->option_id.'").prop(\'checked\', true).change();';
			}
		}
		echo
		'</script>';
	}
	//IP
	else if ($device->protocol_id == 6) {
		//getIcon ???
		$icons = array(
			 12 => 'glyphicon glyphicon-off',
			357 => 'glyphicon glyphicon-chevron-up',
			358 => 'glyphicon glyphicon-chevron-down',
			359 => 'glyphicon glyphicon-chevron-left',
			360 => 'glyphicon glyphicon-chevron-right',
			361 => 'glyphicon glyphicon-home',
			363 => 'glyphicon glyphicon-play',
			364 => 'glyphicon glyphicon-pause',
			365 => 'glyphicon glyphicon-stop',
			366 => 'glyphicon glyphicon-forward',
			367 => 'glyphicon glyphicon-backward',
			368 => 'glyphicon glyphicon-volume-off',
			383 => 'fa fa-volume-up',
			408 => 'glyphicon glyphicon-camera',
			443 => 'glyphicon glyphicon-eject',
			444 => 'fa fa-plus-square-o',
			445 => 'fa fa-plus-square-o',
			446 => 'fa fa-plus-square-o',
			447 => 'fa fa-plus-square-o',
			448 => 'fa fa-plus-square-o',
			449 => 'fa fa-plus-square-o',
			450 => 'fa fa-plus-square-o',
			451 => 'fa fa-plus-square-o',
			452 => 'fa fa-plus-square-o',
			453 => 'fa fa-plus-square-o',
			454 => 'glyphicon glyphicon-unchecked',
			455 => 'fa fa-plus-square-o red',
			456 => 'fa fa-plus-square-o green',
			457 => 'fa fa-plus-square-o blue',
			458 => 'fa fa-plus-square-o yellow',
			459 => 'fa fa-caret-up',
			460 => 'fa fa-caret-down',
			461 => 'fa fa-caret-left',
			462 => 'fa fa-caret-right',
			463 => 'glyphicon glyphicon-plus',
			464 => 'glyphicon glyphicon-minus',
			465 => 'glyphicon glyphicon-plus',
			466 => 'glyphicon glyphicon-minus',
			467 => 'glyphicon glyphicon-record',
			468 => 'fa fa-backward',
			469 => 'fa fa-forward',
			470 => 'glyphicon glyphicon-unchecked'
		);
		
		echo
		'<table class="table" id="tabopt">
			<thead>
				<tr>
					<th>'._('Option').'</th>
					<th>'._('Source').'</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>';
		foreach ($tabopt as $i => $elem){
			if (!empty($tabopt[$i]) && !empty($listdpt->$i)) {
				$list = $listdpt->$i;
				echo
				'<tr>
					<td>';
						if (!empty($icons[$i])){
							echo '<span class="'.$icons[$i].'"></span>&nbsp&nbsp';
						}
						echo $tabopt[$i]['name'].'
					</td>
					<td><input id="waddr-'.$tabopt[$i]['id'].'" class="form-control" type="text" placeholder="'._('Source').'"></td>
					<td>';
					if (sizeof($listdpt->$i) == 1){
						echo
						'<div hidden>
							<select disabled class="selectpicker form-control" id="unity-'.$tabopt[$i]['id'].'">
								<option value="'.$list[0]->dpt_id.'"></option>
							</select>
						</div>';
					}
					else {
						echo '<select class="selectpicker form-control" id="unity-'.$tabopt[$i]['id'].'">';
							foreach ($listdpt->$i as $list){
								if (!empty($list->dpt_id)){
									if (!empty($option_overload[$list->option_id]) && !empty($option_overload[$list->option_id][$list->dpt_id])){
										echo '<option value="'.$list->dpt_id.'">'.$option_overload[$list->option_id][$list->dpt_id].'</option>';
									}
									else{
										echo '<option value="'.$list->dpt_id.'">'.$list->unit.'</option>';
									}
								}
							}
						echo
						'</select>';
					}
					echo
					'</td>
					<td class="center">
						<div class="checkbox">
							<label>
								<input id="toggle-'.$tabopt[$i]['id'].'"
								       data-on-color="greenleaf"
		 						       data-label-width="0"
								       data-on-text="'._('Enable').'"
								       data-off-text="'._('Disable').'"
								       type="checkbox">
							 </label>
						<div>
						<script type="text/javascript">
							$("#toggle-'.$tabopt[$i]['id'].'").bootstrapSwitch();
						</script>
					</td>
					<td>
						<div class="btn-group btn-group-greenleaf center">
							<button type="button" id="saveoption-'.$tabopt[$i]['id'].'"
							        title="'._('Save').'" class="btn btn-greenleaf save"
							        onclick="SaveOption(\''.$tabopt[$i]['id'].'\')">
								'._('Save').'
							</button>
						</div>
					</td>
				</tr>';
			}
		}
		echo
			'</tbody>
		</table>
		<div class="center">
			<button type="button" title="'._('Save All').'" class="btn btn-greenleaf" onclick="SaveAllOpt()">
				'._('Save All').'
			</button>
		</div>';
		
		echo
		'<script type="text/javascript">';
		foreach ($listoptdevice as $elem) {
			if (!empty($elem->addr)) {
				echo '$("#waddr-'.$elem->option_id.'").val(\''.$elem->addr.'\');';
			}
			if (!empty($elem->dpt_id)) {
				echo '$("#unity-'.$elem->option_id.'").selectpicker(\'refresh\');';
				echo '$("#unity-'.$elem->option_id.'").selectpicker(\'val\', \''.$elem->dpt_id.'\');';
			}
			if ($elem->status == 1) {
				echo '$("#toggle-'.$elem->option_id.'").prop(\'checked\', true).change();';
			}
		}
		echo
		'</script>';
	}
}
echo
'<br/></div>

<script type="text/javascript">

$(document).ready(function(){
	activateMenuElem(\'install\');
});

function LoadingButton(id, status){
	if (status == 1){
		$("#"+id).addClass("m-progress");
	}
	else if (status == 0){
		setTimeout(function(){
			$("#"+id).removeClass("m-progress");
		}, 1000);
	}
}

function SaveInfo(){
	LoadingButton("saveinfo", 1);
	var idroomdevice = $("#listroom").val();
	var devname = $("#devicename").val();
	var daemon = $("#listdaemon").val();
	var addr = $("#addr").val();
	var login = $("#login").val();
	var pass = $("#pass").val();
	var port = $("#port").val();
	var macaddr = $("#macaddr").val();
	var widgetpassword = $("#widgetpassword").val();
	
	if (!daemon){
		daemon = 0;
	}
	if (!login){
		login = "";
	}
	if (!pass){
		pass = "";
	}
	if (port == ""){
		port = 80;
	}
	else if (!port){
		port = "";
	}
	if (!macaddr){
		macaddr = "";
	}
	if (!widgetpassword){
		widgetpassword = "";
	}
	if (devname != \'\' && addr != \'\'){
		$.ajax({
			type:"GET",
			url: "/form/form_device_info_opt.php",
			data: "idroomdevice="+idroomdevice+
			      "&devname="+encodeURIComponent(devname)+"&daemon="+daemon+
			      "&addr="+addr+"&iddevice="+'.$_GET['device'].'+"&port="+port+
			      "&login="+login+"&pass="+pass+"&macaddr="+macaddr+
			      "&widgetpassword="+widgetpassword,
			complete: function(result, status) {
				LoadingButton("saveinfo", 0);
			}
		});
	}
	else {
		// alert error
	}
}

function CheckAddr(addr, addr_plus, optid){
	var protoopt = '.$device->protocol_id.';

	if (protoopt == 1 && $("#toggle-"+optid).prop(\'checked\') == 1){
		var tabaddr = addr.split("/");
		var tabaddr_plus = addr_plus.split("/");
		
		if (tabaddr.length == 3){
			if (!$.isNumeric(tabaddr[0]) || !$.isNumeric(tabaddr[1]) || !$.isNumeric(tabaddr[2])) {
				$("#waddr-"+optid).css("background", "#EAB2B8");
				return false;
			}		
		}
		else {
			$("#waddr-"+optid).css("background", "#EAB2B8");
			return false;
		}
	
		if (addr_plus != "" && !$("#raddr-"+optid).is("select")){
			if (tabaddr_plus.length == 3){
				if (!$.isNumeric(tabaddr_plus[0]) || !$.isNumeric(tabaddr_plus[1]) || !$.isNumeric(tabaddr_plus[2])) {
					$("#raddr-"+optid).css("background", "#EAB2B8");
					return false;
				}		
			}
			else {
				$("#raddr-"+optid).css("background", "#EAB2B8");
				return false;
			}
		}
	}			
	return true;
}

function PopupPreConfigurationDevice(device_id){
	$.ajax({
		type: "GET",
		url: "/templates/'.TEMPLATE.'/popup/popup_pre_configuration_device.php",
		data: "device_id="+device_id,
		success: function(result) {
			BootstrapDialog.show({
				title: "'._('Pre-configuration device').'",
				message: result
			});
		}
	});
}

function ProductList(device_id, protocol_id){
	var manufacturer_id = $("#manufacturerList").val();

	$.ajax({
		type: "GET",
		url: "/templates/'.TEMPLATE.'/form/form_pre_configuration_device.php",
		data: "device_id="+device_id+"&manufacturer_id="+manufacturer_id,
		success: function(result) {
			$("#div-productList").html(result);
			$(".selectpicker").selectpicker();
			$(".selectpicker").selectpicker(\'refresh\');
		}
	});
}

function PreConfigurationDevice(){
	var product_id = $("#productList").val();
	var password   = $("#pass").val();
	if (product_id > 0){
		$.ajax({
			type: "GET",
			url: "/form/form_pre_configuration_device_option.php",
			data: "product_id="+product_id+"&password="+password,
			dataType: "json",
			success: function(result) {
				for (var i = 0 ; i < result.length ; i++){
					$("#waddr-"+result[i].option_id).val(result[i].addr);
					$("#unity-"+result[i].option_id).val(result[i].dpt_id);
					$("#toggle-"+result[i].option_id).prop(\'checked\', true).change();
				}
				popup_close();
			}
		});
	}
}

function SaveAllOpt(){
	$("#tabopt tbody .save").each(function(index){
		$(this).click();
	});	
}

function SaveOption(optid){
	LoadingButton("saveoption-"+optid, 1);
	var idroomdevice = '.$_GET['device'].';
	var status = $("#toggle-"+optid).prop(\'checked\');
	var addr = $("#waddr-"+optid).val();
	var addr_plus = $("#raddr-"+optid).val();
	var dpt_id = $("#unity-"+optid).val();
	
	if (!addr){
		addr = "";
	}
	if (!addr_plus){
		addr_plus = "";
	}
	if (!dpt_id) {
		dpt_id = 1;
	}
	';
	if($device->device_id == 86) {
		echo '
		if (CheckAddr(addr, "", optid)){';
	}
	else {
		echo '
		if (CheckAddr(addr, addr_plus, optid)){';
	}
	echo '
		$.ajax({
			type:"GET",
			url: "/form/form_device_info_opt.php",
			data: "idroomdevice="+encodeURIComponent(idroomdevice)
			     +"&opt="+encodeURIComponent(optid)
			     +"&addr="+encodeURIComponent(addr)
			     +"&addr_plus="+encodeURIComponent(addr_plus)
			     +"&dpt_id="+encodeURIComponent(dpt_id)
			     +"&status="+encodeURIComponent(status),
			complete: function(result, status) {
				LoadingButton("saveoption-"+optid, 0);
			}
		});
	}
	else {
		LoadingButton("saveoption-"+optid, 0);
	}
}
		
function GetRoomByFloor(){
	var idfloor = $("#listfloor").val();
		
	$.ajax({
		type:"GET",
		url: "/templates/'.TEMPLATE.'/form/form_conf_device_room.php",
		data: "floor="+idfloor,
		success: function(result) {
			$("#listroom").html(result);
			$(".selectpicker").selectpicker(\'refresh\');
		},
		error: function(result, status, error){
			location.href=\'/conf_installation/'.$_GET['floor'].'/'.$_GET['room'].'/'.$_GET['device'].'\';
		}
	});
}';

echo '
$(".knx").on("click", function() {
	$(this).css("background", "#FFFFFF");
})
	
</script>';

?>