<?php

/**
 * BaseVendorZone
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $app_user_id
 * @property integer $neighborhood_id
 * @property AppUser $AppUser
 * @property Neighborhood $Neighborhood
 * 
 * @method integer      getAppUserId()       Returns the current record's "app_user_id" value
 * @method integer      getNeighborhoodId()  Returns the current record's "neighborhood_id" value
 * @method AppUser      getAppUser()         Returns the current record's "AppUser" value
 * @method Neighborhood getNeighborhood()    Returns the current record's "Neighborhood" value
 * @method VendorZone   setAppUserId()       Sets the current record's "app_user_id" value
 * @method VendorZone   setNeighborhoodId()  Sets the current record's "neighborhood_id" value
 * @method VendorZone   setAppUser()         Sets the current record's "AppUser" value
 * @method VendorZone   setNeighborhood()    Sets the current record's "Neighborhood" value
 * 
 * @package    sf_icox
 * @subpackage model
 * @author     pinika
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVendorZone extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('vendor_zone');
        $this->hasColumn('app_user_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('neighborhood_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));

        $this->option('collate', 'utf8_general_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('AppUser', array(
             'local' => 'app_user_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $this->hasOne('Neighborhood', array(
             'local' => 'neighborhood_id',
             'foreign' => 'id',
             'onDelete' => 'RESTRICT'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}