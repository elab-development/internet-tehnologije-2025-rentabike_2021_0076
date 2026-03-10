<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Rent-a-Bike / Rent-a-Equipment API',
    description: 'API dokumentacija za projekat iz predmeta Internet tehnologije'
)]
#[OA\Server(
    url: 'http://localhost:8000',
    description: 'Local server'
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'JWT',
    description: 'Unesi token kao: Bearer {token}'
)]
class OpenApiSpec
{
}