<?php

namespace App\Interfaces;

/**
 * Replaces Laratrust\Contracts\Ownable, which was removed in Laratrust 8.
 *
 * Akaunting still uses owner-based checks (see App\Traits\Owners), so the
 * contract is kept locally rather than dropping the behaviour.
 */
interface Ownable
{
    /**
     * Get the owner key value.
     *
     * @param  mixed  $owner
     * @return mixed
     */
    public function ownerKey($owner);
}
