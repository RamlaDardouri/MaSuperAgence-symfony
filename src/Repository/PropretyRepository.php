<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Proprety;
use App\Entity\PropretySearch;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Proprety|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proprety|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proprety[]    findAll()
 * @method Proprety[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropretyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proprety::class);
    }



    /**
     * @return Query
     */
public function findAllVisibleQuery(PropretySearch $search): Query
{
   $query= $this->findVisibleQuery();

   if($search->getMaxPrice()) {
       $query = $query
       ->where('p.price <= :maxprice')
       ->setParameter('maxprice', $search->getMaxPrice());
 }

 if($search->getMinSurface()) {
    $query = $query
    ->andWhere('p.surface >= :minsurface')
    ->setParameter('minsurface', $search->getMinSurface());
}

if($search->getOptions()->count() > 0)
{
    $k = 0;
    foreach($search->getOptions() as $option)
    {
        $k++;
        $query = $query
        ->andWhere(":option$k MEMBER of p.options")
        ->setParameter("option$k" , $option);
    }
}
               
   
return $query->getQuery();
}



public function findLatest():array{
    return $this->createQueryBuilder('p')
   ->andWhere('p.sold= false')
   ->setMaxResults(5)
   ->getQuery()
   ->getResult();
}

private function findVisibleQuery(): QueryBuilder
{
    return $this->createQueryBuilder('p')
    ->where('p.sold =false');
}



    // /**
    //  * @return Proprety[] Returns an array of Proprety objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Proprety
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
