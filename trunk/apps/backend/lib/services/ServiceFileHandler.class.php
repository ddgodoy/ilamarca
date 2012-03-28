<?php

class ServiceFileHandler
{
	/**
	 * Set upload folder by entity
	 *
	 * @param string $entity
	 * @return string $folder
	 */
	public static function getUploadFolder($entity)
	{
		$upload_folder = sfConfig::get('sf_web_dir').'/admin/uploads/';
		$entity_folder = $upload_folder.$entity.'/';
		$actual_year_folder = $entity_folder.date('Y').'/';

		## create entity folder
		if (!is_dir($entity_folder)) {
			mkdir($entity_folder); chmod($entity_folder, 0777);
		}
		## create actual year folder
		if (!is_dir($actual_year_folder)) {
			mkdir($actual_year_folder); chmod($actual_year_folder, 0777);
		}
		return $entity_folder;
	}
	
	/**
	 * Get thumbnail image
	 *
	 * @param string $image
	 * @return string
	 */
	public static function getThumbImage($image)
	{
		return str_replace('/', '/c_', $image);
	}

} // end class