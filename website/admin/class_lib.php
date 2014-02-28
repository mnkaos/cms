<?php
class image{
	
	var $targ_w;
	var $targ_h;
	var $itemId;
	var $x;
	var $y;
	var $w;
	var $h;
	var $resultado;
	var $modulo;
	var $imgRef;
	
	function imageCrop($iid,$tw,$th,$x,$y,$w,$h,$mod,$imgRef){
		
		$this->targ_w = $tw;
		$this->targ_h = $th;
		$this->itemId = $iid;
		$this->x = $x;
		$this->y = $y;
		$this->w = $w;
		$this->h = $h;
		$this->modulo = $mod;
		$this->imgRef = $imgRef;
		
		switch($this->modulo){
			case 5:{
				$qry = "SELECT * FROM videos WHERE id_videos = ".$this->itemId." LIMIT 1;";
				$imagen = "img_video";
				$src = '../images/video_semana/video-'.$this->itemId;
			}break;
			case 6:{
				switch($this->imgRef){
					case 1:{
						$qry = "SELECT * FROM top5 WHERE id_top5 = ".$this->itemId." LIMIT 1;";
						$imagen = "imagen";
						$src = '../mp3/top5/cancion-'.$this->itemId;
					}break;
					case 2:{
						$qry = "SELECT * FROM newmusic WHERE id_newmusic = ".$this->itemId." LIMIT 1;";
						$imagen = "img_newmusic";
						$src = '../mp3/newMusic/cancion-'.$this->itemId;
					}break;
				}
			}break;
		}
		
		$query = mysql_fetch_array(mysql_query($qry));
	
		$jpeg_quality = 100;
	
		$src = $src.'/'.$query[$imagen];
		$img_r = imagecreatefromjpeg($src);
		$dst_r = imagecreatetruecolor( $this->targ_w, $this->targ_h );
		
		
		imagecopyresampled($dst_r,$img_r,0,0,$this->x, $this->y, $this->targ_w, $this->targ_h, $this->w, $this->h);
		
		if(imagejpeg($dst_r,$src,$jpeg_quality))
			$this->resultado = 1;
		else
			$this->resultado = 0;	
		
	}
	
	function resultado(){
		return $this->resultado;
	}
		
}
?>