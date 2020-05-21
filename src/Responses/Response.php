<?php

declare(strict_types=1);

namespace Directus\Responses;

use GraphQL\Error\Debug;
use GraphQL\Executor\ExecutionResult;
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

        event('directus.response.'.request()->route()->getName(), $this);

        return $this;
    }

    /**
     * Responds with success.
     */
    public function withNothing(int $status = 204): self
    {
        $this->setStatusCode($status);
        $this->data = '';

        event('directus.response.'.request()->route()->getName(), $this);

        return $this;
    }

    /**
     * Responds with a GraphQL query.
     */
    public function withQuery(ExecutionResult $result): self
    {
        $content = $result->toArray(
            (bool) config('app.debug') ? Debug::INCLUDE_TRACE | Debug::INCLUDE_DEBUG_MESSAGE : false
        );

        if (isset($content['data'])) {
            $this->set('data', $content['data']);
        }

        if (isset($content['extensions'])) {
            $this->set('extensions', $content['extensions']);
        }

        // TODO: add return status
        if (isset($content['errors'])) {
            $this->set('errors', $content['errors']);
        }

        event('directus.response.'.request()->route()->getName(), $this);

        return $this;
    }

    /**
     * Transform the response object.
     */
    public function transform(callable $transformer): self
    {
        if (is_callable($transformer)) {
            $transformer($this);
        }

        return $this;
    }

    /**
     * Sets the raw response.
     */
    public function raw(?string $content): self
    {
        $this->setContent($content);

        return $this;
    }

    /**
     * Sets the content type.
     */
    public function type(string $type): self
    {
        $this->headers->set('Content-Type', $type);
        return $this;
    }

    /**
     * Sets data on the array.
     *
     * @param mixed $value
     */
    public function set(string $key, $value): self
    {
        $data = $this->getData(true);
        return $this->setData(Arr::set($data, $key, $value));
    }

    /**
     * Sets data on the array.
     *
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return Arr::get($this->getData(true), $key, $default);
    }

    /**
     * Sets data on the array.
     *
     * @return mixed
     */
    public function unset(string $key): self
    {
        $data = $this->getData(true);
        return $this->setData(
            Arr::except($data, $key)
        );
    }
}
