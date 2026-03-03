<?php


use Bpjs\Framework\Helpers\SchemaBuilder;

class CreateLaneTable
{
    public function up(\PDO $pdo)
    {
        $table = new SchemaBuilder('lane');
        $table->id('laneId');
        $table->string('noLane',10);
        $table->string('description');
        $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
        $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
        $sql = $table->buildCreateSQL();
        try {
             $pdo->exec($sql);
             echo "Table 'lane' berhasil dibuat\n";
        } catch (\PDOException $e) {
             echo "Gagal membuat tabel: ".$e->getMessage()."\n";
             echo "SQL:".$sql;
        }
    }

    public function down(PDO $pdo)
    {
        $table = new SchemaBuilder('lane');
        $pdo->exec($table->buildDropSQL());
    }
}
