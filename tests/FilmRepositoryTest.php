<?php

namespace App\Tests;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FilmRepositoryTest extends KernelTestCase
{
    public function testFiltreMulticritere2OK(): void
    {
        $kernel = self::bootKernel();
        $filmRepository = static::getContainer()->get(FilmRepository::class);
        $films = $filmRepository->filtreMulticriteres("Dracula",null,null,null,null,null);

        $this->assertEquals(1, count($films));
    }

    public function testFiltreMulticritereOK(): void
    {
        $kernel = self::bootKernel();
        $filmRepository = static::getContainer()->get(FilmRepository::class);
        $films = $filmRepository->filtreMulticriteres(null,null,null,null,1,1);

        $this->assertEquals(0, count($films));
    }
}
