<?php

/**
 * BaseRealProperty
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property text $detail
 * @property string $status
 * @property integer $property_type_id
 * @property integer $neighborhood_id
 * @property integer $app_user_id
 * @property PropertyType $PropertyType
 * @property Neighborhood $Neighborhood
 * @property AppUser $AppUser
 * @property Doctrine_Collection $OperationRealProperties
 * @property Doctrine_Collection $RealProperty
 * @property Doctrine_Collection $SearchMatches
 * 
 * @method integer             getId()                      Returns the current record's "id" value
 * @method string              getName()                    Returns the current record's "name" value
 * @method text                getDetail()                  Returns the current record's "detail" value
 * @method string              getStatus()                  Returns the current record's "status" value
 * @method integer             getPropertyTypeId()          Returns the current record's "property_type_id" value
 * @method integer             getNeighborhoodId()          Returns the current record's "neighborhood_id" value
 * @method integer             getAppUserId()               Returns the current record's "app_user_id" value
 * @method PropertyType        getPropertyType()            Returns the current record's "PropertyType" value
 * @method Neighborhood        getNeighborhood()            Returns the current record's "Neighborhood" value
 * @method AppUser             getAppUser()                 Returns the current record's "AppUser" value
 * @method Doctrine_Collection getOperationRealProperties() Returns the current record's "OperationRealProperties" collection
 * @method Doctrine_Collection getRealProperty()            Returns the current record's "RealProperty" collection
 * @method Doctrine_Collection getSearchMatches()           Returns the current record's "SearchMatches" collection
 * @method RealProperty        setId()                      Sets the current record's "id" value
 * @method RealProperty        setName()                    Sets the current record's "name" value
 * @method RealProperty        setDetail()                  Sets the current record's "detail" value
 * @method RealProperty        setStatus()                  Sets the current record's "status" value
 * @method RealProperty        setPropertyTypeId()          Sets the current record's "property_type_id" value
 * @method RealProperty        setNeighborhoodId()          Sets the current record's "neighborhood_id" value
 * @method RealProperty        setAppUserId()               Sets the current record's "app_user_id" value
 * @method RealProperty        setPropertyType()            Sets the current record's "PropertyType" value
 * @method RealProperty        setNeighborhood()            Sets the current record's "Neighborhood" value
 * @method RealProperty        setAppUser()                 Sets the current record's "AppUser" value
 * @method RealProperty        setOperationRealProperties() Sets the current record's "OperationRealProperties" collection
 * @method RealProperty        setRealProperty()            Sets the current record's "RealProperty" collection
 * @method RealProperty        setSearchMatches()           Sets the current record's "SearchMatches" collection
 * 
 * @package    sf_icox
 * @subpackage model
 * @author     pinika
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRealProperty extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('real_property');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 250, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 250,
             ));
        $this->hasColumn('detail', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('status', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('property_type_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('neighborhood_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('app_user_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));

        $this->option('collate', 'utf8_general_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('PropertyType', array(
             'local' => 'property_type_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Neighborhood', array(
             'local' => 'neighborhood_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('AppUser', array(
             'local' => 'app_user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('OperationRealProperty as OperationRealProperties', array(
             'local' => 'id',
             'foreign' => 'real_property_id'));

        $this->hasMany('Gallery as RealProperty', array(
             'local' => 'id',
             'foreign' => 'real_property_id'));

        $this->hasMany('SearchMatch as SearchMatches', array(
             'local' => 'id',
             'foreign' => 'real_property_id'));

        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'detail',
             ),
             ));
        $this->actAs($i18n0);
    }
}