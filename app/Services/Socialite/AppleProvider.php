<?php

namespace App\Services\Socialite;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;
use RuntimeException;

class AppleProvider extends AbstractProvider
{
    protected $scopes = ['name', 'email'];

    protected $scopeSeparator = ' ';

    protected $teamId;

    protected $keyId;

    protected $privateKey;

    protected $privateKeyPath;

    protected $encodingType = PHP_QUERY_RFC3986;

    public function setConfig(array $config): self
    {
        $this->teamId = $config['team_id'] ?? null;
        $this->keyId = $config['key_id'] ?? null;
        $this->privateKey = $config['private_key'] ?? null;
        $this->privateKeyPath = $config['private_key_path'] ?? null;

        return $this;
    }

    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase('https://appleid.apple.com/auth/authorize', $state);
    }

    protected function getTokenUrl(): string
    {
        return 'https://appleid.apple.com/auth/token';
    }

    protected function getUserByToken($token): array
    {
        return [];
    }

    protected function mapUserToObject(array $user): User
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['sub'] ?? null,
            'nickname' => null,
            'name' => $user['name'] ?? null,
            'email' => $user['email'] ?? null,
            'avatar' => null,
        ]);
    }

    protected function getCodeFields($state = null): array
    {
        return array_merge(parent::getCodeFields($state), [
            'response_mode' => 'form_post',
        ]);
    }

    protected function getTokenFields($code): array
    {
        $fields = parent::getTokenFields($code);
        $fields['client_secret'] = $this->getClientSecret();

        return $fields;
    }

    public function user(): User
    {
        if ($this->user) {
            return $this->user;
        }

        if ($this->hasInvalidState()) {
            throw new \Laravel\Socialite\Two\InvalidStateException;
        }

        $response = $this->getAccessTokenResponse($this->getCode());
        $payload = $this->decodeIdToken(Arr::get($response, 'id_token'));
        $postedUser = $this->parsePostedUser();
        $user = array_merge($payload, $postedUser);

        return $this->userInstance($response, $user);
    }

    protected function getClientSecret(): string
    {
        if (! empty($this->clientSecret)) {
            return $this->clientSecret;
        }

        if (empty($this->teamId) || empty($this->keyId) || empty($this->clientId)) {
            throw new RuntimeException('Konfigurasi Apple Login belum lengkap. Isi APPLE_TEAM_ID, APPLE_KEY_ID, dan APPLE_CLIENT_ID.');
        }

        return JWT::encode([
            'iss' => $this->teamId,
            'iat' => time(),
            'exp' => time() + 86400 * 180,
            'aud' => 'https://appleid.apple.com',
            'sub' => $this->clientId,
        ], $this->resolvePrivateKey(), 'ES256', $this->keyId);
    }

    protected function resolvePrivateKey(): string
    {
        if (! empty($this->privateKey)) {
            return Str::contains($this->privateKey, '\\n')
                ? str_replace('\\n', "\n", $this->privateKey)
                : $this->privateKey;
        }

        if (! empty($this->privateKeyPath) && is_readable($this->privateKeyPath)) {
            return file_get_contents($this->privateKeyPath);
        }

        throw new RuntimeException('Private key Apple tidak ditemukan. Isi APPLE_PRIVATE_KEY atau APPLE_PRIVATE_KEY_PATH.');
    }

    protected function decodeIdToken(?string $idToken): array
    {
        if (empty($idToken)) {
            throw new RuntimeException('Apple tidak mengirimkan ID token.');
        }

        $keys = Cache::remember('apple_public_keys', now()->addHours(6), function () {
            $response = $this->getHttpClient()->get('https://appleid.apple.com/auth/keys', [
                'headers' => ['Accept' => 'application/json'],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        });

        $decoded = JWT::decode($idToken, JWK::parseKeySet($keys));
        $payload = json_decode(json_encode($decoded), true);

        if (($payload['aud'] ?? null) !== $this->clientId) {
            throw new RuntimeException('Audience ID token Apple tidak sesuai.');
        }

        if (($payload['iss'] ?? null) !== 'https://appleid.apple.com') {
            throw new RuntimeException('Issuer ID token Apple tidak valid.');
        }

        return $payload;
    }

    protected function parsePostedUser(): array
    {
        $user = $this->request->input('user');

        if (empty($user)) {
            return [];
        }

        $decoded = json_decode($user, true);

        if (! is_array($decoded)) {
            return [];
        }

        $firstName = Arr::get($decoded, 'name.firstName');
        $lastName = Arr::get($decoded, 'name.lastName');
        $fullName = trim($firstName . ' ' . $lastName);

        return array_filter([
            'name' => $fullName ?: null,
            'email' => Arr::get($decoded, 'email'),
        ]);
    }
}
