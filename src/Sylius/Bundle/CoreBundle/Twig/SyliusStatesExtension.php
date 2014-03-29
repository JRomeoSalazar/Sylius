<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CoreBundle\Twig;

use Sylius\Bundle\PaymentsBundle\Model\PaymentInterface;
use Sylius\Bundle\CoreBundle\Model\OrderShippingStates;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Sylius payment and shipment states Twig helper.
 *
 * @author Jorge Romeo <jromeosalazar@gmail.com>
 */
class SyliusStatesExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('sylius_payment_label', array($this, 'paymentLabel'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('sylius_shipment_label', array($this, 'shipmentLabel'), array('is_safe' => array('html'))),
        );
    }

    /**
     * Receives payment state and returns css label class.
     *
     * @param string $paymentState
     *
     * @return string
     */
    public function paymentLabel($paymentState)
    {
        switch ($paymentState) {
            case PaymentInterface::STATE_NEW:
                return 'primary';
                break;
            case PaymentInterface::STATE_PENDING:
            case PaymentInterface::STATE_PROCESSING:
                return 'warning';
                break;

            case PaymentInterface::STATE_COMPLETED:
                return 'success';
                break;

            case PaymentInterface::STATE_REFUNDED:
                return 'info';
                break;

            case PaymentInterface::STATE_UNKNOWN:
                return 'default';
                break;
            
            default:
                return 'danger';
                break;
        }
    }

    /**
     * Receives shipment state and returns css label class.
     *
     * @param string $shipmentState
     *
     * @return string
     */
    public function shipmentLabel($shipmentState)
    {
        switch ($shipmentState) {
            case OrderShippingStates::BACKORDER:
            case OrderShippingStates::ONHOLD:
                return 'warning';
                break;

            case OrderShippingStates::READY:
                return 'success';
                break;

            case OrderShippingStates::SHIPPED:
                return 'info';
                break;

            case OrderShippingStates::RETURNED:
                return 'default';
                break;
            
            default:
                return 'danger';
                break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_states';
    }
}
