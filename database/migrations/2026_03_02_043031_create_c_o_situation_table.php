<?php


use Bpjs\Framework\Helpers\SchemaBuilder;

class CreateCOSituationTable
{
    public function up(\PDO $pdo)
    {
        $table = new SchemaBuilder('c_o_situation');
        $table->id('cosId');
        $table->bigInteger('laneId');
        $table->string('noMcLane')->nullable();
        $table->date('date');
        $table->string('typeModel')->nullable();
        $table->string('zeroClaim')->nullable();
        $table->string('lasClaim')->nullable();
        $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
        $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
        $sql = $table->buildCreateSQL();
        try {
             $pdo->exec($sql);
             echo "Table 'c_o_situation' berhasil dibuat\n";
        } catch (\PDOException $e) {
             echo "Gagal membuat tabel: ".$e->getMessage()."\n";
             echo "SQL:".$sql;
        }
    }

    public function down(PDO $pdo)
    {
        $table = new SchemaBuilder('c_o_situation');
        $pdo->exec($table->buildDropSQL());
    }
}
