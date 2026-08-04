<?php
if( ! function_exists('form_editor')){
	function textarea_ckeditor($id) {
		$ckeditor = '
			<script src="'.base_url('asset/ckeditor/ckeditor.js').'"></script>
			<script type="text/javascript">
				CKEDITOR.replace("'.$id.'",{
					filebrowserBrowseUrl : "'.base_url("asset/ckfinder/ckfinder.html").'",
					filebrowserImageBrowseUrl : "'.base_url("asset/ckfinder/ckfinder.html?Type=Images").'",
					filebrowserFlashBrowseUrl : "'.base_url("asset/ckfinder/ckfinder.html?Type=Flash").'",
					filebrowserUploadUrl : "'.base_url("asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files").'",
					filebrowserImageUploadUrl : "'.base_url("asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images").'",
					filebrowserFlashUploadUrl : "'.base_url("asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash").'"
				} );
			</script>';
		
		return $ckeditor;
	}
}

function pre($print_r) {
	echo '<pre>';
	print_r($print_r);
	echo '</pre>';
}

function monthTextEn($month) {
	if($month == '01') {
		$month_ = 'January';
	} elseif($month == '02') {
		$month_ = 'Febuary';
	} elseif($month == '03') {
		$month_ = 'March';
	} elseif($month == '04') {
		$month_ = 'April';
	} elseif($month == '05') {
		$month_ = 'May';
	} elseif($month == '06') {
		$month_ = 'June';
	} elseif($month == '07') {
		$month_ = 'July';
	} elseif($month == '08') {
		$month_ = 'August';
	} elseif($month == '09') {
		$month_ = 'September';
	} elseif($month == '10') {
		$month_ = 'October';
	} elseif($month == '11') {
		$month_ = 'November';
	} elseif($month == '12') {
		$month_ = 'December';
	}

	return $month_;
}

function monthTextTh($month) {
	if($month == '01') {
		$month_ = 'มกราคม';
	} elseif($month == '02') {
		$month_ = 'กุมภาพันธ์';
	} elseif($month == '03') {
		$month_ = 'มีนาคม';
	} elseif($month == '04') {
		$month_ = 'เมษายน';
	} elseif($month == '05') {
		$month_ = 'พฤษภาคม';
	} elseif($month == '06') {
		$month_ = 'มิถุนายน';
	} elseif($month == '07') {
		$month_ = 'กรกฎาคม';
	} elseif($month == '08') {
		$month_ = 'สิงหาคม';
	} elseif($month == '09') {
		$month_ = 'กันยายน';
	} elseif($month == '10') {
		$month_ = 'ตุลาคม';
	} elseif($month == '11') {
		$month_ = 'พฤศจิกายน';
	} elseif($month == '12') {
		$month_ = 'ธันวาคม';
	} else {
		$month_ = '';
	}

	return $month_;
}

function date2TextEnFull($date) {
	if(!empty($date)) {
		$exp = explode('-', $date);
		
		$year = $exp[0];
		$month = $exp[1];
		$day = $exp[2];
		
		$year_ = $year;
		if($month == '01') {
			$month_ = 'January';
		} elseif($month == '02') {
			$month_ = 'Febuary';
		} elseif($month == '03') {
			$month_ = 'March';
		} elseif($month == '04') {
			$month_ = 'April';
		} elseif($month == '05') {
			$month_ = 'May';
		} elseif($month == '06') {
			$month_ = 'June';
		} elseif($month == '07') {
			$month_ = 'July';
		} elseif($month == '08') {
			$month_ = 'August';
		} elseif($month == '09') {
			$month_ = 'September';
		} elseif($month == '10') {
			$month_ = 'October';
		} elseif($month == '11') {
			$month_ = 'November';
		} elseif($month == '12') {
			$month_ = 'December';
		}
		
		if($day[0] == '0') {
			$day_ = $day[1];
		} else {
			$day_ = $day;
		}
		
		return $day_.' '.$month_.' '.$year_;
	}
}

function dateCancelMistine($date) {
	if(!empty($date)) {
		$exp0 = explode(' ', $date);

		$exp = explode('-', $exp0[0]);
		
		$year = $exp[0];
		$month = $exp[1];
		$day = $exp[2];
		
		$year_ = $year;
		if($month == '01') {
			$month_ = 'JAN';
		} elseif($month == '02') {
			$month_ = 'FEB';
		} elseif($month == '03') {
			$month_ = 'MAR';
		} elseif($month == '04') {
			$month_ = 'APR';
		} elseif($month == '05') {
			$month_ = 'MAY';
		} elseif($month == '06') {
			$month_ = 'JUN';
		} elseif($month == '07') {
			$month_ = 'JUL';
		} elseif($month == '08') {
			$month_ = 'AUG';
		} elseif($month == '09') {
			$month_ = 'SEP';
		} elseif($month == '10') {
			$month_ = 'OCT';
		} elseif($month == '11') {
			$month_ = 'NOV';
		} elseif($month == '12') {
			$month_ = 'DEC';
		}
		
		if($day[0] == '0') {
			$day_ = $day[1];
		} else {
			$day_ = $day;
		}
		
		return $day_.' '.$month_.' '.$year_;
	}
}

