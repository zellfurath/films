<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    /**
     * Renvoie les films correspondant aux criètes optionnels passés en param.
     * @param $titre
     * @param $annee
     * @param $acteur
     * @param $realisateur
     * @param $genre
     * @param $pays
     * @return float|int|mixed|string
     */
    public function filtreMulticriteres($titre=null, $annee=null, $acteur=null, $realisateur=null, $genre=null, $pays=null){

        $qb = $this->createQueryBuilder('f')
            ->orderBy('f.nom', 'asc');

        if ($titre != null) {
            $qb->andWhere('f.nom LIKE :NOM')
                ->setParameter('NOM', '%' . $titre. '%');
        }

        if ($acteur!= null) {
            $qb->join('f.acteurs', 'a')
                ->andWhere('a=:ACTEUR')
                ->setParameter('ACTEUR', $acteur);
        }

        if ($pays!= null) {
            $qb->join('f.pays', 'p')
                ->andWhere('p=:PAYS')
                ->setParameter('PAYS', $pays);
        }

        if ($annee != null) {
            $qb->andWhere('f.anneeSortie = :ANNEE')
                ->setParameter('ANNEE', $annee);
        }

        if( $genre != null) {
            $qb->join('f.genres', 'g')
                ->andWhere('g=:GENRE')
                ->setParameter('GENRE',$genre);
        }

        if ($realisateur!= null) {
            $qb->join('f.realisateurs', 'r')
                ->andWhere('r=:REALISATEUR')
                ->setParameter('REALISATEUR', $realisateur);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Film $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Film $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Film[] Returns an array of Film objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Film
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
