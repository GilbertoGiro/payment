<?php

namespace App\Traits;

trait Permission
{
    /**
     * Method to verify if user has given permission
     * @param int $userId
     * @param string|array $permissions
     * @return bool
     */
    public function hasPermission(int $userId, $permissions): bool
    {
        // Always turn permission into array
        $permissions = is_array($permissions) ? $permissions : [$permissions];
        // Find user related permission (If exists)
        return $this->find($userId)->role()->with('rolePermission.permission')
            ->whereHas('rolePermission.permission', function ($query) use ($permissions) {
                $query->whereIn('name', $permissions);
            })->exists();
    }
}
