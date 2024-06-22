<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseConnectionTest extends TestCase
{
    /**
     * Test database connection.
     */
    public function test_database_connection()
    {
        try {
            $pdo = DB::connection('mysql')->getPdo(); // Cambia 'mysql' si tu conexión tiene un nombre diferente en config/database.php
            $databaseName = $pdo->query('select database()')->fetchColumn();
            
            $this->assertSame('boutique', $databaseName); // Asegura que el nombre de la base de datos sea 'boutique'
            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->fail('Database connection failed: ' . $e->getMessage());
        }
    }
}
