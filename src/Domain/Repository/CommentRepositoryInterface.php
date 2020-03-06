<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Comment;

/**
 * Class CommentRepositoryInterface
 *
 * @package App\Domain\Repository
 */
interface CommentRepositoryInterface
{
    public function save(Comment $comment);
}
