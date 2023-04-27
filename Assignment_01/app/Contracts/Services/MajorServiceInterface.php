<?php

namespace App\Contracts\Services;

/**
 * Interface for task service
 */
interface MajorServiceInterface
{
    /**
     * Get Major
     * @return object
     */
    public function getMajors(): object;

    /**
     * Save Major
     * @param array $data
     * @return void
     */
    public function createMajor(array $data): void;

    /**
     * validate Major
     * @param int $id
     * @return object
     */
    public function validateMajor($request): object;

    /**
     * Update Major
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateMajor(array $data, int $id): void;

    /**
     * Delete Major
     * @param $Major
     * @return void
     */
    public function deleteMajorById($major): void;
}
