<?php

namespace App\Repositories\Gallery;

interface GalleryInterface
{
    /**
     * Get all gallery items
     */
    public function getAll();

    /**
     * Get gallery item by ID
     */
    public function getById($id);

    /**
     * Insert new gallery item
     */
    public function insert($data);

    /**
     * Update gallery item
     */
    public function update($data, $id);

    /**
     * Delete gallery item
     */
    public function delete($id);
}