<?php


use Bpjs\Framework\Helpers\SchemaBuilder;

class CreateC4mTable
{
    public function up(\PDO $pdo)
    {
        $table = new SchemaBuilder('c_4m');
        $table->id('c4mId');
        $table->string('man')->nullable();
        $table->string('machine')->nullable();
        $table->string('material')->nullable();
        $table->string('methode')->nullable();
        $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
        $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
        $sql = $table->buildCreateSQL();
        try {
             $pdo->exec($sql);
             echo "Table 'c_4m' berhasil dibuat\n";
        } catch (\PDOException $e) {
             echo "Gagal membuat tabel: ".$e->getMessage()."\n";
             echo "SQL:".$sql;
        }
    }

    public function down(PDO $pdo)
    {
        $table = new SchemaBuilder('c_4m');
        $pdo->exec($table->buildDropSQL());
    }
}
