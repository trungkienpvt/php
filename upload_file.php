<?

class Upload 
{
	var $directory_name;
	var $max_filesize;
	var $error;
	var $user_tmp_name;
	var $user_file_name;
	var $user_file_size;
	var $user_file_type;
	var $user_full_name;
	var $thumb_name;
        var $thumb_name_file;
        var $fileNameInsert;

 	function set_directory($dir_name = ".")
	{
	 $this->directory_name = $dir_name;
	}

 	function set_max_size($max_file = 300000)
	{
	 $this->max_filesize = $max_file;
	}

 	function error()
	{
	 return $this->error;
	}

 	function is_ok()
	{
	 if(isset($this->error))
	  return FALSE;
	 else
	  return TRUE;
	}

	function set_tmp_name($temp_name)
	{
	 $this->user_tmp_name = $temp_name;
	}

	function set_file_size($file_size)
	{
	 $this->user_file_size = $file_size;
	}

	function set_file_type($file_type)
	{
	 $this->user_file_type = $file_type;
	}

 	function set_file_name($file)
	{
		$this->user_file_name = $file;
                $this->fileNameInsert = time() . $this->user_file_name;
		$this->user_full_name = $this->directory_name."/orginal/". $this->fileNameInsert;

	}
        function get_file_name_insert(){
                return $this->fileNameInsert;
        }
        function get_file_type(){
            return $this->user_file_type;
        }
        function get_thumb_name_file(){
            return $this->thumb_name_file;
        }
	function resize($max_width = 0, $max_height = 0 )
	{
	if(eregi("\.png$",$this->user_full_name))
	{
	 $img = imagecreatefrompng($this->user_full_name);
	}

	if(eregi("\.(jpg|jpeg)$",$this->user_full_name))
	{
	 $img = imagecreatefromjpeg($this->user_full_name);
	}

	if(eregi("\.gif$",$this->user_full_name))
	{
	 $img = imagecreatefromgif($this->user_full_name);
	}

    	$FullImage_width = imagesx ($img);
    	$FullImage_height = imagesy ($img);

		if(isset($max_width) && isset($max_height) && $max_width != 0 && $max_height != 0)
		{
		 $new_width = $max_width;
		 $new_height = $max_height;
		}
		else if(isset($max_width) && $max_width != 0)
		{
		 $new_width = $max_width;
		 $new_height = ((int)($new_width * $FullImage_height) / $FullImage_width);
		}
		else if(isset($max_height) && $max_height != 0)
		{
		 $new_height = $max_height;
		 $new_width = ((int)($new_height * $FullImage_width) / $FullImage_height);
		}
		else
		{
		 $new_height = $FullImage_height;
		 $new_width = $FullImage_width;
		}

    	$full_id =  imagecreatetruecolor( $new_width , $new_height );
		// Check transparent gif and pngs
	if(eregi("\.png$",$this->user_full_name) || eregi("\.gif$",$this->user_full_name))
		{
			$trnprt_indx = imagecolortransparent($img);
			$trnprt_color = imagecolorsforindex($img, $trnprt_indx);
			$trnprt_indx = imagecolorallocate($full_id, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
			imagefill($full_id, 0, 0, $trnprt_indx);
			imagecolortransparent($full_id, $trnprt_indx);
		}
		imagecopyresampled( $full_id, $img, 0,0,0,0, $new_width, $new_height, $FullImage_width, $FullImage_height );


		if(eregi("\.(jpg|jpeg)$",$this->user_full_name))
		{
		 $full = imagejpeg( $full_id, $this->user_full_name,100);
		}

		if(eregi("\.png$",$this->user_full_name))
		{
		 $full = imagepng( $full_id, $this->user_full_name);
		}

		if(eregi("\.gif$",$this->user_full_name))
		{
		 $full = imagegif($full_id, $this->user_full_name);
		}
		imagedestroy( $full_id );
		unset($max_width);
		unset($max_height);
	}

	function start_copy()
	{
		if(!isset($this->user_file_name))
		 $this->error = "You must define filename!";

        if ($this->user_file_size <= 0)
		 $this->error = "File size error (0): $this->user_file_size KB<br>";

        if ($this->user_file_size > $this->max_filesize)
		 $this->error = "File size error (1): $this->user_file_size KB<br>";

        if (!isset($this->error))
        {
			$filename = basename($this->user_file_name);

            if (!empty($this->directory_name)){
                $destination = $this->user_full_name;

            }else{
                $destination = time() . $filename;
            }

			if(!is_uploaded_file($this->user_tmp_name))
			 $this->error = "File ".$this->user_tmp_name." is not uploaded correctly.";
                        $destination = JPath::clean($destination);
			if (!@move_uploaded_file ($this->user_tmp_name,$destination))
			 $this->error = "Impossible to copy ".$this->user_file_name." from $userfile to destination directory.";
		}
	}

	function set_thumbnail_name($thumbname)
	{
	if(eregi("\.png$",$this->user_full_name)){
            $this->thumb_name = $this->directory_name."thumb/".$thumbname.".png";
            $this->thumb_name_file = $thumbname.".png";
        }

	if(eregi("\.(jpg|jpeg)$",$this->user_full_name)){
            $this->thumb_name = $this->directory_name."/thumb/".$thumbname.".jpg";
            $this->thumb_name_file = $thumbname.".jpg";
        }
	if(eregi("\.gif$",$this->user_full_name)){
            $this->thumb_name = $this->directory_name."/thumb/".$thumbname.".gif";
            $this->thumb_name_file = $thumbname.".gif";
        }

	}

	function create_thumbnail()
	{
	 if (!copy($this->user_full_name, $this->thumb_name))
	  {


	  echo "<br>".$this->user_full_name.", ".$this->thumb_name."<br>";
	   echo "failed to copy $file...<br />\n";

	  }
	}

	function set_thumbnail_size($max_width = 0, $max_height = 0 )
	{
	if(eregi("\.png$",$this->thumb_name))
	{
	 $img = ImageCreateFromPNG ($this->thumb_name);
	}

	if(eregi("\.(jpg|jpeg)$",$this->thumb_name))
	{
	 $img = ImageCreateFromJPEG ($this->thumb_name);
	}

	if(eregi("\.gif$",$this->thumb_name))
	{
	 $img = ImageCreateFromGif ($this->thumb_name);
	}

    	$FullImage_width = imagesx ($img);
    	$FullImage_height = imagesy ($img);

		if(isset($max_width) && isset($max_height) && $max_width != 0 && $max_height != 0)
		{
		 $new_width = $max_width;
		 $new_height = $max_height;
		}
		else if(isset($max_width) && $max_width != 0)
		{
		 $new_width = $max_width;
		 $new_height = ((int)($new_width * $FullImage_height) / $FullImage_width);
		}
		else if(isset($max_height) && $max_height != 0)
		{
		 $new_height = $max_height;
		 $new_width = ((int)($new_height * $FullImage_width) / $FullImage_height);
		}
		else
		{
		 $new_height = $FullImage_height;
		 $new_width = $FullImage_width;
		}
    	$full_id =  ImageCreateTrueColor ( $new_width , $new_height );

		// Check transparent gif and pngs
		if(eregi("\.png$",$this->user_full_name) || eregi("\.gif$",$this->user_full_name))
			{
				$trnprt_indx = imagecolortransparent($img);
				$trnprt_color = imagecolorsforindex($img, $trnprt_indx);
				$trnprt_indx = imagecolorallocate($full_id, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
				imagefill($full_id, 0, 0, $trnprt_indx);
				imagecolortransparent($full_id, $trnprt_indx);
			}
		ImageCopyResampled ( $full_id, $img, 0,0,0,0, $new_width, $new_height, $FullImage_width, $FullImage_height );


		if(eregi("\.(jpg|jpeg)$",$this->thumb_name))
		{
		 $full = ImageJPEG( $full_id, $this->thumb_name,100);
		}

		if(eregi("\.png$",$this->thumb_name))
		{
		 $full = ImagePNG( $full_id, $this->thumb_name);
		}

		if(eregi("\.gif$",$this->thumb_name))
		{
		 $full = ImageGIF($full_id, $this->thumb_name);
		}
		ImageDestroy( $full_id );
		unset($max_width);
		unset($max_height);
	}
}

	$yukle = new Upload();
        // Set Max Size
        $yukle->set_max_size(580000);
        // Set Directory
	$pathUpload = 'upload/photoalbum';
        $subPathUpload = 'upload/photoalbum';
        $thumbPath = $pathUpload . '/thumb';
        $yukle->set_directory($pathUpload);
        chmod($pathUpload, 0777);

        if ($_FILES['uploadBtn']['error'] == 4) {
		echo "error upload file";exit;
        }
        $yukle->set_tmp_name($_FILES['uploadBtn']['tmp_name']);
        // Do not change
        // Set file size, $_FILES['file']['size'] is automaticly get the size
        $yukle->set_file_size($_FILES['uploadBtn']['size']);
        // Do not change
        // Set File Type, $_FILES['file']['type'] is automaticly get the type
        $yukle->set_file_type($_FILES['uploadBtn']['type']);
        // Set File Name, $_FILES['file']['name'] is automaticly get the file name.. you can change
        $yukle->set_file_name($_FILES['uploadBtn']['name']);
        // Start Copy Process
        $yukle->start_copy();
	if ($yukle->is_ok()) {
            $orginalFile = $subPathUpload . '/orginal/' . $yukle->get_file_name_insert();
            $thumbnailName = time();
            $yukle->set_thumbnail_name($thumbnailName);
            $yukle->create_thumbnail();
            $yukle->set_thumbnail_size(75, 50);
            $thumbInsert = $subPathUpload . '/thumb/' . $yukle->get_thumb_name_file();
	    echo "Upload successful";exit;
        } else {
	echo "Error upload file. Please check again";
}


?>

