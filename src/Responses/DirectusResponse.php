<?php

declare(strict_types=1);

namespace Directus\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

/**
 * Class DirectusResponse.
 */
class DirectusResponse extends JsonResponse
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

        return $this;
    }

    /**
     * Responds with success.
     */
    public function withNothing(int $status = 204): self
    {
        $this->setStatusCode($status);
        $this->data = '';

        return $this;
    }

    /**
     * Responds with an error.
     */
    public function withError(string $code, array $context = []): self
    {
        $error = Errors::for($code, $context);
        $this->setStatusCode($error['status']);
        unset($error['status']);
        $this->set('error', $error);

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
