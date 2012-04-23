<?php

/**
 * Operation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sf_icox
 * @subpackage model
 * @author     pinika
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Operation extends BaseOperation
{
    public static function getPrices($property, $culture)
    {
        $operation = OperationRealPropertyTable::getInstance()->getOperationsByPropertyIdAndCulture($property, $culture);

        $text_price = $operation->getCurrency()->getSymbol().' '. $operation->getPrice();

        return $text_price;
    }
}
