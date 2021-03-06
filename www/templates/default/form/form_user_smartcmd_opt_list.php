<?php 

include('header.php');

if (!empty($_GET['room_id_device']) || !empty($_GET['id_smartcmd'])) {
	$request =  new Api();
	$request -> add_request('mcDeviceInfo', array($_GET['room_id_device']));
	$request -> add_request('confDeviceRoomOpt', array($_GET['room_id_device']));
	$request -> add_request('countElemSmartcmd', array($_GET['id_smartcmd']));
	
	$result  =  $request -> send_request();
	$mcDeviceInfo = $result->mcDeviceInfo;
	$listoptdevice = $result->confDeviceRoomOpt;
	$idexec = $result->countElemSmartcmd + 1;
	if (empty($listoptdevice)) {
		return;
	}
	$display_rgb = '';
	foreach ($listoptdevice as $option) {
		$option_id = $option->option_id;
		
		if (($option_id == 392 || $option_id == 393 || $option_id == 394 || $option_id == 410)) { //RGBW
			if ($option_id == 410) {
				$display_rgb =
				'<li class="list-item">
					<div id="btn-option-'.$_GET['room_id_device'].'" class="box-scenar-devices cursor btn-draggable"
					     onclick="onclickDropNewElem('.$_GET['id_smartcmd'].', '.$_GET['room_id_device'].', 410, '.$idexec.')">
						<input type="text" value="410" hidden>
						'._('RGBW').'
					</div>
				</li>';
			}
			else if (empty($display_rgb)) { //RGB
				$display_rgb =
				'<li class="list-item">
					<div id="btn-option-'.$_GET['room_id_device'].'" class="box-scenar-devices cursor btn-draggable"
					     onclick="onclickDropNewElem('.$_GET['id_smartcmd'].', '.$_GET['room_id_device'].', 392, '.$idexec.')">
						<input type="text" value="392" hidden>
						'._('RGB').'
					</div>
				</li>';
			}
		}
		elseif($option->function_writing > 0) {
			echo '
				<li class="list-item">
					<div id="btn-option-'.$_GET['room_id_device'].'" class="box-scenar-devices cursor btn-draggable"
					     onclick="onclickDropNewElem('.$_GET['id_smartcmd'].', '.$_GET['room_id_device'].', '.$option_id.', '.$idexec.')">
						<input type="text" value="'.$option_id.'" hidden>
						'.$option->name.'
					</div>
				</li>';
		}
	}
	echo $display_rgb;
	
	echo '
		<script type="text/javascript">
			$(".btn-draggable").draggable({
				appendTo: "#drop-smartcmd",
				helper: "clone",
				revert: "invalid",
				start: function() {
					dropZoneAnimate();
				},
				stop: function() {
					dropZoneStop();
				}
			});
		</script>';
			
}
?>