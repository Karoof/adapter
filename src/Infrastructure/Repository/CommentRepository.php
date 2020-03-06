<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Comment;
use App\Domain\Repository\CommentRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class CommentRepository
 *
 * @package App\Infrastructure\Repository
 */
class CommentRepository extends EntityRepository implements CommentRepositoryInterface
{
    public function save(Comment $comment)
    {
        $this->_em->persist($comment);
        $this->_em->flush($comment);
    }
}
