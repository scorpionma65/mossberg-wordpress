<script type="text/javascript">
function display_actions(clear) {
	if(clear) { 
		clear_actions();
	}
	jQuery('[id^=firearm_action_]').hide();
	jQuery('#firearm_model').hide();
	jQuery('#firearm_ammo').hide();
	jQuery('#firearm_issue').hide();
	if(jQuery('#firearm_type').val()) {
		var type = jQuery('#firearm_type').val().toLowerCase();
		var type = type.replace(/[\W_]+/g,"_");
		jQuery('#firearm_action_'+type).show();
	}
}
function display_models(clear) {
	if(clear) { 
		clear_models();
	}
	jQuery('[id^=firearm_model_]').hide();
	jQuery('#firearm_ammo').hide();
	jQuery('#firearm_issue').hide();
	if(jQuery('#firearm_type').val()) {
		var type = jQuery('#firearm_type').val().toLowerCase();
		var type = type.replace(" ", "_");
		if(jQuery('#firearm_action_'+type).val()) {
			var action = jQuery('#firearm_action_'+type).val().toLowerCase();
			var action = action.replace(/[\W_]+/g,"_");
			jQuery('#firearm_model').show();
			jQuery('#firearm_model_'+type+'_'+action).show();
		}
	}
}
function display_ammo(clear) {
	if(clear) { 
		clear_ammo();
	}
	jQuery('[id^=firearm_ammo_]').hide();
	jQuery('#firearm_issue').hide();
	if(jQuery('#firearm_type').val()) {
		var type = jQuery('#firearm_type').val().toLowerCase();
		var type = type.replace(" ", "_");
		if(jQuery('#firearm_action_'+type).val()) {
			var action = jQuery('#firearm_action_'+type).val().toLowerCase();
			var action = action.replace(/[\W_]+/g,"_");
			if(jQuery('#firearm_model_'+type+'_'+action).val()) {
				var model = jQuery('#firearm_model_'+type+'_'+action).val().toLowerCase();
				var model = model.replace(/[\W_]+/g,"_");
				jQuery('#firearm_ammo').show();
				jQuery('#firearm_ammo_'+model).show();
			}
		}
	}
}
function display_issues(clear) {
	if(clear) { 
		clear_issues();
	}
	jQuery('[id^=firearm_issue_]').hide();
	if(jQuery('#firearm_type').val()) {
		var type = jQuery('#firearm_type').val().toLowerCase();
		var type = type.replace(/[\W_]+/g,"_");
		if(jQuery('#firearm_action_'+type).val()) {
			var action = jQuery('#firearm_action_'+type).val().toLowerCase();
			var action = action.replace(/[\W_]+/g,"_");
			jQuery('#firearm_issue').show();
			jQuery('#firearm_issue_'+type+'_'+action).show();
		}
	}
}
function clear_actions() {
	jQuery('[id^=firearm_action_]').val('');
	jQuery('[id^=firearm_model_]').val('');
	jQuery('[id^=firearm_ammo_]').val('');
	jQuery('[id^=firearm_issue_]').find('input[type=checkbox]:checked').removeAttr('checked');
}
function clear_models() {
	jQuery('[id^=firearm_model_]').val('');
	jQuery('[id^=firearm_ammo_]').val('');
	jQuery('[id^=firearm_issue_]').find('input[type=checkbox]:checked').removeAttr('checked');
}
function clear_ammo() {
	jQuery('[id^=firearm_ammo_]').val('');
	jQuery('[id^=firearm_issue_]').find('input[type=checkbox]:checked').removeAttr('checked');
}
function clear_issues() {
	jQuery('[id^=firearm_issue_]').find('input[type=checkbox]:checked').removeAttr('checked');
}
function display_contact() {
	jQuery('#contact_dealer').hide();	
	jQuery('#contact_dealer_owner').hide();
	jQuery('#contact_owner').hide();
	jQuery('#contact_primary').hide();
	jQuery('#contact_purchase').hide();	
	var type = jQuery('#dealer_owner').val().toLowerCase();
	if(type == 'dealer') {
		jQuery('#contact_dealer').show();
		jQuery('#contact_primary').show();	
	}
	if(type == 'firearm owner') {
		jQuery('#contact_owner').show();
		jQuery('#contact_purchase').show();	
		jQuery('#primary_contact').val('');
	}
}
function display_primary() {
	jQuery('#contact_dealer_owner').hide();
	var type = jQuery('#primary_contact').val().toLowerCase();
	if(type == 'firearm owner') {
		jQuery('#contact_dealer_owner').show();
	}
}
function display_shipnote() {
	jQuery('#shipnote').hide();
	var type = jQuery('#firearm_shipped').val();
	if(type != 'Complete Firearm') {
		jQuery('#shipnote').show();
	}
}
function processing() {
	jQuery('#submit').hide();
	jQuery('#submitnote').hide();
	jQuery('#processing').show();
}
// Preset
jQuery(document).ready(function() {
	display_actions();
	display_models();
	display_ammo();
	display_issues();
	display_contact();
	display_primary();
	display_shipnote();	
});
</script>

