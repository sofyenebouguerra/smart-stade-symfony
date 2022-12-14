<?php

namespace App\Repository;

use App\Entity\DemandeIntervention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandeIntervention|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeIntervention|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeIntervention[]    findAll()
 * @method DemandeIntervention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeInterventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeIntervention::class);
    }
    public function orderByDegre()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.degreUrgence', 'ASC')
            ->getQuery()->getResult();
    }
    public function orderByType()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.typeIntervention', 'ASC')
            ->getQuery()->getResult();
    }
    public function RechercheDemandeDeg($degreUrgence){
        return $this->createQueryBuilder('s')
            ->where('s.degreUrgence LIKE :degreUrgence')


            ->setParameter('degreUrgence', '%' .$degreUrgence. '%')

            ->getQuery()
            ->getResult();
    }
    public function RechercheDemandeInt($interventionDemandee){
        return $this->createQueryBuilder('s')
            ->where('s.interventionDemandee LIKE :interventionDemandee')


            ->setParameter('interventionDemandee', '%' .$interventionDemandee. '%')

            ->getQuery()
            ->getResult();
    }
    public function RechercheDemandeType($typeIntervention){
        return $this->createQueryBuilder('s')
            ->where('s.typeIntervention LIKE :typeIntervention')


            ->setParameter('typeIntervention', '%' .$typeIntervention. '%')

            ->getQuery()
            ->getResult();
    }
    public function orderByDatedebut()
    {
        return $this->createQueryBuilder('s')
            ->where('s.dateDebutIntervention >= CURRENT_DATE()')
            //->orderBy('s.dateDebutIntervention', 'DESC')
            ->setMaxResults(3)
            ->getQuery()->getResult();
    }
    public function orderByDatefin()
    {
        return $this->createQueryBuilder('s')
            ->where('s.dateDebutIntervention <= CURRENT_DATE()')
            //->orderBy('s.dateDebutIntervention', 'DESC')
            ->setMaxResults(3)
            ->getQuery()->getResult();
    }
    public function findAllDayDemande()
    {

        $qb = $this->createQueryBuilder('s');
        $qb->where('s.allDay=:allDay');
        $qb->setParameter('allDay', true);
        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return DemandeIntervention[] Returns an array of DemandeIntervention objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DemandeIntervention
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
