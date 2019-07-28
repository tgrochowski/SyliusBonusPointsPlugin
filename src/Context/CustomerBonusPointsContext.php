<?php

declare(strict_types=1);

namespace BitBag\SyliusBonusPointsPlugin\Context;

use BitBag\SyliusBonusPointsPlugin\Entity\CustomerBonusPointsInterface;
use Sylius\Component\Customer\Context\CustomerContextInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

final class CustomerBonusPointsContext implements CustomerBonusPointsContextInterface
{
    /** @var CustomerContextInterface */
    private $customerContext;

    /** @var RepositoryInterface */
    private $customerBonusPointsRepository;

    /** @var FactoryInterface */
    private $customerBonusPointsFactory;

    public function __construct(
        CustomerContextInterface $customerContext,
        RepositoryInterface $customerBonusPointsRepository,
        FactoryInterface $customerBonusPointsFactory
    ) {
        $this->customerContext = $customerContext;
        $this->customerBonusPointsRepository = $customerBonusPointsRepository;
        $this->customerBonusPointsFactory = $customerBonusPointsFactory;
    }

    public function getCustomerBonusPoints(): ?CustomerBonusPointsInterface
    {
        $customer = $this->customerContext->getCustomer();

        if (null === $customer) {
            return null;
        }

        $customerBonusPoints = $this->customerBonusPointsRepository->findOneBy([
            'customer' => $customer,
        ]);

        if (null === $customerBonusPoints) {
            /** @var CustomerBonusPointsInterface $customerBonusPoints */
            $customerBonusPoints = $this->customerBonusPointsFactory->createNew();

            $customerBonusPoints->setCustomer($customer);

            $this->customerBonusPointsRepository->add($customerBonusPoints);
        }

        return $customerBonusPoints;
    }
}
