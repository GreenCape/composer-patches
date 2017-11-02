<?php
namespace Vaimo\ComposerPatches\Patch\PackageResolvers;

class FullResetResolver implements \Vaimo\ComposerPatches\Interfaces\PatchPackagesResolverInterface
{
    /**
     * @var \Vaimo\ComposerPatches\Utils\PackageUtils
     */
    private $packageUtils;

    public function __construct()
    {
        $this->packageUtils = new \Vaimo\ComposerPatches\Utils\PackageUtils();
    }
    
    public function resolve(array $patches, array $packages)
    {
        $matches = array();

        foreach ($packages as $packageName => $package) {
            if (!$this->packageUtils->shouldReinstall($package, array()) && !isset($patches[$packageName])) {
                continue;
            }

            $matches[] = $packageName;
        }
        
        return $matches;
    }
}