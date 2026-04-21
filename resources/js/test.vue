<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class FingerprintController extends Controller
{
    private $javaServiceUrl = 'http://localhost:8081'; // URL de tu microservicio Java

    /**
     * Verificar estado del lector de huellas
     */
    public function checkReaderStatus(): JsonResponse
    {
        try {
            $response = Http::timeout(10)->get($this->javaServiceUrl . '/api/fingerprint/reader-status');
            
            return response()->json(
                $response->json(),
                $response->status()
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede conectar con el servicio de huellas dactilares: ' . $e->getMessage()
            ], 503);
        }
    }

    /**
     * Capturar huella dactilar
     */
    public function captureFingerprint(): JsonResponse
    {
        try {
            Log::info('Iniciando captura de huella desde Laravel...');
            
            $response = Http::timeout(30)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->get($this->javaServiceUrl . '/api/fingerprint/capture');
            
            Log::info('Respuesta de captura: ' . $response->body());
            
            if ($response->successful()) {
                $data = $response->json();
                return response()->json($data, 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en captura: ' . $response->body()
                ], $response->status());
            }
            
        } catch (\Exception $e) {
            Log::error('Error en captura de huella: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al capturar huella: ' . $e->getMessage()
            ], 503);
        }
    }

    /**
     * Registrar huella dactilar
     */
    public function registerFingerprint(Request $request): JsonResponse
    {
        try {
            $response = Http::timeout(30)->post(
                $this->javaServiceUrl . '/api/fingerprint/register',
                $request->all()
            );
            
            return response()->json(
                $response->json(),
                $response->status()
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar huella: ' . $e->getMessage()
            ], 503);
        }
    }

    /**
     * Validar huella para login
     */
    public function validateLogin(Request $request): JsonResponse
    {
        try {
            $response = Http::timeout(30)->post(
                $this->javaServiceUrl . '/api/fingerprint/validate-login',
                $request->all()
            );
            
            return response()->json(
                $response->json(),
                $response->status()
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al validar huella: ' . $e->getMessage()
            ], 503);
        }
    }
}