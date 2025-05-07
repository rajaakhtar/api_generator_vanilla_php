<?php

require_once '../app/models/Auth.php';

class ApiController extends Controller
{
    public function auth()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json(['error' => 'Invalid request method'], 405);
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $username = $input['username'] ?? '';
        $password = $input['password'] ?? '';

        if (!Auth::validateCredentials($username, $password)) {
            return $this->json(['error' => 'Invalid credentials'], 401);
        }

        $token = Auth::generateToken();

        return $this->json(['token' => $token]);
    }

    public function data()
    {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $token = $matches[1];

        if (!Auth::isValidToken($token)) {
            return $this->json(['error' => 'Invalid token'], 401);
        }

        // Success — return protected data
        return $this->json([
            'message' => 'This is protected data',
            'data' => ['a' => 1, 'b' => 2]
        ]);
    }

    private function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
