<?php

use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Sami;
use Sami\Version\GitVersionCollection;

$versions = GitVersionCollection::create(__DIR__.'/src')
    ->addFromTags('v*.*.*')
    ->addFromTags('v*.*')
    ->add('master');

return new Sami(__DIR__.'/src', array(
    'versions' => $versions,
    'build_dir' => __DIR__.'/sami/build/%version%',
    'cache_dir' => __DIR__.'/sami/cache/%version%',
    'remote_repository' => new GitHubRemoteRepository('Raphy/epitech-api', __DIR__),
));
