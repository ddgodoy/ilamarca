<?php

class VideoTable extends Doctrine_Table
{  
  public static function getInstance() { return Doctrine_Core::getTable('Video'); }
  
  /**
   * Get videos for this property
   *
   * @param integer $property_id
   * @return array
   */
  public function getPropertyVideos($property_id)
  {
  	$a = array();
  	$q = Doctrine_Query::create()->select('id, youtube')->from('Video')->where("real_property_id = $property_id")->orderBy('id');
		$d = $q->fetchArray();

		foreach ($d as $value) {
			$a[] = $value['youtube'];
		}
		return $a;
  }
  
  /**
   * Set videos for this property
   *
   * @param integer $property_id
   * @param array $videos
   */
  public function setPropertyVideos($property_id, $videos)
  {
  	Doctrine_Query::create()->delete()->from('Video')->where("real_property_id = $property_id")->execute();
  	
  	foreach ($videos as $video)
  	{
  		$trimmed = trim($video);

  		if (!empty($trimmed)) {
	  		$video = new Video();
	
	  		$video->setYoutube($trimmed);
	  		$video->setRealPropertyId($property_id);
	  		$video->save();	
  		}
  	}
  }

} // end class