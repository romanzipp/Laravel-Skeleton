<?php

namespace Support\Vendor\Passport;

use Laravel\Passport\Client as BaseClient;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $secret
 * @property string|null $provider
 * @property string $redirect
 * @property bool $personal_access_client
 * @property bool $password_client
 * @property bool $revoked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed $plain_secret
 */
class PassportClient extends BaseClient
{
    /**
     * Determine if the client should skip the authorization prompt.
     *
     * @return bool
     */
    public function skipsAuthorization(): bool
    {
        return in_array($this->id, config('passport.first_party_clients'));
    }

    /**
     * Determine if the client is a "first party" client.
     *
     * @return bool
     */
    public function firstParty(): bool
    {
        return parent::firstParty() || $this->skipsAuthorization();
    }
}