<?php 
// Build Subtypes
function build_actions($type, $options) {
	echo "<select name=\"$type\" id=\"$type\" class=\"form_dropdown\" style=\"display:none;\" onchange=\"display_models(1)\">
	<option value=\"\">Select Action</option>";
	foreach($options as $key => $value) {
		echo "<option value=\"$value\" ";
		if($_POST[$type]==$value) { 
			echo "selected=\"selected\"";
		}
		echo ">$value</option>";
	}
	echo "</select>";		
}
// Build Models
function build_models($type, $options) {
	echo "<select name=\"$type\" id=\"$type\" class=\"form_dropdown\" style=\"display:none;\" onchange=\"display_ammo(1)\">
	<option value=\"\">Select Model</option>";
	foreach($options as $key => $value) {
		echo "<option value=\"$value\" ";
		if($_POST[$type]==$value) { 
			echo "selected=\"selected\"";
		}
		echo ">$value</option>";
	}
	echo "</select>";		
}
// Build Ammo
function build_ammo($type, $options) {
	echo "<select name=\"$type\" id=\"$type\" class=\"form_dropdown\" style=\"display:none;\" onchange=\"display_issues(1)\">
	<option value=\"\">Select Gauge/Caliber</option>";
	foreach($options as $key => $value) {
		echo "<option value=\"$value\" ";
		if($_POST[$type]==$value) { 
			echo "selected=\"selected\"";
		}
		echo ">$value</option>";
	}
	echo "<option value=\"Other\" ";
	if($_POST[$type]=="Other") { 
		echo "selected=\"selected\"";
	}
	echo ">Other</option>";
	echo "</select>";		
}
// Build Issues
function build_issues($type, $options, $issues) {
	echo "<div id=\"$type\" style=\"display:none;\">";
	foreach($options as $key => $value) {
		$field = $type.'_'.$value;
		echo "<div class=\"form_column\"><input name=\"$field\" type=\"checkbox\" value=\"$issues[$value]\"";
		if(isset($_POST[$field])) {
			echo " checked=\"checked\"";
		}
		echo "/> $issues[$value]</div>";
	}
	echo "</div>";	
}
// Set Issues
function set_issues($issues, $type) {
	$firearm_issues = array();
	foreach($issues as $key => $value) {
		$issue_field = $type.'_'.$key;
		if(isset($_POST[$issue_field])) {
			$firearm_issues[] = $value;
		}
	}
	return($firearm_issues);
}
?>

<?php
// Setup
$message = NULL;
$show = TRUE;

// Issues
$issues = array(
'0'=>'Failure to Fire',
'1'=>'Failure to Extract Shell from Chamber',
'2'=>'Failure to Eject Shell from Receiver',
'3'=>'Failure to Feed Shell from Magazine',
'4'=>'Not Loading into Magazine',
'6'=>'Dropping Shells/Double Feed',
'7'=>'Double Firing',
'8'=>'Gun Not Cycling',
'9'=>'Cosmetic',
'10'=>'Stock',
'11'=>'Forearm',
'12'=>'Action Binds',
'13'=>'Sights',
'14'=>'Choke Tube',
'16'=>'Trigger',
'17'=>'Firing Pin',
'18'=>'Bolt Handle',
'19'=>'Lever',
'20'=>'Accuracy',
'21'=>'Can Only Load 2 Shells',
'22'=>'Can Only Load 1 Shell',
'23'=>'Lost Key to Gun Lock',
'25'=>'Charging Handle',
'25'=>'Charging Handle',
'27'=>'Magazine Won\'t Drop',
'28'=>'Magazine Won\'t Stay In',
'26'=>'Other');

