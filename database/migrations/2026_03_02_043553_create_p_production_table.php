<?php


use Bpjs\Framework\Helpers\SchemaBuilder;

class CreatePProductionTable
{
    public function up(\PDO $pdo)
    {
        $table = new SchemaBuilder('p_production');
        $table->id('ppId');
        $table->bigInteger('laneId');
        $table->string('plan_production')->nullable();
        $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
        $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
        $sql = $table->buildCreateSQL();
        try {
             $pdo->exec($sql);
             echo "Table 'p_production' berhasil dibuat\n";
        } catch (\PDOException $e) {
             echo "Gagal membuat tabel: ".$e->getMessage()."\n";
             echo "SQL:".$sql;
        }
    }

    public function down(PDO $pdo)
    {
        $table = new SchemaBuilder('p_production');
        $pdo->exec($table->buildDropSQL());
    }
}
