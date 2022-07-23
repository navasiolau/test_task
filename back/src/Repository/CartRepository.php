<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 *
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function add(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function removeByCartId(int $cartId): void
    {
        $this->_em
            ->createQueryBuilder()
            ->delete(Cart::class, 'cart')
            ->where('cart.id = :cartId')
            ->setParameter('cartId', $cartId)
            ->getQuery()
            ->execute();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function listCount(): int
    {
        return (int) $this->_em
            ->createQueryBuilder()
            ->select('COUNT(cart.id)')
            ->from(Cart::class, 'cart')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
