<?php

/**
 * BaseOperationRealProperty
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $operation_id
 * @property integer $real_property_id
 * @property decimal $price
 * @property integer $currency_id
 * @property Operation $Operation
 * @property RealProperty $RealProperty
 * @property Currency $Currency
 * 
 * @method integer               getOperationId()      Returns the current record's "operation_id" value
 * @method integer               getRealPropertyId()   Returns the current record's "real_property_id" value
 * @method decimal               getPrice()            Returns the current record's "price" value
 * @method integer               getCurrencyId()       Returns the current record's "currency_id" value
 * @method Operation             getOperation()        Returns the current record's "Operation" value
 * @method RealProperty          getRealProperty()     Returns the current record's "RealProperty" value
 * @method Currency              getCurrency()         Returns the current record's "Currency" value
 * @method OperationRealProperty setOperationId()      Sets the current record's "operation_id" value
 * @method OperationRealProperty setRealPropertyId()   Sets the current record's "real_property_id" value
 * @method OperationRealProperty setPrice()            Sets the current record's "price" value
 * @method OperationRealProperty setCurrencyId()       Sets the current record's "currency_id" value
 * @method OperationRealProperty setOperation()        Sets the current record's "Operation" value
 * @method OperationRealProperty setRealProperty()     Sets the current record's "RealProperty" value
 * @method OperationRealProperty setCurrency()         Sets the current record's "Currency" value
 * 
 * @package    sf_icox
 * @subpackage model
 * @author     pinika
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOperationRealProperty extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('operation_real_property');
        $this->hasColumn('operation_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('real_property_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('price', 'decimal', 10, array(
             'type' => 'decimal',
             'scale' => 2,
             'default' => 0,
             'length' => 10,
             ));
        $this->hasColumn('currency_id', 'integer', 4, array(
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
        $this->hasOne('Operation', array(
             'local' => 'operation_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('RealProperty', array(
             'local' => 'real_property_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Currency', array(
             'local' => 'currency_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}