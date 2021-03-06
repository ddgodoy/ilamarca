<?php

/**
 * BaseCurrency
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $iso_code
 * @property string $culture
 * @property string $symbol
 * @property Doctrine_Collection $Currency
 * 
 * @method integer             getId()       Returns the current record's "id" value
 * @method string              getName()     Returns the current record's "name" value
 * @method string              getIsoCode()  Returns the current record's "iso_code" value
 * @method string              getCulture()  Returns the current record's "culture" value
 * @method string              getSymbol()   Returns the current record's "symbol" value
 * @method Doctrine_Collection getCurrency() Returns the current record's "Currency" collection
 * @method Currency            setId()       Sets the current record's "id" value
 * @method Currency            setName()     Sets the current record's "name" value
 * @method Currency            setIsoCode()  Sets the current record's "iso_code" value
 * @method Currency            setCulture()  Sets the current record's "culture" value
 * @method Currency            setSymbol()   Sets the current record's "symbol" value
 * @method Currency            setCurrency() Sets the current record's "Currency" collection
 * 
 * @package    sf_icox
 * @subpackage model
 * @author     pinika
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCurrency extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('currency');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('iso_code', 'string', 5, array(
             'type' => 'string',
             'length' => 5,
             ));
        $this->hasColumn('culture', 'string', 5, array(
             'type' => 'string',
             'length' => 5,
             ));
        $this->hasColumn('symbol', 'string', 5, array(
             'type' => 'string',
             'length' => 5,
             ));

        $this->option('collate', 'utf8_general_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('OperationRealProperty as Currency', array(
             'local' => 'id',
             'foreign' => 'currency_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}