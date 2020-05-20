<?php

declare(strict_types=1);

namespace Directus\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

/**
 * Class Response.
 */
class Response extends JsonResponse
{
    /**
     * Sets the response as public.
     */
    public function public(): self
    {
        $this->set('public', true);

        return $this;
    }

    /**
     * Sets the response as private.
     */
    public function private(): self
    {
        $this->set('public', false);

        return $this;
    }

    /**
     * Responds with success.
     *
     * @param mixed $data
     */
    public function with($data, int $status = 200): self
    {
        $this->set('data', $data);
        $this->setStatusCode($status);

        // TODO: dispatch event for plugins to transform the response and
        //       leverage request()->route()->getName() for identification

        return $this;
    }

    /**
     * Responds with success.
     */
    public function withNothing(int $status = 204): self
    {
        $this->setStatusCode($status);
        $this->data = '';

        // TODO: dispatch event for plugins to transform the response and
        //       leverage request()->route()->getName() for identification

        return $this;
    }

    /**
     * @param mixed $response
     */
    public function withQuery($response): self
    {
        if (isset($response['data'])) {
            $this->set('data', $response['data']);
        }

        // TODO: fix return status
        if (isset($response['errors'])) {
            $this->set('errors', $response['errors']);
        }

        return $this;
    }

    /**
     * Sets data on the array.
     *
     * @param mixed $data
     */
    protected function set(string $key, $data): void
    {
        $current = $this->getData(true);
        $this->setData(Arr::set($current, $key, $data));
    }
}
