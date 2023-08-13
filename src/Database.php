<?php

namespace Bilalbaraz\SupabaseLaravel;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Database {
    private Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $tableName
     * @param string $where
     * @return array
     * @throws GuzzleException
     */
    public function select(string $tableName, string $where = '*'): array
    {
        $request = $this->client->request(
            'GET',
            config('supabase.supabase_url') .
            '/' .
            config('supabase.supabase_interface') .
            '/' .
            config('supabase.supabase_version') .
            '/' .
            $tableName .
            '?select=' . $where,
            [
                'headers' => [
                    'apikey' => config('supabase.supabase_anon_key'),
                    'Authorization' => 'Bearer ' . config('supabase.supabase_anon_key'),
                ],
            ]
        );

        return json_decode($request->getBody()->getContents(), true);
    }

    /**
     * @param string $tableName
     * @param array $data
     * @return bool
     * @throws GuzzleException
     */
    public function insert(string $tableName, array $data = []): bool
    {
        $request = $this->client->request(
            'POST',
            config('supabase.supabase_url') .
            '/' .
            config('supabase.supabase_interface') .
            '/' .
            config('supabase.supabase_version') .
            '/' .
            $tableName,
            [
                'body' => json_encode($data),
                'headers' => [
                    'apikey' => config('supabase.supabase_anon_key'),
                    'Authorization' => 'Bearer ' . config('supabase.supabase_anon_key'),
                    'Prefer' => 'return=minimal',
                ],
            ]
        );

        return $request->getStatusCode() === 201;
    }

    /**
     * @param string $tableName
     * @param array $filters
     * @return bool
     * @throws GuzzleException
     */
    public function delete(string $tableName, array $filters = []): bool
    {
        $queryString = $this->convertFiltersToQueryString($filters);
        $request = $this->client->request(
            'DELETE',
            config('supabase.supabase_url') .
            '/' .
            config('supabase.supabase_interface') .
            '/' .
            config('supabase.supabase_version') .
            '/' .
            $tableName .
            '?' .
            $queryString,
            [
                'body' => json_encode($filters),
                'headers' => [
                    'apikey' => config('supabase.supabase_anon_key'),
                    'Authorization' => 'Bearer ' . config('supabase.supabase_anon_key'),
                    'Prefer' => 'return=minimal',
                ],
            ]
        );

        return $request->getStatusCode();
    }

    /**
     * @param array $filters
     * @return string
     */
    private function convertFiltersToQueryString(array $filters): string
    {
        $queryStringArray = [];

        foreach ($filters as $columnName => $conditions) {
            foreach ($conditions as $operator => $condition) {
                $queryStringArray[] = $columnName . '=' . $operator . '.' . $condition;
            }
        }

        return implode('&', $queryStringArray);
    }
}
