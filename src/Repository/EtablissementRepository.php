<?php

namespace App\Repository;

use App\Entity\Etablissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etablissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etablissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etablissement[]    findAll()
 * @method Etablissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtablissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etablissement::class);
    }

    // /**
    //  * @return Etablissement[] Returns an array of Etablissement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etablissement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findBetweenTwoId(int $begin, int $end)
    {
        return $this->createQueryBuilder('e')
                    ->setFirstResult($begin-1)
                    ->setMaxResults($end)
                    ->getQuery()
                    ->getResult();
    }

    public function findMax()
    {
        $rawSql = "SELECT COUNT(id) FROM etablissement";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();
    }

    public function findByDepartement(String $departement, int $begin, int $end)
    {
        return $this->createQueryBuilder('e')
                    ->where("e.departement = ?1")
                    ->setParameter(1, $departement)
                    ->setFirstResult($begin-1)
                    ->setMaxResults($end)
                    ->getQuery()
                    ->getResult();
    }

    public function findMaxDepartement(String $departement)
    {
        $rawSql = "SELECT COUNT(id) FROM etablissement WHERE departement='$departement'";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();
    }

    public function findByCommune(String $commune, int $begin, int $end)
    {
        return $this->createQueryBuilder('e')
                    ->where("e.commune = ?1")
                    ->setParameter(1, $commune)
                    ->setFirstResult($begin-1)
                    ->setMaxResults($end)
                    ->getQuery()
                    ->getResult();
    }

    public function findByCommuneForMap(String $commune)
    {
        return $this->createQueryBuilder('e')
                    ->where("e.commune = ?1")
                    ->setParameter(1, $commune)
                    ->getQuery()
                    ->getResult();
    }

    public function findMaxCommune(String $commune)
    {
        $rawSql = "SELECT COUNT(id) FROM etablissement WHERE commune='$commune'";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();
    }

    public function findByRegion(String $region, int $begin, int $end)
    {
        return $this->createQueryBuilder('e')
                    ->where("e.region = ?1")
                    ->setParameter(1, $region)
                    ->setFirstResult($begin-1)
                    ->setMaxResults($end)
                    ->getQuery()
                    ->getResult();
    }

    public function findMaxRegion(String $region)
    {
        $rawSql = "SELECT COUNT(id) FROM etablissement WHERE region='$region'";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();
    }

    public function findByAcademie(String $academie, int $begin, int $end)
    {
        return $this->createQueryBuilder('e')
                    ->where("e.academie = ?1")
                    ->setParameter(1, $academie)
                    ->setFirstResult($begin-1)
                    ->setMaxResults($end)
                    ->getQuery()
                    ->getResult();
    }

    public function findMaxAcademie(String $academie)
    {
        $rawSql = "SELECT COUNT(id) FROM etablissement WHERE academie='$academie'";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();
    }

    public function findResearch(String $search)
    {
        return $this->createQueryBuilder('e')
        ->where("e.appelation_officielle LIKE ?1")
        ->setParameter(1, $search)
        ->getQuery()
        ->getResult();
    }
}

