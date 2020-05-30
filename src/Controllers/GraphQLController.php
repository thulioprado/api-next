<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

class GraphQLController extends BaseController
{
    public function system(): JsonResponse
    {
        $query = request()->input('query', 'query {}');
        $variables = request()->input('variables', []);
        $operation = request()->input('operationName', null);

        $graphql = directus()->graphql()->server();

        return directus()->respond()->withQuery(
            $graphql->execute($query, $variables, $operation)
        );
    }

    public function project(): JsonResponse
    {
        $project = config('directus.project.id');
        $query = request()->input('query', 'query {}');
        $variables = request()->input('variables', []);
        $operation = request()->input('operationName', null);

        $graphql = directus()->graphql()->project($project);

        return directus()->respond()->withQuery(
            $graphql->execute($query, $variables, $operation)
        );
    }
}
