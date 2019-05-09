<?php

namespace App\Repository;

use App\Entity\Quote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Internal\Hydration\HydrationException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Quote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quote[]    findAll()
 * @method Quote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuoteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Quote::class);
    }

    public function findAuthors(){
	    $query = $this->getEntityManager()->createQuery("SELECT DISTINCT q.author AS author FROM App\\Entity\\Quote q ORDER BY author ASC");

	    return $query->execute(null,AbstractQuery::HYDRATE_ARRAY);
    }
}
