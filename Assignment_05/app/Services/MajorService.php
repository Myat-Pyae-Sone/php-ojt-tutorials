<?php

namespace App\Services;

use App\Contracts\Dao\MajorDaoInterface;
use App\Contracts\Services\MajorServiceInterface;

/**
 * Major Service class
 */
class MajorService implements MajorServiceInterface
{
    /**
     * Major Dao
     */
    private $majorDao;

    /**
     * Class Constructor
     * @param MajorDaoInterface
     * @return void
     */
    public function __construct(MajorDaoInterface $majorDao)
    {
        $this->majorDao = $majorDao;
    }

    /**
     * Get Major list
     * @return object
     */
    public function getMajors(): object
    {
        return $this->majorDao->getMajors();
    }

    /**
     * Save Major
     * @param array $data
     * @return void
     */
    public function createMajor(array $data): void
    {
        $this->majorDao->createMajor($data);

    }
    /**
     * Update Major
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateMajor(array $data, int $id): void
    {
        $this->majorDao->updateMajor($data, $id);
    }

    /**
     * validate Major
     * @param $request
     * @return object
     */
    public function validateMajor($request): object
    {

    }

    /**
     * Delete Major
     * @param $Major
     * @return void
     */
    public function deleteMajorById($major): void
    {
        $this->majorDao->deleteMajorById($major);
    }

}
