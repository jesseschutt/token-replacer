<?php

namespace JesseSchutt\TokenReplacer\Tests\Transformers\Laravel;

use JesseSchutt\TokenReplacer\Facades\TokenReplacer;
use JesseSchutt\TokenReplacer\Tests\TestCase;
use JesseSchutt\TokenReplacer\Transformers\Laravel\DotArrayTransformer;
use PHPUnit\Framework\Attributes\Test;

class DotArrayTransformerTest extends TestCase
{
    #[Test]
    public function it_transforms_an_array_using_the_arr_helper()
    {
        $transformer = TokenReplacer::from('The quick brown {{animal:jumpers.mammals.red}} jumped over the lazy {{animal:target}}')
            ->with('animal', new DotArrayTransformer([
                'jumpers' => [
                    'mammals' => [
                        'red' => 'fox',
                    ],
                ],
                'target' => 'dog',
            ]));

        $this->assertEquals('The quick brown fox jumped over the lazy dog', $transformer->transform());
    }
}
