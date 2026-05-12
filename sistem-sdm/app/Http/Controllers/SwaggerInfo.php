<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(title: "Sistem SDM API", version: "2.0.0", description: "Dokumentasi API untuk Sistem SDM")]
#[OA\Server(url: "http://localhost:8000", description: "Server Lokal")]
class SwaggerInfo
{
}
