<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

class GraphQLController extends BaseController
{
    public function query(): JsonResponse
    {
        $query = request()->input('query', 'query {}');
        $variables = request()->input('variables', []);

        return response()->json(
            directus()->graphql()->execute($query, $variables)
        );
    }
}
