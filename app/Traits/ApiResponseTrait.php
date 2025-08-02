<?php

// Option 1: Trait réutilisable (Recommandé)
// Créer : app/Traits/ApiResponseTrait.php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Réponse de succès
     */
    protected function successResponse($data = null, string $message = '', int $code = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'success' => true,
            'code' => $code
        ], $code);
    }

    /**
     * Réponse d'erreur
     */
    protected function errorResponse(string $message = 'Une erreur est survenue', int $code = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'data' => null,
            'message' => $message,
            'success' => false,
            'errors' => $errors,
            'code' => $code
        ], $code);
    }

    /**
     * Réponse avec pagination
     */
    protected function paginatedResponse($data, string $message = '', int $code = 200): JsonResponse
    {
        return response()->json([
            'data' => $data->items(),
            'pagination' => [
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'last_page' => $data->lastPage(),
                'has_more' => $data->hasMorePages()
            ],
            'message' => $message,
            'success' => true,
            'code' => $code
        ], $code);
    }

    /**
     * Réponse de création
     */
    protected function createdResponse($data, string $message = 'Créé avec succès'): JsonResponse
    {
        return $this->successResponse($data, $message, 201);
    }

    /**
     * Réponse de suppression
     */
    protected function deletedResponse(string $message = 'Supprimé avec succès'): JsonResponse
    {
        return $this->successResponse(null, $message, 200);
    }

    /**
     * Réponse de validation d'erreur
     */
    protected function validationErrorResponse($errors, string $message = 'Erreur de validation'): JsonResponse
    {
        return $this->errorResponse($message, 422, $errors);
    }

    /**
     * Réponse non trouvé
     */
    protected function notFoundResponse(string $message = 'Ressource non trouvée'): JsonResponse
    {
        return $this->errorResponse($message, 404);
    }

    /**
     * Réponse non autorisé
     */
    protected function unauthorizedResponse(string $message = 'Non autorisé'): JsonResponse
    {
        return $this->errorResponse($message, 401);
    }

    /**
     * Réponse interdite
     */
    protected function forbiddenResponse(string $message = 'Accès interdit'): JsonResponse
    {
        return $this->errorResponse($message, 403);
    }
}