function date2TextTh($date) {
	if(!empty($date)) {
		$exp = explode('-', $date);
		
		$year = $exp[0] + 543;
		$month = $exp[1];
		$day = $exp[2];
		
		$year_ = $year;
		if($month == '01') {
			$month_ = 'มกราคม';
		} elseif($month == '02') {
			$month_ = 'กุมภาพันธ์';
		} elseif($month == '03') {
			$month_ = 'มีนาคม';
		} elseif($month == '04') {
			$month_ = 'เมษายน';
		} elseif($month == '05') {
			$month_ = 'พฤษภาคม';
		} elseif($month == '06') {
			$month_ = 'มิถุนายน';
		} elseif($month == '07') {
			$month_ = 'กรกฎาคม';
		} elseif($month == '08') {
			$month_ = 'สิงหาคม';
		} elseif($month == '09') {
			$month_ = 'กันยายน';
		} elseif($month == '10') {
			$month_ = 'ตุลาคม';
		} elseif($month == '11') {
			$month_ = 'พฤศจิกายน';
		} elseif($month == '12') {
			$month_ = 'ธันวาคม';
		} else {
			$month_ = '';
		}
		
		if($day[0] == '0') {
			$day_ = $day[1];
		} else {
			$day_ = $day;
		}
		
		return $day_.' '.$month_.' '.$year_;
	}
}


function findDate($type) {
	if($type == 'day') {
		return date('Y-m-d');	
	}
	
	if($type == 'week') {
		$number_week = date('w', strtotime(date('Y-m-d')));
		if($number_week == 0) {
			$begin_date = date('Y-m-d');
			$end_date = date('Y-m-d', strtotime('+6 day'));
		} elseif($number_week == 1) {
			$begin_date = date('Y-m-d', strtotime('-1 day'));
			$end_date = date('Y-m-d', strtotime('+5 day'));
		} elseif($number_week == 2) {
			$begin_date = date('Y-m-d', strtotime('-2 day'));
			$end_date = date('Y-m-d', strtotime('+4 day'));
		} elseif($number_week == 3) {
			$begin_date = date('Y-m-d', strtotime('-3 day'));
			$end_date = date('Y-m-d', strtotime('+3 day'));
		} elseif($number_week == 4) {
			$begin_date = date('Y-m-d', strtotime('-4 day'));
			$end_date = date('Y-m-d', strtotime('+2 day'));
		} elseif($number_week == 5) {
			$begin_date = date('Y-m-d', strtotime('-5 day'));
			$end_date = date('Y-m-d', strtotime('+1 day'));
		} elseif($number_week == 6) {
			$begin_date = date('Y-m-d', strtotime('-6 day'));
			$end_date = date('Y-m-d');
		}
		return $begin_date.' - '.$end_date;
	}
	
	if($type == 'month') {
		return date('Y-m-01').' - '.date('Y-m-t', strtotime(date('Y-m-d')));	
	}
}

function get2Lang($lang, $name_en, $name_bur) {
	if($lang == 'en') {
		return $name_en;
	} elseif($lang == 'bur') {
		return $name_bur;
	}
}

function getExtension($file) {
	if(!empty($file)) {
		$file_exp = explode('.', $file);
		
		$file_count = count($file_exp);
		
		--$file_count;
		
		return $file_exp[$file_count];
	}
}

function base_frontend($path_file) {
	return base_url('asset/frontend/'.$path_file);
}

function site_frontend($path_file) {
	$file = substr($path_file, 0, -4);
	
	$file = str_replace('-', '_', $file);
	
	return site_url('frontend/path/'.$file);
}

function getStar($star) {
	$star = ceil($star);

	if($star == 5) {
		echo '<i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i>';
	} elseif($star == 4) {
		echo '<i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span>';
	} elseif($star == 3) {
		echo '<i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span> <span><i class="fa fa-star" aria-hidden="true"></i></span>';
	} elseif($star == 2) {
		echo '<i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span> <span><i class="fa fa-star" aria-hidden="true"></i></span> <span><i class="fa fa-star" aria-hidden="true"></i></span>';
	} elseif($star == 1) {
		echo '<i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span> <span><i class="fa fa-star" aria-hidden="true"></i></span> <span><i class="fa fa-star" aria-hidden="true"></i></span> <span><i class="fa fa-star" aria-hidden="true"></i></span>';
	}
}

function getDateMistine($date) {
	$date_explode = explode('-', $date);
	$year = $date_explode[0];
	$month = $date_explode[1];
	$day = $date_explode[2];

	echo $day.'.'.$month.'.'.$year;
}
?>