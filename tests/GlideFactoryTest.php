<?php

namespace Kedeka\Media\Tests;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Kedeka\Media\Factories\GlideFactory;
use PHPUnit\Framework\TestCase;

class GlideFactoryTest extends TestCase
{
    public function test_it_uses_the_gd_driver_by_default(): void
    {
        $imageManager = (new GlideFactory)->getImageManager();

        $this->assertInstanceOf(Driver::class, $imageManager->driver());
    }

    public function test_it_accepts_a_driver_instance(): void
    {
        $driver = new Driver;

        $imageManager = (new GlideFactory(['driver' => $driver]))->getImageManager();

        $this->assertSame($driver, $imageManager->driver());
    }

    public function test_it_resizes_and_encodes_an_image_as_webp(): void
    {
        $source = ImageManager::gd()
            ->create(40, 20)
            ->fill('#ff0000')
            ->toPng()
            ->toString();

        $result = (new GlideFactory)->getApi()->run($source, [
            'w' => 10,
            'fm' => 'webp',
            'q' => 75,
        ]);

        $image = ImageManager::gd()->read($result);

        $this->assertSame(10, $image->width());
        $this->assertSame(5, $image->height());
        $this->assertSame('image/webp', $image->origin()->mediaType());
    }
}
