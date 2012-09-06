<?php

class GalleryTable extends Doctrine_Table
{  
  public static function getInstance() { return Doctrine_Core::getTable('Gallery'); }

  /**
   * new Gallery Property
   * 
   * @param int $property
   * @param string $former_name
   * @param string $internal_name
   * @return true
   */
  public function newGalleryProperty($property, $former_name, $internal_name)
  {
    $gallery = new Gallery();
    $gallery->setRealPropertyId($property);
    $gallery->setFormerName($former_name);
    $gallery->setInternalName($internal_name);
    $gallery->save();

    return  true;
  }

  /**
   * Get gallery by property
   * 
   * @param int $id
   * @return object
   */
  public function getGalleryByProperty($id, $one = null)
  {
    $q = $this->createQuery('g')
         ->where('g.real_property_id = ?', $id)
         ->orderBy('g.outstanding DESC, g.id ASC');

    if ($one) {
      return $q->fetchOne();
    } else {
      return $q->execute();
    }
  }

  /**
   * Delete imagen from gallery
   * 
   * @param int $id
   */
  public function deleteGallery($id)
  {
    $q = $this->createQuery('g')->delete()->where('id = ?', $id)->execute();
  }

} // end class