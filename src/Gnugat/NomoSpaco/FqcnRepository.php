<?php

namespace Gnugat\NomoSpaco;

use Gnugat\NomoSpaco\File\FileRepository;
use Exception;
use ReflectionClass;

/**
 * Retrieves a list of fully qualified classnames.
 *
 * @api
 */
class FqcnRepository
{
    /**
     * @var FileRepository
     */
    private $fileRepository;

    /**
     * @param FileRepository $fileRepository
     */
    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * @param string $projectRoot
     *
     * @return array
     *
     * @api
     */
    public function findAll($projectRoot)
    {
        $files = $this->fileRepository->findPhp($projectRoot);
        $fqcns = array();
        foreach ($files as $file) {
            $fqcns[] = $file->getNamespace().'\\'.$file->getClassname();
        }

        return $fqcns;
    }

    /**
     * @param string $projectRoot
     * @param string $classname
     *
     * @return array
     *
     * @api
     */
    public function findOne($projectRoot, $classname)
    {
        $files = $this->fileRepository->findPhp($projectRoot);
        $fqcns = array();
        foreach ($files as $file) {
            if ($classname !== $file->getClassname()) {
                continue;
            }
            $fqcns[] = $file->getNamespace().'\\'.$classname;
        }

        return $fqcns;
    }
}
