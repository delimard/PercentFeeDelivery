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

namespace PercentFeeDelivery\Controller;

use PercentFeeDelivery\PercentFeeDelivery;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Tools\URL;

/**
 * Class SetDeliveryPrice
 * @package PercentFeeDelivery\Controller
 */
class SetDeliveryPrice extends BaseAdminController
{
    public function configure()
    {
        if (null !== $response = $this->checkAuth(array(AdminResources::MODULE), array('PercentFeeDelivery'), AccessManager::UPDATE)) {
            return $response;
        }

        $form = $this->createForm('percentfeedelivery.form');
        $errmes=null;

        try {
            $vform = $this->validateForm($form);

            $price = $vform->get('percent')->getData();

            PercentFeeDelivery::setConfigValue(PercentFeeDelivery::PERCENT_PRICE_VAR_NAME, floatval($price));
        } catch (\Exception $ex) {
            $errmes = $this->createStandardFormValidationErrorMessage($ex);
        }

        if (null !== $errmes) {
            $this->setupFormErrorContext(
                'configuration',
                $errmes,
                $form,
                $ex
            );
        }

        return RedirectResponse::create(URL::getInstance()->absoluteUrl('/admin/module/PercentFeeDelivery'));
    }
}
