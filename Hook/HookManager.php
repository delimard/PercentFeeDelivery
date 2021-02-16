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

namespace PercentFeeDelivery\Hook;

use PercentFeeDelivery\PercentFeeDelivery;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

/**
 * Class HookManager
 * @package PercentFeeDelivery\Hook
 */
class HookManager extends BaseHook
{
    public function onModuleConfiguration(HookRenderEvent $event)
    {
        $event->add(
            $this->render(
                "module_configuration.html",
                [
                    'percent' => floatval(PercentFeeDelivery::getConfigValue(PercentFeeDelivery::PERCENT_PRICE_VAR_NAME, 0))
                ]
            )
        );
    }


}
