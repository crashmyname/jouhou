<?php


use Bpjs\Framework\Helpers\SchemaBuilder;

class CreateLSheetTable
{
    public function up(\PDO $pdo)
    {
        $table = new SchemaBuilder('l_sheet');
        $table->id('lId');
        $table->bigInteger('laneId');
        $table->string('image')->nullable();
        $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
        $table->timestamp('updated_at')->default('CURRENT_TIMESTAMP');
        $sql = $table->buildCreateSQL();
        try {
             $pdo->exec($sql);
             echo "Table 'l_sheet' berhasil dibuat\n";
        } catch (\PDOException $e) {
             echo "Gagal membuat tabel: ".$e->getMessage()."\n";
             echo "SQL:".$sql;
        }
    }

    public function down(PDO $pdo)
    {
        $table = new SchemaBuilder('l_sheet');
        $pdo->exec($table->buildDropSQL());
    }
}
