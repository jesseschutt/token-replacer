<?php

namespace JesseSchutt\TokenReplacer\Tests\Transformers;

use JesseSchutt\TokenReplacer\Exceptions\InvalidTransformerOptionsException;
use JesseSchutt\TokenReplacer\Facades\TokenReplacer;
use JesseSchutt\TokenReplacer\Tests\TestCase;
use JesseSchutt\TokenReplacer\Transformers\UrlTransformer;
use PHPUnit\Framework\Attributes\Test;

class UrlTransformerTest extends TestCase
{
    #[Test]
    public function is_extract_from_a_file_path()
    {
        $replacer = TokenReplacer::from('{{ url:path }} is located at {{ url:scheme }}://{{ url:host }}')
            ->with('url', new UrlTransformer('https://example.com/index.html'));

        $this->assertEquals('/index.html is located at https://example.com', $replacer->transform());
    }

    #[Test]
    public function it_throws_an_exception_if_options_are_not_provided()
    {
        $transformer = TokenReplacer::from('{{url}}')
            ->with('url', new UrlTransformer('https://example.com'));

        $this->expectException(InvalidTransformerOptionsException::class);

        $transformer->transform();
    }
}
