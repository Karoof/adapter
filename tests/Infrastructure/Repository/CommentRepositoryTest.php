<?php

namespace App\Tests\Infrastructure\Repository;

use App\Domain\Entity\Comment;
use App\Infrastructure\Repository\CommentRepository;
use App\Tests\PrivatePropertyManipulator;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CommentRepositoryTest
 *
 * @package App\Tests\Infrastructure\Repository
 */
class CommentRepositoryTest extends KernelTestCase
{
    use PrivatePropertyManipulator;
    use FixturesTrait;

    /** @test */
    public function itSavesACommentToTheDatabase()
    {
        $this->loadFixtures([]);
        /** @var CommentRepository $repository */
        $repository = self::bootKernel()->getContainer()->get('Test.App\Infrastructure\Repository\CommentRepository');
        $this->assertEquals(0, count($repository->findAll()));

        $comment = $this->getComment();
        $repository->save($comment);
        $this->assertEquals(1, count($repository->findAll()));

        $commentFromRepository = $repository->find('1');
        $this->assertEquals('Hi Karoof!', $this->getByReflection($commentFromRepository, 'comment'));
        $this->assertEquals('userId_test', $this->getByReflection($commentFromRepository, 'userId'));
        $this->assertEquals('topicId_test', $this->getByReflection($commentFromRepository, 'topicId'));
    }

    private function getComment()
    {
        $comment = new Comment();
        $this->setByReflection($comment, 'comment', 'Hi Karoof!');
        $this->setByReflection($comment, 'userId', 'userId_test');
        $this->setByReflection($comment, 'topicId', 'topicId_test');

        return $comment;
    }
}
