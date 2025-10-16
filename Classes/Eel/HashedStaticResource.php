<?php

namespace LB\HashedAssetUri\Eel;

use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Flow\ResourceManagement\EelHelper\StaticResourceHelper;

final class HashedStaticResource implements ProtectedContextAwareInterface
{
    public function __construct(private readonly StaticResourceHelper $staticResourceHelper)
    {
    }

    public function uri(string $packageKey, string $pathAndFilename, bool $localize = false): string
    {
        $content = $this->staticResourceHelper->content($packageKey, $pathAndFilename, $localize);
        $hash = substr(sha1($content), 0, 10);
        return $this->staticResourceHelper->uri($packageKey, $pathAndFilename, $localize) . '?v=' . $hash;
    }

    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }
}
