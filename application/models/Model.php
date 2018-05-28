<?php
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Model extends CI_Model {		
		/*
		 * 查询全部的user表数据
		 */
		public function account_poetry($uid){
			// 查询uid对应的所有文章
			 $data = $this->db->get_where('collect',array('uid'=>$uid))->result_array();
			return $data;
		}
		/*
		 * 用户等级
		 */
		 public function grade($dengji){
		 	// 等级划分
			if($dengji<10){
				$data['grade']='倔强青铜Ⅲ';
				$data['color']='#FF0000';
				return $data;
			}else if($dengji<20&&$dengji>10){
				$data['grade']='倔强青铜Ⅱ';
				$data['color']='#FF0000';
				return $data;
			}else if($dengji<30&&$dengji>20){
				$data['grade']='倔强青铜Ⅰ';
				$data['color']='#FF0000';
				return $data;
			}else if($dengji<40&&$dengji>30){
				$data['grade']='持续白银Ⅲ';
				$data['color']='#FF7F00';
				return $data;
			}else if($dengji<50&&$dengji>40){
				$data['grade']='持续白银Ⅱ';
				$data['color']='#FF7F00';
				return $data;
			}else if($dengji<60&&$dengji>50){
				$data['grade']='持续白银Ⅰ';
				$data['color']='#FF7F00';
				return $data;
			}else if($dengji<70&&$dengji>60){
				$data['grade']='荣耀黄金Ⅲ';
				$data['color']='#FFFF00 ';
				return $data;
			}else if($dengji<80&&$dengji>70){
				$data['grade']='荣耀黄金Ⅱ';
				$data['color']='#FFFF00 ';
				return $data;
			}else if($dengji<90&&$dengji>80){
				$data['grade']='荣耀黄金Ⅰ';
				$data['color']='#FFFF00 ';
				return $data;
			}else if($dengji<100&&$dengji>90){
				$data['grade']='尊贵铂金Ⅲ';
				$data['color']='#00FF00';
				return $data;
			}else if($dengji<110&&$dengji>100){
				$data['grade']='尊贵铂金Ⅱ';
				$data['color']='#00FF00';
				return $data;
			}else if($dengji<120&&$dengji>110){
				$data['grade']='尊贵铂金Ⅰ';
				$data['color']='#00FF00';
				return $data;
			}else if($dengji<130&&$dengji>120){
				$data['grade']='永恒钻石Ⅲ';
				$data['color']='#0000FF';
				return $data;
			}else if($dengji<140&&$dengji>130){
				$data['grade']='永恒钻石Ⅱ';
				$data['color']='#0000FF';
				return $data;
			}else if($dengji<150&&$dengji>140){
				$data['grade']='永恒钻石Ⅰ';
				$data['color']='#0000FF';
				return $data;
			}else if($dengji<160&&$dengji>150){
				$data['grade']='最强王者Ⅲ';
				$data['color']='#00FFFF';
				return $data;
			}else if($dengji<170&&$dengji>160){
				$data['grade']='最强王者Ⅱ';
				$data['color']='#00FFFF';
				return $data;
			}else if($dengji<180&&$dengji>170){
				$data['grade']='最强王者Ⅰ';
				$data['color']='#00FFFF';
				return $data;
			}else if($dengji<190&&$dengji>180){
				$data['grade']='荣耀王者Ⅲ';
				$data['color']='#8B00FF';
				return $data;
			}else if($dengji<200&&$dengji>190){
				$data['grade']='荣耀王者Ⅱ';
				$data['color']='#8B00FF';
				return $data;
			}else if($dengji>210){
				$data['grade']='荣耀王者';
				$data['color']='#8B00FF';
				return $data;
			}
		 }
				
	}
?>