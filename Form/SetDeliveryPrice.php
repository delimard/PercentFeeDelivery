<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace PercentFeeDelivery\Form;

use PercentFeeDelivery\PercentFeeDelivery;
use PercentFeeDelivery\Model\LocalPickupShippingQuery;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

/**
 * Class SetDeliveryPrice
 * @package PercentFeeDelivery\Form
 */
class SetDeliveryPrice extends BaseForm
{
    protected function buildForm()
    {
        $this->formBuilder
            ->add(
                "percent",
                "number",
                [
                    "label"=>Translator::getInstance()->trans("Percent", [], PercentFeeDelivery::DOMAIN_NAME),
                    "label_attr"=> [
                        "for"=>"percentfield"
                    ],
                    "constraints"=> [ new NotBlank(), new GreaterThanOrEqual([ 'value' => 0 ]) ]
                ]
            )
        ;
    }

    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return "set-delivery-price-percentfeedelivery";
    }

}
