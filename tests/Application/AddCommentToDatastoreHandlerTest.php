<?php

namespace App\Tests\Application;

use App\Application\AddCommentToDatastoreHandler;
use App\Domain\Entity\Comment;
use App\Domain\ValueObject\CommentUpsertedEvent;
use App\Infrastructure\Repository\CommentRepository;
use App\Kernel;
use JMS\Serializer\SerializerInterface;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

/**
 * Class AddCommentToDatastoreHandlerTest
 *
 * @package App\Tests\Application
 */
class AddCommentToDatastoreHandlerTest extends WebTestCase
{
    use FixturesTrait;

    /** @test */
    public function itHandlesComment()
    {
        $this->loadFixtures([]);

        $request = file_get_contents(__DIR__ . '/AddCommentToDatastoreHandlerTest/request.json');

        /** @var SerializerInterface $serializer */
        $serializer = self::bootKernel()->getContainer()->get('jms_serializer');

        /** @var CommentUpsertedEvent $event */
        $event = $serializer->deserialize($request, CommentUpsertedEvent::class, 'json');

        /** @var CommentRepository $repository */
        $repository = self::bootKernel()->getContainer()->get('Test.App\Infrastructure\Repository\CommentRepository');

        $handler = new AddCommentToDatastoreHandler($serializer, $repository);
        $handler->handle($event);

        $this->assertEquals(1, count($repository->findAll()));
    }
}