// Submit
if(isset($_POST['submit'])) {
	// Firearm Shipped
	$firearm_shipped = sanitize_text_field($_POST['firearm_shipped']);	
	// Serial
	$serial_number = sanitize_text_field($_POST['serial_number']);
	if(!$serial_number) {
		if($firearm_shipped == 'Complete Firearm') {
			$message .= "<p class=\"form_message_fail\">Please enter the Serial Number. Required when shipping complete firearm.</p>";
			} else {
			$serial_number = '-';
		}
	}
	// Firearm
	$firearm_check = TRUE;
	// Type
	$firearm_type = sanitize_text_field($_POST['firearm_type']);
	if(!$firearm_type) {
		$firearm_check = FALSE;
		} else {
		switch($firearm_type) {
			// Shotgun
			case 'Shotgun':
			$firearm_action = sanitize_text_field($_POST['firearm_action_shotgun']);
			if(!$firearm_action) {
				$firearm_check = FALSE;
				} else {
				switch($firearm_action) {
					// Pump Action
					case 'Pump Action':
					$firearm_model = sanitize_text_field($_POST['firearm_model_shotgun_pump_action']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// 500
							case '500':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_500']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_pump_action');								
							}
							break;
							// 590
							case '590':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_590']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_pump_action');
							}
							break;							
							// 590A1
							case '590A1':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_590a1']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_pump_action');
							}
							break;						
							// 535
							case '535':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_535']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_pump_action');
							}
							break;					
							// 835
							case '835':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_835']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_pump_action');
							}
							break;					
							// Maverick 88
							case 'Maverick 88':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_maverick_88']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_pump_action');
							}
							break;				
							// 505
							case '505':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_505']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_pump_action');
							}
							break;			
							// 510
							case '510':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_510']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_pump_action');
							}
							break;		
							// 510
							case 'Maverick 91':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_maverick_91']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_pump_action');
							}
							break;
						}					
					}
					break;
					// Break Action
					case 'Break Action':
					$firearm_model = sanitize_text_field($_POST['firearm_model_shotgun_break_action']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// Silver Reserve
							case 'Silver Reserve':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_silver_reserve']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_break_action');
							}
							break;
							// Maverick O/U
							case 'Maverick O/U':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_maverick_o_u']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_break_action');
							}
							break;
						}
					}
					break;
					// Semi Auto
					case 'Semi-Auto':
					$firearm_model = sanitize_text_field($_POST['firearm_model_shotgun_semi_auto']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// 935
							case '935':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_935']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_semi_auto');
							}
							break;
							// 930
							case '930':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_930']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_semi_auto');
							}
							break;
							// SA-20
							case 'SA-20':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_sa_20']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_semi_auto');
							}
							break;
							// SA-28
							case 'SA-28':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_sa_28']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_semi_auto');
							}
							break;
							// 9200
							case '9200':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_9200']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_semi_auto');
							}
							break;
						}
					}
					break;
					// Bolt Action
					case 'Bolt Action':
					$firearm_model = sanitize_text_field($_POST['firearm_model_shotgun_bolt_action']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// 695
							case '695':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_695']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_shotgun_bolt_action');
							}
							break;
						}					
					}
					break;
				}					
			}
			break;
			// Centerfire Rifle
			case 'Centerfire Rifle':
			$firearm_action = sanitize_text_field($_POST['firearm_action_centerfire_rifle']);
			if(!$firearm_action) {
				$firearm_check = FALSE;
				} else {
				switch($firearm_action) {
					// Bolt Action
					case 'Bolt Action':
					$firearm_model = sanitize_text_field($_POST['firearm_model_centerfire_rifle_bolt_action']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// Patriot
							case 'Patriot':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_patriot']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_centerfire_rifle_bolt_action');
							}
							break;
							// MVP
							case 'MVP':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_mvp']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_centerfire_rifle_bolt_action');
							}
							break;
							// ATR
							case 'ATR':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_atr']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_centerfire_rifle_bolt_action');
							}
							break;
							// 4X4
							case '4X4':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_4x4']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_centerfire_rifle_bolt_action');
							}
							break;
							// Maverick Rifle
							case 'Maverick Rifle':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_maverick_rifle']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_centerfire_rifle_bolt_action');
							}
							break;
						}										
					}
					break;
					// Lever Action
					case 'Lever Action':
					$firearm_model = sanitize_text_field($_POST['firearm_model_centerfire_rifle_lever_action']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// 464 Centerfire
							case '464 Centerfire':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_464_centerfire']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_centerfire_rifle_lever_action');
							}
							break;
						}
					}
					break;
					// Semi Auto
					case 'Semi-Auto':
					$firearm_model = sanitize_text_field($_POST['firearm_model_centerfire_rifle_semi_auto']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// MMR
							case 'MMR':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_mmr']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_centerfire_rifle_semi_auto');
							}
							break;
						}
					}
					break;
				}
			}
			break;
			// Rimfire Rifle
			case 'Rimfire Rifle':
			$firearm_action = sanitize_text_field($_POST['firearm_action_rimfire_rifle']);
			if(!$firearm_action) {
				$firearm_check = FALSE;
				} else {
				switch($firearm_action) {
					// Bolt Action
					case 'Bolt Action':
					$firearm_model = sanitize_text_field($_POST['firearm_model_rimfire_rifle_bolt_action']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// 801 Half Pint
							case '801 Half Pint':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_801_half_pint']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_rimfire_rifle_bolt_action');
							}
							break;
							// 802 Plinkster
							case '802 Plinkster':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_802_plinkster']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_rimfire_rifle_bolt_action');
							}
							break;
							// 817 HMR
							case '817 HMR':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_817_hmr']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_rimfire_rifle_bolt_action');
							}
							break;
						}
					}
					break;
					// Lever Action
					case 'Lever Action':
					$firearm_model = sanitize_text_field($_POST['firearm_model_rimfire_rifle_lever_action']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// 464 Rimfire
							case '464 Rimfire':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_464_rimfire']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_rimfire_rifle_lever_action');
							}
							break;
						}
					}
					break;
					// Semi Auto
					case 'Semi-Auto':
					$firearm_model = sanitize_text_field($_POST['firearm_model_rimfire_rifle_semi_auto']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// Blaze
							case 'Blaze':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_blaze']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_rimfire_rifle_semi_auto');
							}
							break;
							// Blaze 47
							case 'Blaze 47':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_blaze_47']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_rimfire_rifle_semi_auto');
							}
							break;
							// 702 Plinkster
							case '702 Plinkster':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_702_plinkster']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_rimfire_rifle_semi_auto');
							}
							break;
							// 715T Plinkster
							case '715T Plinkster':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_715t_plinkster']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_rimfire_rifle_semi_auto');
							}
							break;
						}
					}
					break;
				}
			}
			break;
			// Handgun
			case 'Pistol':
			$firearm_action = sanitize_text_field($_POST['firearm_action_pistol']);
			if(!$firearm_action) {
				$firearm_check = FALSE;
				} else {
				switch($firearm_action) {
					// Semi Auto
					case 'Semi-Auto':
					$firearm_model = sanitize_text_field($_POST['firearm_model_pistol_semi_auto']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// 715P
							case '715P':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_715p']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_pistol_semi_auto');
							}
							break;
						}
					}
					break;
				}
			}
			break;
			// Pistol
			case 'Handgun':
			$firearm_action = sanitize_text_field($_POST['firearm_action_handgun']);
			if(!$firearm_action) {
				$firearm_check = FALSE;
				} else {
				switch($firearm_action) {
					// Semi Auto
					case 'Semi-Auto':
					$firearm_model = sanitize_text_field($_POST['firearm_model_handgun_semi_auto']);
					if(!$firearm_model) {
						$firearm_check = FALSE;
						} else {
						switch($firearm_model) {
							// MC1sc
							case 'MC1sc':
							$firearm_ammo = sanitize_text_field($_POST['firearm_ammo_mc1sc']);
							if(!$firearm_ammo) {
								$firearm_check = FALSE;
								} else {
								$firearm_issues = set_issues($issues,'firearm_issue_handgun_semi_auto');
							}
							break;
						}
					}
					break;
				}
			}
			break;
		}
	}
	// Firearm Type
	if(!$firearm_check) {
		$message .= "<p class=\"form_message_fail\">Please select the Firearm Type including the Action, Model, Gauge/Caliber</p>";
	}
	// Firearm Issue
	//$issue_detail = sanitize_text_field($_POST['issue_detail']);
	//if(!$issue_detail) {
	//	$message .= "<p class=\"form_message_fail\">Please describe the Issue(s) you are experiencing.</p>";
	//}
	// Primary Issues
	if(!$firearm_issues) {
		$message .= "<p class=\"form_message_fail\">Please select at least one Firearm Issue.</p>";
		} else {
		$primary_issues = implode(', ',$firearm_issues);
	}
	// Contact
	$dealer_owner = sanitize_text_field($_POST['dealer_owner']);
	if(!$dealer_owner) {
		$message .= "<p class=\"form_message_fail\">Please select if your are a Dealer or the Firearm Owner.</p>";
	}
	// Primary Contact
	$primary_contact = 'Firearm Owner';
	$email_cc = NULL;
	if($dealer_owner == 'Dealer') {
		$primary_contact = sanitize_text_field($_POST['primary_contact']);
		if(!$primary_contact) {
			$message .= "<p class=\"form_message_fail\">Please select who (Dealer or Firearm Owner) will be the Primary Contact on this repair.</p>";
		}
	}	
	// Purchase Date
	$purchase_date = '-';
	$purchase_month = sanitize_text_field($_POST['purchase_month']);
	$purchase_year = sanitize_text_field($_POST['purchase_year']);
	if($purchase_month && $purchase_year) {
		$purchase_date = $purchase_month.'-'.$purchase_year;
		} else {
		if($purchase_year) {
			$purchase_date = $purchase_year;
		}
	}
	// Dealer
	if($dealer_owner == 'Dealer') {
		
		// Data Format
		$format_check = TRUE;
		
		// Dealer Company
		$dealer_company_name = sanitize_text_field($_POST['dealer_company_name']);
		if(!$dealer_company_name) {
			$message .= "<p class=\"form_message_fail\">Please enter the Dealer Company Name.</p>";
		}
		// Dealer Name
		$dealer_contact_first_name = sanitize_text_field($_POST['dealer_contact_first_name']);
		if(!$dealer_contact_first_name) {
			$message .= "<p class=\"form_message_fail\">Please enter the Dealer Contact First Name.</p>";
		}
		$dealer_contact_last_name = sanitize_text_field($_POST['dealer_contact_last_name']);
		if(!$dealer_contact_last_name) {
			$message .= "<p class=\"form_message_fail\">Please enter the Dealer Contact Last Name.</p>";
		}
		$dealer_contact_name = FALSE;
		if($dealer_contact_first_name && $dealer_contact_last_name) {
			$dealer_contact_name = $dealer_contact_first_name.' '.$dealer_contact_last_name;
		}
		// Dealer Address
		$dealer_address = sanitize_text_field($_POST['dealer_address']);
		if(!$dealer_address) {
			$message .= "<p class=\"form_message_fail\">Please enter the Dealer Street Address.</p>";
			} else {
			$po = array('po box', 'p.o. box', 'po. box', 'p.o box', 'pobox', 'p o box');
			foreach($po as $key => $value) {
				if (strpos(strtolower($dealer_address), $value) !== FALSE) {
					$dealer_address = FALSE;
					$message .= "<p class=\"form_message_fail\">Please update the Dealer Street Address - no PO Boxes accepted.</p>";
				}
			}
		}
		// Dealer City
		$dealer_city = sanitize_text_field($_POST['dealer_city']);
		if(!$dealer_city) {
			$message .= "<p class=\"form_message_fail\">Please enter the Dealer City.</p>";
		}
		// Dealer State
		$dealer_state = sanitize_text_field($_POST['dealer_state']);
		if(!$dealer_state) {
			$message .= "<p class=\"form_message_fail\">Please enter the Dealer State.</p>";
		}
		// Dealer Zip
		$dealer_zip = preg_replace("/[^0-9]/", "", sanitize_text_field($_POST['dealer_zip']));
		if(!$dealer_zip || strlen($dealer_zip) != 5) {
			$dealer_zip = FALSE;
			$format_check = FALSE;
			$message .= "<p class=\"form_message_fail\">Please enter the Dealer Zip Code in 5-digit format.</p>";
		}		
		// Dealer Email
		$dealer_email = sanitize_text_field($_POST['dealer_email']);
		$email_contact = $dealer_email;
		if(!$dealer_email) {
			$message .= "<p class=\"form_message_fail\">Please enter the Dealer Email Address.</p>";
			} else {
			if(!filter_var($dealer_email, FILTER_VALIDATE_EMAIL)) {
				$dealer_email = FALSE;
				$email_contact = FALSE;
				$format_check = FALSE;
				$message .= "<p class=\"form_message_fail\">Please check the Dealer Email Address. Email format is invalid.</p>";
			}				
		}
		// Dealer Phone
		$dealer_phone = preg_replace("/[^0-9]/", "", sanitize_text_field($_POST['dealer_phone']));
		if(!$dealer_phone || strlen($dealer_phone) != 10) {
			$dealer_phone = FALSE;
			$format_check = FALSE;
			$message .= "<p class=\"form_message_fail\">Please enter the Dealer Phone Number in 10-digit format (ie 5551234567).</p>";
		}
		// Dealer FFL
		if(empty($_FILES['dealer_ffl']['name'])) {
			$dealer_ffl = NULL;
			$upload = FALSE;
			$upload_check = TRUE;
			} else {
			$upload = TRUE;
		}
				
		// Primary Check
		$primary_check = TRUE;
		if($primary_contact == 'Firearm Owner') {
			
			// Owner Name
			$owner_first_name = sanitize_text_field($_POST['dealer_owner_first_name']);
			if(!$owner_first_name) {
				$message .= "<p class=\"form_message_fail\">Please enter the Firearm Owner First Name.</p>";
				$primary_check = FALSE;
			}
			$owner_last_name = sanitize_text_field($_POST['dealer_owner_last_name']);
			if(!$owner_last_name) {
				$message .= "<p class=\"form_message_fail\">Please enter the Firearm Owner Last Name.</p>";
				$primary_check = FALSE;
			}
			$owner_name = FALSE;
			if($owner_first_name && $owner_last_name) {
				$owner_name = $owner_first_name.' '.$owner_last_name;
			}
			// Owner Email
			$owner_email = sanitize_text_field($_POST['dealer_owner_email']);
			if($owner_email) {
				$email_cc = $owner_email;
			}
			if($owner_email && !filter_var($owner_email, FILTER_VALIDATE_EMAIL)) {
				$email_cc = NULL;
				$owner_email = FALSE;
				$format_check = FALSE;
				$message .= "<p class=\"form_message_fail\">Please check the Owner Email Address. Email format is invalid.</p>";
			}
			// Owner Phone
			$owner_phone = preg_replace("/[^0-9]/", "", sanitize_text_field($_POST['dealer_owner_phone']));
			if($owner_phone && @strlen($owner_phone) != 10) {
				$owner_phone = FALSE;
				$format_check = FALSE;
				$message .= "<p class=\"form_message_fail\">Please enter the Owner Phone Number in 10-digit format (ie 5551234567).</p>";
			}			
			// Owner Contact
			$owner_contact = TRUE;
			if(!$owner_email && !$owner_phone) {
				$message .= "<p class=\"form_message_fail\">Please enter the the Owner Email Address or Phone Number in 10-digit format (ie 5551234567).</p>";
				$primary_check = FALSE;
			}
		}
	}
	// Owner
	if($dealer_owner == 'Firearm Owner') {

		// Data Format
		$format_check = TRUE;
		
		// Owner Name
		$owner_first_name = sanitize_text_field($_POST['owner_first_name']);
		if(!$owner_first_name) {
			$message .= "<p class=\"form_message_fail\">Please enter the Firearm Owner First Name.</p>";
		}
		$owner_last_name = sanitize_text_field($_POST['owner_last_name']);
		if(!$owner_last_name) {
			$message .= "<p class=\"form_message_fail\">Please enter the Firearm Owner Last Name.</p>";
		}
		$owner_name = FALSE;
		if($owner_first_name && $owner_last_name) {
			$owner_name = $owner_first_name.' '.$owner_last_name;
		}
		// Owner Address
		$owner_address = sanitize_text_field($_POST['owner_address']);
		if(!$owner_address) {
			$message .= "<p class=\"form_message_fail\">Please enter the Owner Street Address.</p>";
			} else {
			$po = array('po box', 'p.o. box', 'po. box', 'p.o box', 'pobox', 'p o box');
			foreach($po as $key => $value) {
				if (strpos(strtolower($owner_address), $value) !== FALSE) {
					$owner_address = FALSE;
					$message .= "<p class=\"form_message_fail\">Please update the Owner Street Address - no PO Boxes accepted.</p>";
				}
			}
		}
		// Owner City
		$owner_city = sanitize_text_field($_POST['owner_city']);
		if(!$owner_city) {
			$message .= "<p class=\"form_message_fail\">Please enter the Owner City.</p>";
		}
		// Owner State
		$owner_state = sanitize_text_field($_POST['owner_state']);
		if(!$owner_state) {
			$message .= "<p class=\"form_message_fail\">Please enter the Owner State.</p>";
		}
		// Owner Zip
		$owner_zip = preg_replace("/[^0-9]/", "", sanitize_text_field($_POST['owner_zip']));
		if(!$owner_zip || strlen($owner_zip) != 5) {
			$owner_zip = FALSE;
			$format_check = FALSE;
			$message .= "<p class=\"form_message_fail\">Please enter the Owner Zip Code in 5-digit format.</p>";
		}		
		// Owner Email
		$owner_email = sanitize_text_field($_POST['owner_email']);
		$email_contact = $owner_email;
		if(!$owner_email) {
			$message .= "<p class=\"form_message_fail\">Please enter the Owner Email Address.</p>";
			} else {
			if(!filter_var($owner_email, FILTER_VALIDATE_EMAIL)) {
				$owner_email = FALSE;
				$email_contact = FALSE;
				$format_check = FALSE;
				$message .= "<p class=\"form_message_fail\">Please check the Owner Email Address. Email format is invalid.</p>";
			}				
		}
		// Owner Phone
		$owner_phone = preg_replace("/[^0-9]/", "", sanitize_text_field($_POST['owner_phone']));
		if(!$owner_phone || strlen($owner_phone) != 10) {
			$owner_phone = FALSE;
			$format_check = FALSE;
			$message .= "<p class=\"form_message_fail\">Please enter the Owner Phone Number in 10-digit format (ie 5551234567).</p>";
		}
		// Owner Contact
		$owner_contact = TRUE;
		if(!$owner_email || !$owner_phone) {
			$message .= "<p class=\"form_message_fail\">Please enter the the Firearm Owner Email Address or Phone Number.</p>";
			$owner_contact = FALSE;
		}
		// Upload
		$upload = FALSE;
		$upload_check = TRUE;
	}
	
	// Contact
	$contact_check = FALSE;
	if($dealer_owner == 'Dealer' && $primary_contact && $dealer_company_name && $dealer_contact_name && $dealer_address && $dealer_city && $dealer_state && $dealer_zip && $dealer_email && $dealer_phone && $primary_check && $format_check) {
		$contact_check = TRUE;
	}
	if($dealer_owner == 'Firearm Owner' && $owner_name && $owner_address && $owner_city && $owner_state && $owner_zip && $owner_email && $owner_phone && $format_check) {
		$contact_check = TRUE;
	}
	
	// Subscribe check
	$subscribe = sanitize_text_field($_POST['subscribe']);
	if(!$subscribe) {
		$message .= "<p class=\"form_message_fail\">Please choose your Communication Preferences for Mossberg emails.</p>";
	}
	
	// Info check
	$info_check = sanitize_text_field($_POST['info_check']);
	if(!$info_check) {
		$message .= "<p class=\"form_message_fail\">Please check the box at the bottom of the form.</p>";
	}
	
	// Upload
	if($upload) { 
		// File
		$file_field = 'dealer_ffl';			
		// File Types
		$allowed_extensions = array('doc','docx','pdf','zip','jpg','jpeg','gif','png');
		$allowed_mimes = array('application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.ms-word','application/pdf','text/pdf','application/zip','application/x-zip','application/x-zip-compressed','application/octet-stream','application/x-compress','application/x-compressed','multipart/x-zip','application/x-stuffit','image/jpg','image/jpeg','image/pjpeg','image/gif','image/gif','image/png','image/x-png');
		$extensions_list = "doc, docx, pdf, zip, jpg, gif, png";
		// Check Upload
		if ($_FILES[$file_field]['error'] == UPLOAD_ERR_OK) {				
			// File Info
			$explode_file = explode ('.', $_FILES[$file_field]['name']);
			$file_date = date('YmdHis');
			$file_name = 'ffl-'.sanitize_title(strtolower($dealer_company_name)).'-'.$file_date;
			$file_extension = strtolower(end($explode_file));
			$file_mime = $_FILES[$file_field]['type'];
			$file_temp_name = $_FILES[$file_field]['tmp_name'];
			$file_size =  $_FILES[$file_field]['size'];
			$file_size_kb =  round($file_size / 1024);				
			// Check File Size
			$max_file_size_mb = 10;
			$max_file_size_kb = round($max_file_size_mb * 1024);
			$max_file_size_byte = round($max_file_size_kb * 1024);				
			if ($file_size < $max_file_size_byte) {
				$check_size = TRUE;
				} else {
				$check_size = FALSE;
				$message .= "<p class=\"form_message_fail\">FFL not uploaded. File Size $file_size_kb KB is too large. File must be less than {$max_file_size_mb}MB ({$max_file_size_kb}KB).</p>";
			}	
			// Check Extension
			if (in_array($file_extension, $allowed_extensions)) {
				$check_extension = TRUE;
				// Check MIME
				if (in_array($file_mime, $allowed_mimes)) {
					$check_mime = TRUE;
					} else {
					$check_mime = FALSE;
					$message .= "<p class=\"form_message_fail\">FFL not uploaded. MIME type ".strtoupper($file_mime)." not allowed. File must be a $extensions_list.</p>";
				}
				} else {
				$check_extension = FALSE;
				$message .= "<p class=\"form_message_fail\">FFL not uploaded. File type ".strtoupper($file_extension)." not allowed. File must be a $extensions_list.</p>";
			}			
			// Set/Check Directories
			$upload_folder = "api/freshdesk/ffl/";
			$upload_directory = "/data/mossberg/public_html/{$upload_folder}";
			if (is_writable($upload_directory)) {
				$check_directory = 'Y';
				} else {
				$check_directory = FALSE;
				$message .= "<p class=\"form_message_fail\">Cannot upload File. The $upload_folder directory is not writable. Check folder permissions.</p>";
			}			
			if($check_size && $check_extension && $check_mime && $check_directory) {
				// Upload File
				$upload_file = $file_name.'.'.$file_extension;
				$upload_path = $upload_directory.$upload_file;
				$file_path = $upload_folder.$upload_file;
				if(move_uploaded_file($file_temp_name, $upload_path)) {		
					chmod($upload_path,0644);
					// Check
					$upload_check = TRUE;
					$dealer_ffl = get_bloginfo('home')."/$file_path";
					} else {
					$upload_check = FALSE;
					$message .= "<p class=\"form_message_fail\">There was an error uploading the FFL. Please try again.</span></p>";
				}
				} else {
				$upload_check = FALSE;
			}
			} else {
			$upload_check = FALSE;
			$message .= "<p class=\"form_message_fail\">There was an error uploading the FFL. Please try again.</p>";
		}
	}
	
	// Check	
	if($serial_number && $firearm_check && $firearm_issues && $dealer_owner && $contact_check && $upload_check && $info_check && $subscribe) {	
		
		// Freshdesk API
		include(TEMPLATEPATH.'/inc/freshdesk/freshdesk-repair-ticket-submission.php');
		if($status == '201' && $ticket_id) {
			
			// Form Response
			$args = array('category_name'=>'firearm-service-response', 'numberposts'=>1);
			$posts = get_posts($args);
			if($posts) { 
				$post_title = $posts[0]->post_title;
				$post_email = nl2br($posts[0]->post_content);
				$post_content = wpautop($posts[0]->post_content);
				$message .= $post_content;
			}
			
			// Hubspot API
			include(TEMPLATEPATH.'/inc/hubspot/hubspot-repair-ticket-optin.php');
			
			// Magento API
			include(TEMPLATEPATH.'/inc/magento/magento-repair-ticket-submission.php');

			// Form
			$show = FALSE;
			} else {
			$message .= "<p class=\"form_message_fail\">There was a technical problem submitting this ticket to our Service Department.<br/>Please try submitting the ticket again.</p>";
		}
	}
}

// Message
if($message) {
	echo $message;
}

// Form
if($show) {
	include(TEMPLATEPATH.'/inc/forms/form-firearm-service.php');
	} else {
	// Ticket Summary
	include(TEMPLATEPATH.'/inc/inc-firearm-service-ticket.php');	
}
?>
