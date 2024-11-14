<?php

namespace App\Repository;

use App\Entity\Appareil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Appareil>
 */
class AppareilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appareil::class);
    }

    //    /**
    //     * @return Appareil[] Returns an array of Appareil objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Appareil
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function searchByName($type, $nom)
    {
        $queryBuilder = $this->createQueryBuilder('a')
            ->leftJoin('a.idfab', 'f');

        if (!empty($type)) {
            $queryBuilder->andWhere('a.type LIKE :type')
                ->setParameter('type', '%' . $type . '%');
        }

        if (!empty($nom)) {
            $queryBuilder->andWhere('f.nom = :nom')
                ->setParameter('nom', $nom);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function findDistinctTypes(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT DISTINCT a.type
            FROM App\Entity\Appareil a
            ORDER BY a.type ASC'
        );

        return array_map('current', $query->getResult());

    }

    public function searchByDes(?string $designation): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.designation LIKE :designation')
            ->setParameter('designation', '%'.$designation.'%')
            ->getQuery()
            ->getResult();
    }

    public function findByTypeAndPrice(?string $type, ?float $prixMin, ?float $prixMax, ?string $order): array
    {
        $qb = $this->createQueryBuilder('a');

        if ($type) {
            $qb->andWhere('a.type = :type')
                ->setParameter('type', $type);
        }

        if ($prixMin !== null) {
            $qb->andWhere('a.prixUnit >= :prixMin')
                ->setParameter('prixMin', $prixMin);
        }

        if ($prixMax !== null) {
            $qb->andWhere('a.prixUnit <= :prixMax')
                ->setParameter('prixMax', $prixMax);
        }

        if ($order === 'asc') {
            $qb->orderBy('a.prixUnit', 'ASC');
        } elseif ($order === 'desc') {
            $qb->orderBy('a.prixUnit', 'DESC');
        }

        return $qb->getQuery()->getResult();
    }
   
}
