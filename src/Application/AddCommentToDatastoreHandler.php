<?php

namespace App\Application;

use App\Domain\Entity\Comment;
use App\Domain\ValueObject\CommentUpsertedEvent;
use App\Infrastructure\Repository\CommentRepository;
use JMS\Serializer\SerializerInterface;

/**
 * Class addCommentToDatastoreHandler
 *
 * @package App\Application
 */
class AddCommentToDatastoreHandler
{
    private $serializer;
    private $repository;

    public function __construct(SerializerInterface $serializer, CommentRepository $repository)
    {
        $this->serializer = $serializer;
        $this->repository = $repository;
    }

    public function handle(CommentUpsertedEvent $event)
    {
        $data = $event->getData();
        /** @var \App\Domain\Entity\Comment $comment */
        $comment = $this->serializer->deserialize(
            $this->serializer->serialize($data, "json"),
            Comment::class,
            "json"
        );

        $this->repository->save($comment);
    }
}
