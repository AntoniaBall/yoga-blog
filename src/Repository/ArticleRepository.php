<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
    * @return Article[] Returns an array of Article objects
    */
    public function findAllOrderByDate()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.date', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    // get next et previous articles pour pagination
    public function getNextArticle($articleId)
    {
        $qb = $this->createQueryBuilder('a')
                ->where('a.id > :currentArticleId')
                ->setParameter('currentArticleId', $articleId)
                ->orderBy('a.id','ASC')
                ->setMaxResults(1)
                ;

        $query = $qb->getQuery();
        $nextArticle = $query->getOneOrNullResult();

        return $nextArticle;
    }

    public function getPreviousArticle($articleId)
    {
        $qb = $this->createQueryBuilder('a')
                ->where('a.id < :currentArticleId')
                ->setParameter('currentArticleId', $articleId)
                ->orderBy('a.id','DESC')
                ->setMaxResults(1)
                ;

        $query = $qb->getQuery();
        $previousArticle = $query->getOneOrNullResult();
        
        return $previousArticle;
    }
}
