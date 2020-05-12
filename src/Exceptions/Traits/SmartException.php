<?php

declare(strict_types=1);

namespace Directus\Exceptions\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

trait SmartException
{
    /**
     * @var array
     */
    private $context;

    /**
     * Smart exception constructor.
     */
    public function __construct(array $context = [])
    {
        $this->context = $context;
        parent::__construct($this->message ?? '');
    }

    /**
     * DirectusException response renderer.
     */
    public function render(): JsonResponse
    {
        $response = directus()->respond();

        $code = static::$code ?? Str::snake(Str::afterLast(self::class, '\\'));
        $status = static::$status ?? $this->inferStatus();
        $safeContext = Arr::only($this->context, static::$fields ?? []);

        $response->setStatusCode($status);

        $data = $response->getData(true);
        $response->setData(Arr::set($data, 'error', [
            'code' => $code,
            'message' => trans("directus::errors.{$code}", $safeContext),
            'context' => $safeContext,
        ]));

        // TODO: dispatch event for plugins to transform the response and
        //       leverage request()->route()->getName() for identification

        return $response;
    }

    private function inferStatus(): int
    {
        $class = Str::afterLast(self::class, '\\');

        if (Str::endsWith($class, 'NotFound')) {
            return Response::HTTP_NOT_FOUND;
        }

        if (Str::endsWith($class, 'NotImplemented')) {
            return Response::HTTP_NOT_IMPLEMENTED;
        }

        if (Str::endsWith($class, 'Forbidden')) {
            return Response::HTTP_FORBIDDEN;
        }

        if (Str::startsWith($class, 'Invalid') && Str::endsWith($class, 'Request')) {
            return Response::HTTP_BAD_REQUEST;
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
