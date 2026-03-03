<?php

// use PDO;

use Bpjs\Framework\Helpers\SchemaBuilder;

class CreateUserTable
{
    public function up(\PDO $pdo)
    {
        $table = new SchemaBuilder('users');
        $table->id('userId');
        $table->string('name',150);
        $table->string('username',10);
        $table->string('password');
        $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
        $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');

        $sql = $table->buildCreateSQL();
        try {
            $pdo->exec($sql);
            echo "Table 'user' berhasil dibuat\n";
            $stmt = $pdo->prepare("
                INSERT INTO users (name, username, password)
                VALUES (:name, :username, :password)
            ");

            $stmt->execute([
                ':name' => 'Administrator',
                ':username' => 'admin',
                ':password' => password_hash('admin123', PASSWORD_BCRYPT)
            ]);

            echo "User admin berhasil dibuat\n";
        } catch (\PDOException $e) {
            echo "Gagal membuat tabel: " . $e->getMessage() . "\n";
            echo "SQL: $sql\n";
        }

    }

    public function down(PDO $pdo)
    {
        $table = new SchemaBuilder('users');
        $pdo->exec($table->buildDropSQL());
    }
}
