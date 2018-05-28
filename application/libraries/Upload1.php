<?php
/***
if($_POST['submit']){
	$upfiles = new Upload();
	$upfiles->upload_file();
}
*/

class Upload1{
        /*作者：mckee 来自：www.phpddt.com*/
	public $upload_name;					//上传文件名
	public $upload_tmp_name;				//上传临时文件名
	public $upload_final_name;				//上传文件的最终文件名
	public $upload_target_dir;				//文件被上传到的目标目录
	public $upload_target_path;			    //文件被上传到的最终路径
	public $upload_filetype ;				//上传文件类型
	public $allow_uploadedfile_type;		//允许的上传文件类型
	public $upload_file_size;				//上传文件的大小
	public $allow_uploaded_maxsize=100000000; 	//允许上传文件的最大值
	//构造函数
	public function __construct()
	{
		$this->upload_name = $_FILES["myfile"]["name"]; //取得上传文件名
		$this->upload_filetype = $_FILES["myfile"]["type"];
		$this->upload_tmp_name = $_FILES["myfile"]["tmp_name"];
		$this->allow_uploadedfile_type = array('jpeg','jpg','png','gif','bmp','doc','docx','wps','mp4','wmv','avi','flv','mp3','wav');
		$this->upload_file_size = $_FILES["myfile"]["size"];
		$this->upload_target_dir="./img/avatar";
	}
	//文件上传
	public function upload_file()
	{
		$upload_filetype = $this->getFileExt($this->upload_name); //echo "$upload_filetype"; die;
		if(in_array($upload_filetype,$this->allow_uploadedfile_type))
		{//echo $this->allow_uploaded_maxsize;die;
			if($this->upload_file_size < $this->allow_uploaded_maxsize) //Updated array by Ed.
			{
				if(!is_dir($this->upload_target_dir))
				{
					mkdir($this->upload_target_dir);
					chmod($this->upload_target_dir,0777);
				}
				$this->upload_final_name = date("YmdHis").rand(0,100).'.'.$upload_filetype;
				$this->upload_target_path = $this->upload_target_dir."/".$this->upload_final_name;
                                //echo $this->upload_tmp_name[0];die;//echo $this->upload_target_path;
				if(!move_uploaded_file($this->upload_tmp_name,$this->upload_target_path))
					echo "<font color=red>文件上传失败！</font>";
			}
			else
			{
				echo("<font color=red>文件太大,上传失败！</font>");
			}
		}
		else
		{
			echo("不支持此文件类型，请重新选择");
		}
                //echo $this->upload_final_name; die;
                return $this->upload_final_name; 
	}
   /**
    *获取文件扩展名
    *@param String $filename 要获取文件名的文件
    */
   public function getFileExt($filename){ //echo $filename[0];die;
   		$info = pathinfo($filename); //Updated array by Ed.
   		return $info["extension"];
   }
}

