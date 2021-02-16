<?php
/*************************************************************************************/
/*                                                                                   */
/*      Thelia	                                                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : info@thelia.net                                                      */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      This program is free software; you can redistribute it and/or modify         */
/*      it under the terms of the GNU General Public License as published by         */
/*      the Free Software Foundation; either version 3 of the License                */
/*                                                                                   */
/*      This program is distributed in the hope that it will be useful,              */
/*      but WITHOUT ANY WARRANTY; without even the implied warranty of               */
/*      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                */
/*      GNU General Public License for more details.                                 */
/*                                                                                   */
/*      You should have received a copy of the GNU General Public License            */
/*	    along with this program. If not, see <http://www.gnu.org/licenses/>.         */
/*                                                                                   */
/*************************************************************************************/

namespace PercentFeeDelivery;


use Thelia\Model\Country;

use Thelia\Module\AbstractDeliveryModule;

/**
 * Class PercentFeeDelivery
 * @package PercentFeeDelivery
 */
class PercentFeeDelivery extends AbstractDeliveryModule
{
    const DOMAIN_NAME = 'percentfeedelivery';

    const PERCENT_PRICE_VAR_NAME = 'percent_price';

    /**
     * @inheritdoc
     */
    public function getPostage(Country $country)
    {
        $cart = $this->getContainer()->get('request')->getSession()->getCart();
        $amount = $cart->getTotalAmount();
        $postage=floatval(PercentFeeDelivery::getConfigValue(self::PERCENT_PRICE_VAR_NAME, 0));
        $Percentpostage= $amount*($postage/100);
        return $Percentpostage;
    }

    
    /**
     * @inheritdoc
     */
    public function isValidDelivery(Country $country)
    {
        return true;
    }
}
